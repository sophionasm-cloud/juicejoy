<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    private $ordersFile;
    private $telegramBotToken;
    private $telegramChatId;

    public function __construct()
    {
        $this->ordersFile = storage_path('app/data/orders.json');
        $this->telegramBotToken = env('TELEGRAM_BOT_TOKEN');
        $this->telegramChatId = env('TELEGRAM_CHAT_ID');
    }

    public function store(OrderRequest $request): JsonResponse
    {
        // Generate order number
        $orderNumber = $this->generateOrderNumber();
        
        // Get validated data
        $validated = $request->validated();
        
        // Build order object
        $order = [
            'order_number' => $orderNumber,
            'customer' => $validated['customer'],
            'items' => $validated['items'],
            'delivery' => $validated['delivery'],
            'subtotal' => $validated['subtotal'],
            'total' => $validated['total'],
            'status' => 'pending',
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];
        
        // Save to JSON file
        $this->saveOrder($order);
        
        // Send to Telegram
        $this->sendTelegramMessage($order);
        
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'order' => $order,
        ], 201);
    }

    public function index(): JsonResponse
    {
        $orders = $this->getAllOrders();
        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }

    public function show(string $orderNumber): JsonResponse
    {
        $orders = $this->getAllOrders();
        $order = collect($orders)->firstWhere('order_number', $orderNumber);
        
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }

    public function updateStatus(Request $request, string $orderNumber): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,delivered',
        ]);
        
        $orders = $this->getAllOrders();
        $orderIndex = collect($orders)->search(fn($o) => $o['order_number'] === $orderNumber);
        
        if ($orderIndex === false) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }
        
        $orders[$orderIndex]['status'] = $request->status;
        $orders[$orderIndex]['updated_at'] = now()->toDateTimeString();
        
        $this->writeOrders($orders);
        
        return response()->json([
            'success' => true,
            'message' => 'Order status updated',
            'order' => $orders[$orderIndex],
        ]);
    }

    public function destroy(string $orderNumber): JsonResponse
    {
        $orders = $this->getAllOrders();
        $orderIndex = collect($orders)->search(fn($o) => $o['order_number'] === $orderNumber);
        
        if ($orderIndex === false) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }
        
        array_splice($orders, $orderIndex, 1);
        $this->writeOrders($orders);
        
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ]);
    }

    private function generateOrderNumber(): string
    {
        $year = date('Y');
        $lastOrder = $this->getLastOrder();
        
        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder['order_number'], -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return sprintf('JR-%s-%04d', $year, $newNumber);
    }

    private function getLastOrder(): ?array
    {
        $orders = $this->getAllOrders();
        return !empty($orders) ? $orders[count($orders) - 1] : null;
    }

    private function getAllOrders(): array
    {
        if (!File::exists($this->ordersFile)) {
            return [];
        }
        
        $content = File::get($this->ordersFile);
        return json_decode($content, true) ?? [];
    }

    private function saveOrder(array $order): void
    {
        $orders = $this->getAllOrders();
        $orders[] = $order;
        $this->writeOrders($orders);
    }

    private function writeOrders(array $orders): void
    {
        $directory = dirname($this->ordersFile);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        File::put($this->ordersFile, json_encode($orders, JSON_PRETTY_PRINT));
    }

    private function sendTelegramMessage(array $order): void
    {
        if (!$this->telegramBotToken || !$this->telegramChatId) {
            return;
        }
        
        $items = '';
        foreach ($order['items'] as $item) {
            $items .= sprintf(
                "%s x%d — ETB %.2f\n",
                $item['name'],
                $item['quantity'],
                $item['price'] * 10 * $item['quantity']
            );
        }
        
        $deliveryLabels = [
            'express' => 'Express Delivery (30-45 min)',
            'standard' => 'Standard Delivery (1-2 hours)',
            'pickup' => 'Pickup'
        ];
        
        $message = sprintf(
            "🍊 New Juicie Ride Order 🍊\n\n" .
            "Order Number: %s\n" .
            "Date: %s\n\n" .
            "Customer Details:\n" .
            "Name: %s\n" .
            "Phone: %s\n" .
            "Email: %s\n" .
            "Address: %s\n" .
            "City: %s\n\n" .
            "Products:\n%s\n" .
            "Delivery: %s\n\n" .
            "Summary:\n" .
            "Subtotal: ETB %.2f\n" .
            "Total: ETB %.2f\n\n" .
            "Notes: %s\n\n" .
            "Thank you for ordering from Juicie Ride! 🧃",
            $order['order_number'],
            $order['created_at'],
            $order['customer']['fullName'],
            $order['customer']['phone'],
            $order['customer']['email'] ?? 'Not provided',
            $order['customer']['address'],
            $order['customer']['city'],
            $items,
            $deliveryLabels[$order['delivery']] ?? $order['delivery'],
            $order['subtotal'] * 10,
            $order['total'] * 10,
            $order['customer']['notes'] ?? 'None'
        );
        
        $url = sprintf(
            "https://api.telegram.org/bot%s/sendMessage",
            $this->telegramBotToken
        );
        
        $client = new \GuzzleHttp\Client();
        try {
            $client->post($url, [
                'form_params' => [
                    'chat_id' => $this->telegramChatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ],
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Telegram send failed: ' . $e->getMessage());
        }
    }
}