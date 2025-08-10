const menuBtn = document.getElementById("menu-btn");
const menu = document.getElementById(".navbar");

menuBtn.addEventListener("click", () => {
  // Toggle menu visibility
  if (menu.style.display === "none" || menu.style.display === "") {
    menu.style.display = "block";
  } else {
    menu.style.display = "none";
  }
});
