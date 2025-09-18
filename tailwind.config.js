/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./node_modules/flowbite/**/*.js", // untuk komponen interaktif Flowbite
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("flowbite/plugin"), // plugin untuk Flowbite
    ],
};
