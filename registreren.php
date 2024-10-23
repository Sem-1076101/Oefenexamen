<?php
define('__ROOT__', dirname(dirname(__FILE__)));
session_start();
require 'config/config.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/registratie.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>


<?php

// form en post voor aanmaken docent
// <form action="" method="post">

// <div>
//     <input type="text" name="voornaamveld" placeholder="Voornaam" required>
// </div>
// <div>
//     <input type="text" name="achternaamveld" placeholder="Achternaam" required>
// </div>
// <div>
//     <input type="email" name="emailveld" placeholder="E-mail" required>
// </div>
// <div>
//     <input type="password" name="wwveld" placeholder="Wachtwoord" required>
// </div>
// <div>
//     <button type="submit" name="submitDocent">Versturen</button>
// </div>
// </form>
// if(isset($_POST['submitDocent'])) {

//    $voornaam = $_POST['voornaamveld'];
//    $achternaam =  $_POST['achternaamveld'];
//    $email = $_POST['emailveld'];
//    $wachtwoord = $_POST['wwveld'];

//    $hashWW = password_hash($wachtwoord, PASSWORD_DEFAULT);
//    $level = 0;

//    $stmt = $conn->prepare("INSERT INTO accounts_docenten (voornaam, achternaam, email, wachtwoord, level) VALUES (?, ?, ?, ?, ?)");
//    $stmt->bind_param('ssssi', $voornaam, $achternaam, $email, $hashWW, $level);
//    $stmt->execute();

//    if($stmt) {
//        echo 'docent toegevoegd';

//    }
//    else {
//        echo 'docent mislukt';
//    }
// }



?>

<div class="container">
    <div class="inner-container">
        <div class="titel"><h1>Account aanmaken</h1></div>
        <form action="" method="post">

            <div>
                <label for="studentnummer">Studentnummer</label>
                <input type="text" name="studentnummerveld"  pattern="\d*" maxlength="6" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="emailveld" required>
            </div>
            <div>
                <label for="voornaam">Voornaam</label>
                <input type="text" name="voornaamveld" required>
            </div>
            <div>
                <label for="achternaam">Achternaam</label>
                <input type="text" name="achternaamveld" required>
            </div>
            <div>
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" name="wachtwoordveld" required>
            </div>
            <div>
                <label for="klas">Klas</label>
                <input type="text" name="klasveld" required>
            </div>
            <div>
                <label for="adres">Adres</label>
                <input type="text" name="adresveld" required>
            </div>
            <div>
                <label for="postcode">Postcode</label>
                <input type="text" name="postcodeveld" required>
            </div>
            <div>
                <label for="woonplaats">Woonplaats</label>
                <input type="text" name="woonplaatsveld" required>
            </div>
            <div>
                <label for="leeftijd">Leeftijd</label>
                <input type="text" name="leeftijdveld"  pattern="\d*" maxlength="2" min="15" required>
            </div>
            <div class="buttons-registratie">
                <a class="terug-a" href="login.php">Terug</a>
                <button class="btn-registratie" type="submit" name="submitregistratie">Registreren</button>
            </div>
        </form>

        <?php

        if (isset($_POST['submitregistratie'])) {
//            alle ingevulde velden ophalen
            $voornaam = $_POST['voornaamveld'];
            $achternaam = $_POST['achternaamveld'];
            $studentnummer = $_POST['studentnummerveld'];
            $email = $_POST['emailveld'];
            $wachtwoord = $_POST['wachtwoordveld'];
            $klas = $_POST['klasveld'];
            $adres = $_POST['adresveld'];
            $postcode = $_POST['postcodeveld'];
            $woonplaats = $_POST['woonplaatsveld'];
            $leeftijd = $_POST['leeftijdveld'];

            $wachtwoordHASH = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO accounts_studenten (studentnummer, email, wachtwoord, klas, voornaam, achternaam, adres, postcode, woonplaats, leeftijd, level)
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//            level student is altijd 1
            $level = 1;
            $stmt->bind_param("issssssssis", $studentnummer, $email, $wachtwoordHASH, $klas, $voornaam, $achternaam, $adres, $postcode, $woonplaats, $leeftijd, $level);

            $stmt->execute();

            if ($stmt) {
                header("location: login.php");
            } else {
                echo 'Er is iets fout gegaan';
            }

        }

        ?>
    </div>
</div>
</body>
</html>