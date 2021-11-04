let tailwindcss = require('tailwindcss');

module.exports = {
    plugins: [
        require('autoprefixer'),
        require('postcss-import'),
        require('postcss-nested-ancestors'),
        require('postcss-nested'),
        tailwindcss('tailwind.config.js'),
    ]
}