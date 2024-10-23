<?php
//om links gelijk vanuit ROOT te laten zoeken
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
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/form.css">

</head>
<body>
<?php
//include(__ROOT__.'/Oefenexamen/header.php');
?>
<div class="container">
    <div class="left">
        <div class="titel">
            <h1>Inloggen</h1>
        </div>
        <div class="form-login">
            <form action="" method="post" class="inlog-form">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="emailveld" required>
                </div>
                <div>
                    <label for="wachtwoord">Wachtwoord</label>
                    <input type="password" name="wachtwoordveld" required>
                </div>
                <div class="btn-2">
                    <button class="login-btn" type="submit" name="login">Inloggen</button>
                </div>

        </div>
        </form>


        <?php

        //        als het form ingevuld is declareer ik eerst de invoervelden

        if (isset($_POST['login'])) {
            $email = $_POST['emailveld'];
            $wachtwoord = $_POST['wachtwoordveld'];

//            dan kijk ik of ze in de docenten tabel zitten
            $stmt = $conn->prepare("SELECT * FROM accounts_docenten WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $userDocent = $result->fetch_assoc();

//            dan wachtwoord verify

            if ($userDocent['wachtwoord']) {
                if (password_verify($wachtwoord, $userDocent['wachtwoord'])) {
                    if ($userDocent) {
                        $_SESSION['voornaam'] = $userDocent['voornaam'];
                        $_SESSION['achternaam'] = $userDocent['achternaam'];
                        $_SESSION['level'] = $userDocent['level'];

//                        als gebruiker ingelogd is doorsturen naar hun pagina
                        header('location: docent.php');
                    }
                } else {
                    ?>
                    <div class="inlogfout">
                        <p>Ongeldige e-mail of wachtwoord.</p>
                    </div>

                    <?php
                }


            } else {
//            als die klopt session variabeles aanmaken voor docent

//                als hij geen docent vindt met die email en ww, dan kijkt hij voor studenten en herhaal ik de methode
                $stmt = $conn->prepare("SELECT * FROM accounts_studenten WHERE email = ?");
                $stmt->bind_param('s', $email);
                $stmt->execute();

                $result = $stmt->get_result();
                $userStudent = $result->fetch_assoc();


                if (isset($userStudent['wachtwoord'])) {

                    if (password_verify($wachtwoord, $userStudent['wachtwoord'])) {

//                        var_dump(password_verify($wachtwoord, $userStudent['wachtwoord']));

                        $_SESSION['id'] = $userStudent['id'];
                        $_SESSION['voornaam'] = $userStudent['voornaam'];
                        $_SESSION['achternaam'] = $userStudent['achternaam'];
                        $_SESSION['email'] = $userStudent['email'];
                        $_SESSION['studentnummer'] = $userStudent['studentnummer'];
                        $_SESSION['klas'] = $userStudent['klas'];
                        $_SESSION['adres'] = $userStudent['adres'];
                        $_SESSION['postcode'] = $userStudent['postcode'];
                        $_SESSION['woonplaats'] = $userStudent['woonplaats'];
                        $_SESSION['leeftijd'] = $userStudent['leeftijd'];
                        $_SESSION['level'] = $userStudent['level'];

//                        als gebruiker ingelogd is doorsturen naar hun pagina
                        header("location:student.php");
//                        var_dump($_SESSION['level']);
                    } else {
                        ?>

                        <div class="inlogfout">
                            <p>Ongeldige e-mail of wachtwoord.</p>
                        </div>

                        <?php
                    }

                } else {
                    ?>

                    <div class="inlogfout">
                        <p>Ongeldige e-mail of wachtwoord.</p>
                    </div>

                    <?php

                }
            }
        }


        ?>

    </div>
    <div class="right">
        <div>
            <div class="container-a">
                <p>Nog geen account? Registreer hier</p>
                <a href="registreren.php">Registreren</a>
            </div>
        </div>
    </div>
</div>


</body>
</html>