// Mode nuit

const logo = document.getElementById("logo");

// Appliquer le mode nuit au chargement si besoin
if (localStorage.getItem("dark-mode") === "on") {
  document.body.classList.add("dark-mode");
  logo.src = "./styles/ressources/logoN.png";
} else {
  logo.src = "./styles/ressources/logo.png";
}

logo.addEventListener("click", function () {
  document.body.classList.toggle("dark-mode");
  const isDark = document.body.classList.contains("dark-mode");
  if (isDark) {
    logo.src = "./styles/ressources/logoN.png";
    localStorage.setItem("dark-mode", "on");
  } else {
    logo.src = "./styles/ressources/logo.png";
    localStorage.setItem("dark-mode", "off");
  }
});