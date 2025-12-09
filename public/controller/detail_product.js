window.addEventListener("load", () => {
  const loader = document.getElementById("pageLoader");
  if (loader) {
    loader.classList.add("opacity-0", "transition-opacity", "duration-500");
    setTimeout(() => loader.style.display = "none", 500);
  }
});