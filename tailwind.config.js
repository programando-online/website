/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./app/layout/default/**/*.{html,js}"],
  theme: {
    screens: {
      'xx': '330px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px'
    },
    extend: {},
    fontFamily: {
      display: ['Cuprum', 'sans-serif'],
    },
  },
  plugins: [],
}

