document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById("search-input");
    const clearBtn = document.getElementById("clear-btn");
  
    // Tampilkan tombol clear kalau ada teks
    input.addEventListener("input", function() {
      if (input.value.length > 0) {
        clearBtn.style.display = "block";
      } else {
        clearBtn.style.display = "none";
      }
    });
  
    // Bersihin input waktu clear button di-klik
    clearBtn.addEventListener("click", function() {
      input.value = "";
      clearBtn.style.display = "none";
      input.focus(); // biar user bisa langsung ngetik lagi
    });
  });
  