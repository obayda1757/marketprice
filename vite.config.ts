import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default defineConfig({
  // Add this line below. It must match your GitHub repository name.
  base: '/marketprice/', 
  
  plugins: [react()],
  optimizeDeps: {
    exclude: ['lucide-react'],
  },
});
