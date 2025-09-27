// Import yang sudah ada sebelumnya
import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";

// Inisialisasi AlpineJS yang sudah ada
window.Alpine = Alpine;
Alpine.start();

// --- START: Logika Dark Mode yang Disederhanakan dan Efektif ---

/**
 * Fungsi ini akan mencari tombol tema dan mengaktifkan semua logikanya.
 * Ini dibungkus dalam satu fungsi agar rapi dan aman.
 */
const initializeThemeToggle = () => {
    const themeToggleButton = document.getElementById("theme-toggle");
    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    // 1. Pengecekan Paling Penting: Jika tombol tidak ada di halaman ini,
    //    hentikan eksekusi fungsi ini sama sekali untuk mencegah error.
    if (!themeToggleButton || !themeToggleDarkIcon || !themeToggleLightIcon) {
        return;
    }

    // 2. Fungsi sederhana untuk memeriksa apakah mode gelap sedang aktif
    const isDarkMode = () => {
        return (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        );
    };

    // 3. Fungsi untuk memperbarui tampilan (ikon dan tema) berdasarkan kondisi saat ini
    const updateThemeView = () => {
        if (isDarkMode()) {
            document.documentElement.classList.add("dark");
            themeToggleLightIcon.classList.remove("hidden");
            themeToggleDarkIcon.classList.add("hidden");
        } else {
            document.documentElement.classList.remove("dark");
            themeToggleLightIcon.classList.add("hidden");
            themeToggleDarkIcon.classList.remove("hidden");
        }
    };

    // 4. Pasang "event listener" langsung ke tombol
    themeToggleButton.addEventListener("click", () => {
        // Tentukan tema baru dengan membalik tema saat ini
        const newTheme = isDarkMode() ? "light" : "dark";

        // Simpan tema baru ke localStorage
        localStorage.setItem("color-theme", newTheme);

        // Perbarui tampilan agar sesuai dengan tema baru
        updateThemeView();
    });

    // 5. Panggil fungsi ini sekali saat halaman dimuat untuk mengatur tampilan awal
    updateThemeView();
};

// Jalankan seluruh logika di atas HANYA setelah seluruh halaman siap
document.addEventListener("DOMContentLoaded", initializeThemeToggle);

// --- END: Logika Dark Mode ---
