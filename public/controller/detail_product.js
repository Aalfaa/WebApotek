// LOADING SCREEN
window.addEventListener("load", () => {
  const loader = document.getElementById("pageLoader");
  if (loader) {
    loader.classList.add("opacity-0", "transition-opacity", "duration-500");
    setTimeout(() => loader.style.display = "none", 500);
  }
});

// GANTI GAMBAR UTAMA
document.addEventListener("DOMContentLoaded", () => {
  const thumbs = document.querySelectorAll(".thumb");
  const mainImg = document.getElementById("mainImg");

  thumbs.forEach(t => {
    t.addEventListener("click", () => {
      mainImg.src = t.dataset.img;
    });
  });
});

// LIHAT SELENGKAPNYA
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("toggleDesc");
  const full = document.getElementById("fullDesc");
  let open = false;

  btn.onclick = () => {
    open = !open;
    full.classList.toggle("hidden");
    btn.textContent = open ? "Sembunyikan" : "Lihat Selengkapnya";
  };
});
