import './bootstrap';
import "flowbite";
import Alpine from 'alpinejs';
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

window.Alpine = Alpine;
window.checkUrlPath = (pathPatern) => {
  const currentPath = window.location.pathname;
  if (pathPatern === currentPath) {
    return true;
  }

  const patern = "^".concat(pathPatern)
    .replaceAll('/**', '/.*')
    .replaceAll('/*/', '/[^/]*/')
    .replaceAll('/*', '/.*')
    .replaceAll('/', '\\/?')
    .concat('$');

  const rgx = new RegExp(patern, 'g');
  return currentPath.search(rgx) >= 0;
}

Alpine.start();
window.generateRandom = (length) => {
  let result = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}

function onThemeSystemChanged(e) {
  if (localStorage.getItem("color-theme") !== "system") return;
  setTheme(e.matches ? "dark" : "light");
}
window
  .matchMedia("(prefers-color-scheme: dark)")
  .addEventListener("change", onThemeSystemChanged);

const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

function setTheme(option) {
  if (option === "light") {
    themeToggleLightIcon?.classList.remove("hidden");
    themeToggleDarkIcon?.classList.add("hidden");
    document.documentElement.classList.remove("dark");
  } else {
    themeToggleLightIcon?.classList.add("hidden");
    themeToggleDarkIcon?.classList.remove("hidden");
    document.documentElement.classList.add("dark");
  }
}

if (!("color-theme" in localStorage)) {
  setTheme("system");
} else {
  setTheme(localStorage.getItem("color-theme"));
}

function toggleTheme(option) {
  if (option === localStorage.getItem("color-theme")) return;
  localStorage.setItem("color-theme", option);
  let selectedTheme = localStorage.getItem("color-theme");

  if (option === "system")
    selectedTheme = window.matchMedia("(prefers-color-scheme: dark)")
      .matches
      ? "dark"
      : "light";

  setTheme(selectedTheme);
}
const listThemeItem = document.querySelectorAll(
  "#dropdown-theme > div > input[type=radio]",
);

for (const input of listThemeItem) {
  if (
    input.value === localStorage.getItem("color-theme") ||
    (input.value === "system" && !("color-theme" in localStorage))
  )
    input.checked = true;
  input.addEventListener("change", (e) => {
    toggleTheme(e.currentTarget.value);
  });
}


