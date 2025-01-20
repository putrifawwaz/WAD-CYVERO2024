// /** @type {import('tailwindcss').Config} */
// export default {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

module.exports = {
    content: [
      "./resources/**/*.{html,js,php}",
    ],
    theme: {
      extend: {
        colors: {
          blue: {
            100: '#b3d9ff',
            200: '#80cfff',
            300: '#4db8ff',
            400: '#1ab8ff',
            500: '#0099cc',
            600: '#007b9c',
            700: '#00607b',
            800: '#004d5d',
            900: '#003f47',
          },
        },
      },
    },
    plugins: [],
  }


