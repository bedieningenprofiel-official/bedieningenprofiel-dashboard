import "./bootstrap";
import "flowbite";
let currentTheme = null;

function getInitialTheme() {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        return savedTheme;
    }

    if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        return "dark";
    }
    return "light";
}

function applyTheme(theme, showNotification = false) {
    if (currentTheme === theme) {
        return;
    }

    if (theme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }

    localStorage.setItem("theme", theme);
    currentTheme = theme;

    if (showNotification) {
        new FilamentNotification()
            .title(window.translations.theme.notification)
            .success()
            .seconds(5)
            .send();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const initialTheme = getInitialTheme();
    applyTheme(initialTheme, false);

    const radioBtn = document.querySelector(`input[value="${initialTheme}"]`);
    if (radioBtn) {
        radioBtn.checked = true;
    }

    const form = document.getElementById("background_selector");

    if (!form) {
        return;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const selectedTheme = document
            .querySelector('input[name="theme_color"]:checked')
            .value.toLowerCase();
        applyTheme(selectedTheme, true);
    });
});
