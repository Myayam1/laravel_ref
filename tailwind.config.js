/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
      ],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Inter var', ...defaultTheme.fontFamily.sans],
          },
        colors: {
            primary: {
                50: '#EBF5FF',
                100: '#E1EFFE',
                200: '#C3DDFD',
                300: '#A4CAFE',
                400: '#76A9FA',
                500: '#3F83F8',
                600: '#1C64F2',
                700: '#1A56DB',
                800: '#1E429F',
                900: '#233876'
            },
          },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

