import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  base: '/juicejoy/',
  build: {
    outDir: 'dist',
    sourcemap: true
  }
})