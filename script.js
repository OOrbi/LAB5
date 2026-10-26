// Zadanie 11: Podłączenie skryptu
console.log("Skrypt działa");

// Pobranie elementów DOM
const form = document.getElementById("contactForm");
const imieInput = document.getElementById("imie");
const emailInput = document.getElementById("email");
const telefonInput = document.getElementById("telefon");
const wiadomoscInput = document.getElementById("wiadomosc");
const zgodaInput = document.getElementById("zgoda");
const hasloInput = document.getElementById("haslo");
const togglePasswordBtn = document.getElementById("togglePassword");

const greetingDiv = document.getElementById("greeting");
const charCountSpan = document.getElementById("charCount");
const charRemainingSpan = document.getElementById("charRemaining");

const successCountSpan = document.getElementById("successCount");
const failCountSpan = document.getElementById("failCount");

// Zadanie dodatkowe: Liczniki prób
let successCount = 0;
let failCount = 0;

// Zadanie 13: Powitanie dynamiczne po wpisaniu imienia
imieInput.addEventListener("input", function () {
    const val = imieInput.value.trim();
    if (val.length > 0) {
        greetingDiv.textContent = `Witaj, ${val}!`;
    } else {
        greetingDiv.textContent = "";
    }
});

// Zadanie 14 & 15: Licznik znaków i pozostałych znaków w textarea
const maxLength = 200;
wiadomoscInput.addEventListener("input", function () {
    const currentLength = wiadomoscInput.value.length;
    charCountSpan.textContent = currentLength;
    charRemainingSpan.textContent = maxLength - currentLength;
});

// Zadanie dodatkowe: Pokaż / ukryj hasło
if (togglePasswordBtn) {
    togglePasswordBtn.addEventListener("click", function () {
        if (hasloInput.type === "password") {
            hasloInput.type = "text";
            togglePasswordBtn.textContent = "Ukryj";
        } else {
            hasloInput.type = "password";
            togglePasswordBtn.textContent = "Pokaż";
        }
    });
}

// Funkcja pomocnicza do czyszczenia błędu
function clearError(inputElem, errorElemId) {
    inputElem.classList.remove("invalid");
    document.getElementById(errorElemId).textContent = "";
}

// Funkcja pomocnicza do ustawiania błędu
function setError(inputElem, errorElemId, message) {
    inputElem.classList.add("invalid");
    document.getElementById(errorElemId).textContent = message;
}

// Walidacja formularza przed wysłaniem (Zadania 16-20)
form.addEventListener("submit", function (event) {
    let hasError = false;

    // Resetowanie poprzednich błędów
    clearError(imieInput, "error-imie");
    clearError(emailInput, "error-email");
    clearError(telefonInput, "error-telefon");
    clearError(wiadomoscInput, "error-wiadomosc");
    clearError(zgodaInput, "error-zgoda");

    // Zadanie 16 & 17: Walidacja imienia (puste i długość min 2 znaki)
    const imieVal = imieInput.value.trim();
    if (imieVal === "") {
        setError(imieInput, "error-imie", "Imię nie może być puste.");
        hasError = true;
    } else if (imieVal.length < 2) {
        setError(imieInput, "error-imie", "Imię musi mieć co najmniej 2 znaki.");
        hasError = true;
    }

    // Zadanie 18: Walidacja e-maila za pomocą checkValidity()
    if (!emailInput.checkValidity() || emailInput.value.trim() === "") {
        setError(emailInput, "error-email", "Wprowadź poprawny adres e-mail.");
        hasError = true;
    }

    // Zadanie dodatkowe: Walidacja telefonu (jeśli podano)
    const telefonVal = telefonInput.value.trim();
    if (telefonVal !== "" && !/^[0-9]{9,12}$/.test(telefonVal)) {
        setError(telefonInput, "error-telefon", "Numer telefonu powinien składać się z 9-12 cyfr.");
        hasError = true;
    }

    // Walidacja wiadomości (pusta)
    if (wiadomoscInput.value.trim() === "") {
        setError(wiadomoscInput, "error-wiadomosc", "Wiadomość nie może być pusta.");
        hasError = true;
    }

    // Zadanie 19: Sprawdzenie zgody (checked)
    if (!zgodaInput.checked) {
        setError(zgodaInput, "error-zgoda", "Musisz zaakceptować regulamin.");
        hasError = true;
    }

    // Zadanie 20 & Zadanie dodatkowe: Obsługa przesyłania i statystyk
    if (hasError) {
        event.preventDefault(); // Zatrzymuje wysłanie formularza do PHP
        failCount++;
        failCountSpan.textContent = failCount;
    } else {
        successCount++;
        successCountSpan.textContent = successCount;
        // Pozwól na domyślne przekierowanie POST do odbierz.php
    }
});

// Czyszczenie formularza i statystyk tekstowych
form.addEventListener("reset", function () {
    setTimeout(() => {
        greetingDiv.textContent = "";
        charCountSpan.textContent = "0";
        charRemainingSpan.textContent = "200";
        clearError(imieInput, "error-imie");
        clearError(emailInput, "error-email");
        clearError(telefonInput, "error-telefon");
        clearError(wiadomoscInput, "error-wiadomosc");
        clearError(zgodaInput, "error-zgoda");
    }, 10);
});