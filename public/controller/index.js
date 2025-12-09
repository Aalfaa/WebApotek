
// JALANKAN SAAT HALAMAN SUDAH DIMUAT
document.addEventListener("DOMContentLoaded", () => {
  generateDiskonProducts();
  generateProducts();
});

// FUNGSI PEMBUAT CARD
function generateDiskonProducts() {
  const container = document.getElementById("produkDiskon");
  if (!container) return;

  for (let i = 0; i < 5; i++) {

    // BIKIN TAG <a>
    const card = document.createElement("a");
    card.href = "./model/detail_product.html";
    card.className = "block";

    // ISI HTML DI DALAM <a>
    card.innerHTML = `
      <div class="${"bg-white rounded-xl drop-shadow-md overflow-hidden border border-[var(--primary)]/20 hover:shadow-lg transition"}">
        <img src="./assets/images/paracetamol.jpg" class="w-full aspect-square object-cover">
        <div class="w-full h-px bg-gray-200"></div>

        <div class="p-3 text-[13px]">
          <p class="font-medium">Sanmol Paracetamol 500mg</p>
          <p class="text-[12px] text-gray-500 mt-1">Obat Bebas</p>
          <p class="text-[var(--primary)] mt-1 font-semibold">
            Rp. 14.000 
            <span class="line-through text-[12px] text-gray-500">Rp. 15.000</span>
          </p>
        </div>
      </div>
    `;

    container.appendChild(card);
  }
}

function generateProducts() {
  const container = document.getElementById("produkSemua");
  if (!container) return;

  for (let i = 0; i < 17; i++) {

    // BIKIN TAG <a>
    const card = document.createElement("a");
    card.href = "./model/detail_product.html";
    card.className = "block";

    // ISI HTML DI DALAM <a>
    card.innerHTML = `
      <div class="${"bg-white rounded-xl drop-shadow-md overflow-hidden border border-[var(--primary)]/20 hover:shadow-lg transition"}">
        <img src="./assets/images/paracetamol.jpg" class="w-full aspect-square object-cover">
        <div class="w-full h-px bg-gray-200"></div>

        <div class="p-3 text-[13px]">
          <p class="font-medium">Sanmol Paracetamol 500mg</p>
          <p class="text-[12px] text-gray-500 mt-1">Obat Bebas</p>
          <p class="text-[var(--primary)] mt-1 font-semibold">
            Rp. 14.000 
            <span class="line-through text-[12px] text-gray-500">Rp. 15.000</span>
          </p>
        </div>
      </div>
    `;

    container.appendChild(card);
  }
}


document.addEventListener("DOMContentLoaded", () => {

  const navbar = document.getElementById("navbar");
  let lastScroll = 0;

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    // Jika scroll kembali ke paling atas → reset efek
    if (currentScroll === 0) {
      navbar.style.transform = "translateY(0)";
      navbar.classList.remove("shadow-md", "bg-white/40", "backdrop-blur-sm", "rounded-2xl");
      lastScroll = currentScroll;
      return;
    }else if (currentScroll > lastScroll) {
      navbar.style.transform = "translateY(10px)";
      navbar.classList.add("shadow-md", "bg-white/40", "backdrop-blur-sm", "rounded-2xl");
    } 

    lastScroll = currentScroll;
  });

});


document.addEventListener("DOMContentLoaded", () => {

  // ambil elemen hero dan gambar utama
  const hero = document.getElementById("hero");
  let currentImage = document.getElementById("heroImg");

  // daftar gambar slider
  const banners = [
    "./assets/images/banner_1.png",
    "./assets/images/banner_2.png"
  ];

  let index = 0; // posisi gambar yang sedang tampil

  // fungsi untuk pindah gambar
  function slide(direction) {

    // tentukan index gambar selanjutnya
    let nextIndex = (direction === "right")
      ? index + 1
      : index - 1;

    // kalau melebihi batas, looping kembali
    if (nextIndex >= banners.length) nextIndex = 0;
    if (nextIndex < 0) nextIndex = banners.length - 1;

    // buat elemen img baru untuk animasi
    const newImage = currentImage.cloneNode();
    newImage.src = banners[nextIndex];

    // posisi awal gambar baru (di luar layar)
    if (direction === "right") {
      newImage.style.transform = "translateX(100%)";
    } else {
      newImage.style.transform = "translateX(-100%)";
    }

    hero.appendChild(newImage);

    // jalankan animasi di frame berikutnya
    requestAnimationFrame(() => {
      // geser gambar lama keluar
      if (direction === "right") {
        currentImage.style.transform = "translateX(-100%)";
      } else {
        currentImage.style.transform = "translateX(100%)";
      }

      // geser gambar baru masuk
      newImage.style.transform = "translateX(0)";
    });

    // setelah animasi selesai (0.5 detik)
    setTimeout(() => {
      currentImage.remove();    // hapus gambar lama
      currentImage = newImage;  // gambar baru jadi yang utama
      index = nextIndex;        // simpan index baru
    }, 500);
  }

  // tombol next
  document.getElementById("nextBtn").addEventListener("click", () => {
    slide("right");
  });

  // tombol previous
  document.getElementById("prevBtn").addEventListener("click", () => {
    slide("left");
  });

});

window.addEventListener("load", () => {
  const loader = document.getElementById("pageLoader");
  if (loader) {
    loader.classList.add("opacity-0", "transition-opacity", "duration-500");
    setTimeout(() => loader.style.display = "none", 500);
  }
});
