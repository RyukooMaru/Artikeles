document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("search-input");
    const clearBtn = document.getElementById("clear-btn");
    const toggleButtons = document.querySelectorAll(".toggle-mode");
  
    // 🔹 Tampilkan tombol clear jika ada input
    input.addEventListener("input", function () {
        clearBtn.style.display = input.value.length > 0 ? "block" : "none";
    });
  
    // 🔹 Bersihkan input saat tombol clear ditekan
    clearBtn.addEventListener("click", function () {
        input.value = "";
        clearBtn.style.display = "none";
        input.focus();
    });
  
    // 🔹 Cek preferensi dark mode dari localStorage
    function applyDarkMode(isDarkMode) {
        document.body.classList.toggle("dark-mode", isDarkMode);
        localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
  
        // 🔹 Atur ikon toggle
        toggleButtons.forEach(button => {
            button.classList.toggle("hidden", button.dataset.mode === (isDarkMode ? "light" : "dark"));
        });
  
        // 🔹 Ganti ikon sidebar
        document.querySelectorAll(".icon-img").forEach(img => {
            img.src = isDarkMode ? img.getAttribute("data-dark") : img.getAttribute("data-light");
        });
    }
  
    const isDarkMode = localStorage.getItem("darkMode") === "enabled";
    applyDarkMode(isDarkMode);
  
    // 🔹 Event listener untuk tombol dark mode
    toggleButtons.forEach(button => {
        button.addEventListener("click", () => {
            applyDarkMode(!document.body.classList.contains("dark-mode"));
        });
    });
  });
  