document.addEventListener("DOMContentLoaded", function () {
    const img1 = document.getElementById("img-rotate1");
    const img2 = document.getElementById("img-rotate2");
    const btnLeft = document.getElementById("rotasi-kiri");
    const btnRight = document.getElementById("rotasi-kanan");

    let rotation1 = 0;
    let rotation2 = 0;

    // Fungsi untuk mengambil gambar secara random dari controller
    function fetchCaptchaImages() {
        fetch("{{ route('getRandomImages') }}")
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                img1.src = data.image1;
                img2.src = data.image2;
                rotation1 = data.rotation1;
                rotation2 = data.rotation2;
                img1.style.transform = `rotate(${rotation1}deg)`;
                img2.style.transform = `rotate(${rotation2}deg)`;
            })
            .catch(error => console.error("Error fetching images:", error));
    }

    // Fungsi untuk memutar gambar
    function rotateImage(direction) {
        if (direction === "left") {
            rotation1 -= 45;
            rotation2 -= 45;
        } else {
            rotation1 += 45;
            rotation2 += 45;
        }
        img1.style.transform = `rotate(${rotation1}deg)`;
        img2.style.transform = `rotate(${rotation2}deg)`;
    }

    // Event listener untuk tombol rotasi
    btnLeft.addEventListener("click", function (e) {
        e.preventDefault();
        rotateImage("left");
    });

    btnRight.addEventListener("click", function (e) {
        e.preventDefault();
        rotateImage("right");
    });

    // Panggil fungsi untuk menampilkan gambar pertama kali
    fetchCaptchaImages();
});
