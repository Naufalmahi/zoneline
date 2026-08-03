import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
          sans: ['Inter', 'sans-serif'],
          heading: ['Poppins', 'sans-serif'],
      },
      colors: {
          primary: 'var(--color-primary, #2563EB)',
          success: '#22C55E',
          warning: '#F59E0B',
          danger: '#EF4444',
          background: '#F8FAFC',
          card: '#FFFFFF',
          body: '#1E293B',
      }
    }
  },
  plugins: [
    forms,
  ],
}
