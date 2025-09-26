// Import yang sudah ada sebelumnya
import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";

// Inisialisasi AlpineJS yang sudah ada
window.Alpine = Alpine;
Alpine.start();

// --- START: Logika untuk Tombol Dark/Light Mode ---

// Event listener ini memastikan kode di dalamnya hanya berjalan setelah
// seluruh halaman HTML selesai dimuat. Ini sangat penting untuk mencegah
// error "element not found" karena skrip berjalan sebelum tombolnya ada.
document.addEventListener("DOMContentLoaded", () => {
    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );
    const themeToggleButton = document.getElementById("theme-toggle");

    // 1. Pengecekan awal untuk menampilkan ikon yang benar saat halaman dimuat
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        // Jika dark mode aktif, tampilkan ikon matahari (light icon)
        if (themeToggleLightIcon) {
            // Cek dulu apakah ikonnya ada
            themeToggleLightIcon.classList.remove("hidden");
        }
    } else {
        // Jika light mode aktif, tampilkan ikon bulan (dark icon)
        if (themeToggleDarkIcon) {
            // Cek dulu apakah ikonnya ada
            themeToggleDarkIcon.classList.remove("hidden");
        }
    }

    // 2. Pastikan tombolnya ada di halaman ini sebelum menambahkan event listener
    //    Ini membuat kode lebih aman dan tidak akan error di halaman lain
    //    yang mungkin tidak memiliki tombol ini.
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", function () {
            // Ganti (toggle) ikon di dalam tombol
            if (themeToggleDarkIcon)
                themeToggleDarkIcon.classList.toggle("hidden");
            if (themeToggleLightIcon)
                themeToggleLightIcon.classList.toggle("hidden");

            // Logika untuk mengubah tema dan menyimpannya di localStorage
            if (localStorage.getItem("color-theme")) {
                if (localStorage.getItem("color-theme") === "light") {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("color-theme", "dark");
                } else {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("color-theme", "light");
                }
            } else {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("color-theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("color-theme", "dark");
                }
            }
        });
    }
});
