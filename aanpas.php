<?php
session_start();
require 'config/config.php';

if ($_SESSION['level'] == 1) {


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aanpassen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/JS.js" defer></script>
    <link rel="stylesheet" href="css/student.css">
</head>
<body>

<!--<div class="container">-->
<!--    <div class="form-aanpas">-->
<!--        <form action="" method="post">-->
<!--            <div>-->
<!--                <label for="veranderen">Wat wil je aanpassen?</label>-->
<!--                <select name="select-aanpas">-->
<!--                    <option value="X">Kies een optie...</option>-->
<!--                    <option value="form">Formulier</option>-->
<!--                    <option value="eigen-info">Eigen informatie</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div>-->
<!--                <a href="student.php">Terug</a>-->
<!--                <button type="submit" name="submitKeuze">Verder</button>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<?php

//    if (isset($_POST['submitKeuze'])) {
//        if ($_POST['select-aanpas'] == 'form') {

//            eerst studentnummer van de persoon die ingelogd is ophalen
$studentnummer = $_SESSION['studentnummer'];

//            met prepared statements formulier uit de databse halen met het opgehaalde studentnummer
$stmtForm = $conn->prepare("SELECT * FROM formulier_student WHERE studentnummer= ?");
$stmtForm->bind_param('i', $studentnummer);
$stmtForm->execute();

//            info ophalen
$getForm = $stmtForm->get_result();
$resultForm = $getForm->fetch_assoc();
?>
<div class="container">
    <div class="inner-container">
        <div class="titel-student">Enquête aanpassen</div>
        <form action="" method="post" class="form-enquete">
            <!--                form om de vragenlijst opnieuw in te vullen-->
            <div>
                <label for="vraag_1">Hoeveel kilometer woon je van het GLR?</label>
                <input type="number" name="vraag_1veld" value="<?= $resultForm['vraag_1']; ?>" required>
            </div>
            <div>
                <label for="vraag_2">Hoe lang doe je er over om van huis naar
                    GLR te reizen?</label>
                <input type="number" name="vraag_2veld" value="<?= $resultForm['vraag_2']; ?>">
            </div>

            <div>
                <!--                        dit is een multiple select option, de naam is daarom in een array die ik later convert naar string-->
                <label for="vraag_3">Welke voermiddel(en) gebruik je om naar
                    het GLR te reizen?</label>
                <select id="multiple-select" multiple="multiple" name="vraag_3veld[]">
                    <option value="Trein">Trein</option>
                    <option value="Tram">Tram</option>
                    <option value="Metro">Metro</option>
                    <option value="Bus">Bus</option>
                    <option value="Auto">Auto</option>
                    <option value="Fiets">Fiets</option>
                    <option value="Lopend">Lopend</option>
                </select>
            </div>
            <div>
                <label for="vraag_4">Wat vind je van de begintijd van de
                    lessen (8:15 uur)?</label>
                <select name="vraag_4veld" id="#">
                    <option value="Te vroeg">Te vroeg</option>
                    <option value="Goed">Goed</option>
                    <option value="Te laat">Te laat</option>
                </select>
            </div>
            <div>
                <label for="vraag_5">Wat vind je van de eindtijd van de lessen
                    (17:15 uur)?</label>
                <select name="vraag_5veld" id="#">
                    <option value="Te vroeg">Te vroeg</option>
                    <option value="Goed">Goed</option>
                    <option value="Te laat">Te laat</option>
                </select>
            </div>
            <div>
                <label for="vraag_6">Heb je verder nog opmerkingen over het
                    reizen naar het GLR?</label>
                <textarea name="vraag_6veld" id="#" cols="30" rows="10"><?= $resultForm['vraag_6']; ?></textarea>
            </div>
            <div>
                <a class="terug-a" href="student.php">Terug</a>
                <button class="submit-form" type="submit" name="submit-form">Versturen</button>
            </div>
        </form>
        <?php

        if (isset($_POST['submit-form'])) {
//                invoervelden ophalen
            $vraag1 = $_POST['vraag_1veld'];
            $vraag2 = $_POST['vraag_2veld'];
            $vraag3Array = $_POST['vraag_3veld'];
            $vraag4 = $_POST['vraag_4veld'];
            $vraag5 = $_POST['vraag_5veld'];
            $vraag6 = $_POST['vraag_6veld'];


//                    array converten naar string met kommas ertussen
            $vraag3 = implode(', ', $vraag3Array);
//                de meerderekeuze vraag die meer dan een keer ingevuld kan worden omzetten naar string

//                update statement met weer als key het studentnummer
            $stmt = $conn->prepare("UPDATE formulier_student SET vraag_1 = ?, vraag_2 = ?, vraag_3 = ?, vraag_4 = ?, vraag_5 = ?, vraag_6 = ? WHERE studentnummer = ?   ");
            $stmt->bind_param('iissssi', $vraag1, $vraag2, $vraag3, $vraag4, $vraag5, $vraag6, $studentnummer);
            $update = $stmt->execute();

//                als de update gelukt is terugsturen naar student pagina
            if ($update) {
                ?>
                <script>
                    window.location.replace("http://localhost/Oefenexamen/student.php");
                </script>

                <?php
            }

        }


        }
        else {
            ?>
            <script>
                window.location.replace("http://localhost/Oefenexamen/login.php");
            </script>

            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
