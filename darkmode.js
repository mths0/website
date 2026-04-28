let darkmode = localStorage.getItem("darkmode");
const themSwitch = document.getElementById("theme-switch");

if (darkmode === "active") enableDarkmode();

themSwitch.addEventListener("click", () => {
  darkmode = localStorage.getItem("darkmode");
  darkmode !== "active" ? enableDarkmode() : disableDarkmode();
});

function enableDarkmode() {
  document.body.classList.add("darkmode");
  localStorage.setItem("darkmode", "active");
}

function disableDarkmode() {
  document.body.classList.remove("darkmode");
  localStorage.setItem("darkmode", null);
}
