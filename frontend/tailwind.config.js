/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF6B35',
        secondary: '#2A9D8F',
        dark: '#1A1A2E',
        accent: '#FFD23F',
      }
    },
  },
  plugins: [],
}