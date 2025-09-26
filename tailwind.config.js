import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    // BARIS INI DITAMBAHKAN UNTUK MENGAKTIFKAN DARK MODE
    darkMode: "class",

    content: [
        // Path ke semua file Blade di proyek Anda, termasuk subdirektori
        "./resources/views/**/*.blade.php",

        // Path ke file paginasi default Laravel
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",

        // Path ke file paginasi yang sudah kita publish
        "./resources/views/vendor/pagination/*.blade.php",

        // Path ke file Javascript Flowbite
        "./node_modules/flowbite/**/*.js",

        // Path ke file cache view Laravel
        "./storage/framework/views/*.php",
    ],

    // Safelist untuk "memaksa" Tailwind agar tidak pernah menghapus kelas-kelas ini
    safelist: [
        "relative",
        "inline-flex",
        "items-center",
        "px-4",
        "py-2",
        "text-sm",
        "font-medium",
        "text-gray-700",
        "bg-white",
        "border",
        "border-gray-300",
        "leading-5",
        "rounded-md",
        "hover:text-gray-500",
        "focus:outline-none",
        "focus:ring",
        "ring-gray-300",
        "focus:border-blue-300",
        "active:bg-gray-100",
        "active:text-gray-700",
        "transition",
        "ease-in-out",
        "duration-150",
        "cursor-default",
        "text-gray-500",
        "w-5",
        "h-5",
        "hidden",
        "sm:flex",
        "sm:flex-1",
        "sm:items-center",
        "sm:justify-between",
        "rounded-l-md",
        "rounded-r-md",
        "-ml-px",
        "z-10",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                    950: "#172554",
                },
            },
        },
    },

    plugins: [forms, require("flowbite/plugin")],
};
