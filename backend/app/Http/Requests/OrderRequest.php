<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer.fullName' => 'required|string|max:255',
            'customer.phone' => 'required|string|max:20',
            'customer.email' => 'nullable|email|max:255',
            'customer.address' => 'required|string|max:500',
            'customer.city' => 'required|string|max:100',
            'customer.notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'delivery' => 'required|in:express,standard,pickup',
            'subtotal' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];
    }
}