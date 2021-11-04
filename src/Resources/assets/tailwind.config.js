const colors = require('tailwindcss/colors')

module.exports = {
  purge: ['./../views/**/*.{twig, html.twig}'],
  darkMode: 'media',
  mode: 'jit',
  theme: {
    extend: {
      colors: {
        gray: colors.blueGray,
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
