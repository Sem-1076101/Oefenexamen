<?php
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
    <title>Gegevens Aanpassen</title>
    <link rel="stylesheet" href="css/aanpas.css">
    <link rel="stylesheet" href="css/form.css">

</head>
<body>
<div class="container">
    <div class="inner-container">
        <div class="titel">
            Account aanpassen
        </div>
        <form action="" method="post" class="aanpas-stu-gegevens">
<!--            form om studentgegevens aan te passen, alles is al ingevuld met sessions die bij de login zijn aangemaakt-->

            <div>
                <label for="studentnummer">Studentnummer</label>
                <input type="number" name="studentnummerveld" required value="<?= $_SESSION['studentnummer']; ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="emailveld" required value="<?= $_SESSION['email']; ?>">
            </div>
            <div>
                <label for="voornaam">Voornaam</label>
                <input type="text" name="voornaamveld" required value="<?= $_SESSION['voornaam']; ?>">
            </div>
            <div>
                <label for="achternaam">Achternaam</label>
                <input type="text" name="achternaamveld" required value="<?= $_SESSION['achternaam']; ?>">
            </div>
            <div>
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" name="wachtwoordveld" required>
            </div>
            <div>
                <label for="klas">Klas</label>
                <input type="text" name="klasveld" required value="<?= $_SESSION['klas']; ?>">
            </div>
            <div>
                <label for="adres">Adres</label>
                <input type="text" name="adresveld" required value="<?= $_SESSION['adres']; ?>">
            </div>
            <div>
                <label for="postcode">Postcode</label>
                <input type="text" name="postcodeveld" required value="<?= $_SESSION['postcode']; ?>">
            </div>
            <div>
                <label for="woonplaats">Woonplaats</label>
                <input type="text" name="woonplaatsveld" required value="<?= $_SESSION['woonplaats']; ?>">
            </div>
            <div>
                <label for="leeftijd">Leeftijd</label>
                <input type="text" name="leeftijdveld" pattern="\d*" maxlength="2" value="<?= $_SESSION['leeftijd']; ?>" required>
            </div>
            <div>
                <a class="terug-a" href="student.php">Terug</a>
                <button class="submit-form" type="submit" name="submitregistratie">Versturen</button>
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

//            wachtwoord opnieuw hashen
            $wachtwoordHASH = password_hash($wachtwoord, PASSWORD_DEFAULT);

//            update stmt met als key het oude studentnummer
            $stmt = $conn->prepare("UPDATE accounts_studenten SET studentnummer = ?, email = ?, wachtwoord = ?, klas = ?, voornaam = ?, achternaam = ?, adres = ?, postcode = ?, woonplaats = ?, leeftijd = ? WHERE studentnummer = ?");

            $studentnummerOud = $_SESSION['studentnummer'];

            $stmt->bind_param('issssssssii', $studentnummer,$email, $wachtwoordHASH, $klas, $voornaam, $achternaam, $adres, $postcode, $woonplaats, $leeftijd, $studentnummerOud);
            $stmt->execute();

            if ($stmt) {
                header("location: student.php");

            } else {

                echo 'Er is iets fout gegaan';
            }

        }

        ?>
    </div>
</div>
</body>
</html>