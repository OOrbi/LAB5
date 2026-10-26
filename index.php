<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz kontaktowy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-container">
        <h2>Formularz kontaktowy</h2>
        
        <!-- Powitanie pod formularzem / nad formularzem dynamicznie -->
        <div id="greeting" class="greeting"></div>

        <!-- Formularz wysyłający dane metodą POST do odbierz.php -->
        <form id="contactForm" action="odbierz.php" method="post" novalidate>
            
            <!-- Pole imienia -->
            <div class="form-group">
                <label for="imie">Imię:</label>
                <input type="text" id="imie" name="imie" required placeholder="Wpisz swoje imię">
                <span class="error-message" id="error-imie"></span>
            </div>

            <!-- Pole e-mail -->
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required placeholder="jan.kowalski@example.com">
                <span class="error-message" id="error-email"></span>
            </div>

            <!-- Pole telefonu (zadanie dodatkowe) -->
            <div class="form-group">
                <label for="telefon">Telefon (opcjonalnie):</label>
                <input type="tel" id="telefon" name="telefon" placeholder="123456789">
                <span class="error-message" id="error-telefon"></span>
            </div>

            <!-- Lista wyboru tematu -->
            <div class="form-group">
                <label for="temat">Temat wiadomości:</label>
                <select id="temat" name="temat">
                    <option value="Zapytanie ogólne">Zapytanie ogólne</option>
                    <option value="Wsparcie techniczne">Wsparcie techniczne</option>
                    <option value="Współpraca">Współpraca</option>
                </select>
            </div>

            <!-- Data kontaktu (zadanie dodatkowe) -->
            <div class="form-group">
                <label for="data_kontakt">Preferowana data kontaktu:</label>
                <input type="date" id="data_kontakt" name="data_kontakt">
            </div>

            <!-- Hasło + toggle (zadanie dodatkowe) -->
            <div class="form-group">
                <label for="haslo">Hasło (opcjonalnie):</label>
                <div class="password-wrapper">
                    <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło">
                    <button type="button" id="togglePassword">Pokaż</button>
                </div>
            </div>

            <!-- Treść wiadomości -->
            <div class="form-group">
                <label for="wiadomosc">Wiadomość:</label>
                <textarea id="wiadomosc" name="wiadomosc" rows="3" maxlength="200" required placeholder="Wpisz treść wiadomości..."></textarea>
                <div class="char-counter">
                    Wpisano znaków: <span id="charCount">0</span> | Pozostało: <span id="charRemaining">200</span>
                </div>
                <span class="error-message" id="error-wiadomosc"></span>
            </div>

            <!-- Zgoda regulaminu -->
            <div class="form-group checkbox-group">
                <input type="checkbox" id="zgoda" name="zgoda" value="tak" required>
                <label for="zgoda">Akceptuję regulamin</label>
                <span class="error-message" id="error-zgoda"></span>
            </div>

            <!-- Przyciski wysyłania i resetu -->
            <div class="button-group">
                <button type="submit" id="btnSubmit">Wyślij</button>
                <button type="reset" id="btnReset">Wyczyść formularz</button>
            </div>
        </form>

        <!-- Statystyki prób wysłania (zadanie dodatkowe) -->
        <div class="stats">
            Poprawne wysłania: <span id="successCount">0</span> | Błędne próby: <span id="failCount">0</span>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>