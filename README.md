# 🧃 Juicie Ride — Project Readme

A full-stack juice ordering platform with cinematic UI, built with Vue 3 + Laravel 13 + Telegram Bot.

---

## ✨ Features

- 🎨 Cinematic UI with GSAP animations
- 🛒 Full shopping cart with Pinia
- 📱 Mobile responsive
- 🧃 5-step checkout process
- 🤖 Telegram bot for order notifications
- 🌙 Dark premium theme with glassmorphism
- 🍊 Floating fruit animations
- 📄 Multi-page experience (Home, Shop, About, Benefits, Recipes, Contact, Order)

---

## 🛠️ Tech Stack

**Frontend:**
- Vue 3
- Vite
- Pinia
- Vue Router
- GSAP
- Tailwind CSS

**Backend:**
- Laravel 13
- PHP 8.3
- Telegram Bot API

---

## 📂 Project Structure

```
juicejoy/
├── frontend/          # Vue 3 frontend
│   ├── src/
│   │   ├── views/     # Pages
│   │   ├── components/# Reusable components
│   │   └── stores/    # Pinia stores
│   └── public/
├── backend/           # Laravel API
│   ├── app/
│   ├── routes/
│   └── storage/
└── docs/              # GitHub Pages deployment
```

---

## 🚀 Installation

**1. Clone the repository**
```bash
git clone https://github.com/sophionasm-cloud/juicejoy.git
cd juicejoy
```

**2. Frontend setup**
```bash
cd frontend
npm install
npm run dev
```

**3. Backend setup (Optional)**
```bash
cd backend
composer install
php artisan serve
```

**4. Environment variables**

Create `frontend/.env`:
```
VITE_API_URL=http://localhost:8000/api
```

Create `backend/.env`:
```
TELEGRAM_BOT_TOKEN=your_bot_token
TELEGRAM_CHAT_ID=your_chat_id
```

---

## 🤖 Telegram Bot Setup

1. Open Telegram
2. Search for **BotFather**
3. Send `/newbot` and follow instructions
4. Save your bot token
5. Search for **userinfobot**
6. Send `/start` to get your Chat ID
7. Add both to `backend/.env`

---

## 📄 Pages

| Page | Description |
|------|-------------|
| Home | Hero with typing effect |
| Products | Cinematic horizontal scroll |
| About | Brand story with side-scrolling |
| Benefits | 6 benefit panels |
| Recipes | 6 recipe cards |
| Contact | Form with Telegram integration |
| Order | 5-step checkout |

---

## 📝 Scripts

**Frontend:**
```bash
npm run dev      # Start dev server
npm run build    # Build for production
npm run preview  # Preview build
```

**Backend:**
```bash
php artisan serve  # Start Laravel server
```

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

---

## 👤 Author

**Sophonias Melaku**
- GitHub: @sophionasm-cloud
- Email: Sophoniasmelaku@gmail.com
- Telegram: @sophitily

---

## 📄 License

Portfolio demonstration project.

---
