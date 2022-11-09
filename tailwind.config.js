/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors');
module.exports = {
    content: ["./index.html", "./public/index.html", ".resources/**/*.vue,js,ts,tsx,jsx", "./resources/views/*.blade.php", "./resources/views/**/*.blade.php", "./resources/views/**/**/*.blade.php", ".resources/components/**/*.vue,js,ts,tsx,jsx", "./resources/**/*.{html,js,vue}"],

    theme: {
        extend: {


            colors: {
                primaryorange: "#FFBF1A"
            }
        },
    },
    plugins: [],
}