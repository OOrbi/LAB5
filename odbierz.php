<?php
// Ustawienie nagłówka z kodowaniem UTF-8
header('Content-Type: text/html; charset=utf-8');

// Zadanie 22, 23 & 27: Pobranie danych z $_POST
$imie         = trim($_POST["imie"] ?? "");
$email        = trim($_POST["email"] ?? "");
$telefon      = trim($_POST["telefon"] ?? "");
$temat        = trim($_POST["temat"] ?? "");
$data_kontakt = trim($_POST["data_kontakt"] ?? "");
$haslo        = $_POST["haslo"] ?? "";
$wiadomosc    = trim($_POST["wiadomosc"] ?? "");
$zgoda        = $_POST["zgoda"] ?? "";

$errors = [];

// Zadanie 25: Weryfikacja wymaganych pól
if (empty($imie) || mb_strlen($imie) < 2) {
    $errors[] = "Imię jest wymagane i musi mieć co najmniej 2 znaki.";
}

// Zadanie 26: Sprawdzenie e-maila przez filter_var
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Podano niepoprawny adres e-mail.";
}

if (empty($wiadomosc)) {
    $errors[] = "Wiadomość nie może być pusta.";
}

// Zadanie 27: Sprawdzenie zgody
if ($zgoda !== "tak") {
    $errors[] = "Brak wymaganej zgody na regulamin.";
}

// Zadanie 24: Bezpieczne przygotowanie wartości (ochrona XSS)
$safe_imie         = htmlspecialchars($imie, ENT_QUOTES, "UTF-8");
$safe_email        = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
$safe_telefon      = htmlspecialchars($telefon, ENT_QUOTES, "UTF-8");
$safe_temat        = htmlspecialchars($temat, ENT_QUOTES, "UTF-8");
$safe_data_kontakt = htmlspecialchars($data_kontakt, ENT_QUOTES, "UTF-8");
$safe_wiadomosc    = nl2br(htmlspecialchars($wiadomosc, ENT_QUOTES, "UTF-8"));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podsumowanie formularza</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .result-card { background: white; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; }
        .error-list { color: #dc3545; background: #f8d7da; padding: 15px 15px 15px 35px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="result-card">
    <?php if (empty($errors)): ?>
        <!-- Zadanie 28: Komunikat sukcesu -->
        <h2 class="success">Dziękujemy! Formularz został wysłany poprawnie.</h2>
        <p>Oto otrzymane dane:</p>

        <!-- Zadanie dodatkowe: Wyświetlenie danych w tabeli -->
        <table>
            <tr>
                <th>Pole</th>
                <th>Wartość</th>
            </tr>
            <tr>
                <td><strong>Imię</strong></td>
                <td><?= $safe_imie ?></td>
            </tr>
            <tr>
                <td><strong>E-mail</strong></td>
                <td><?= $safe_email ?></td>
            </tr>
            <tr>
                <td><strong>Telefon</strong></td>
                <td><?= $safe_telefon ?: '<em>Brak</em>' ?></td>
            </tr>
            <tr>
                <td><strong>Temat</strong></td>
                <td><?= $safe_temat ?></td>
            </tr>
            <tr>
                <td><strong>Data kontaktu</strong></td>
                <td><?= $safe_data_kontakt ?: '<em>Brak</em>' ?></td>
            </tr>
            <tr>
                <td><strong>Wiadomość</strong></td>
                <td><?= $safe_wiadomosc ?></td>
            </tr>
            <tr>
                <td><strong>Zgoda</strong></td>
                <td>Zaakceptowano</td>
            </tr>
        </table>
    <?php else: ?>
        <!-- Wyświetlenie błędów po stronie PHP -->
        <h2 style="color: #dc3545;">Wystąpiły błędy walidacji:</h2>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <br>
    <a href="index.php">&laquo; Powrót do formularza</a>
</div>

</body>
</html>