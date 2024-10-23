<?php
session_start();

require 'config/config.php';
include 'header.php';
//checken of de level klopt
if ($_SESSION['level'] == 1) {
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student</title>
    <link rel="stylesheet" href="css/student.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/JS.js" defer></script>
</head>
<body>
<!--beginnen met info over de student zelf-->
<div class="container">
    <div class="inner-container">
        <div class="titel-student">
            <h1>Welkom <?= $_SESSION['voornaam'] . " " . $_SESSION['achternaam']; ?></h1>
        </div>
        <div class="container-info-student">
            <div class="info-student">
                <div class="links">
                    <p>Studentnummer: <?= $_SESSION['studentnummer']; ?></p>
                    <p>Klas: <?= $_SESSION['klas']; ?></p>
                    <p>Leeftijd: <?= $_SESSION['leeftijd']; ?></p>
                </div>
                <div class="rechts">
                    <p>Adres: <?= $_SESSION['adres']; ?></p>
                    <p>Postcode: <?= $_SESSION['postcode']; ?></p>
                    <p>Woonplaats: <?= $_SESSION['woonplaats']; ?></p>
                </div>
            </div>
            <div class="aanpas-btn">
                <a href="aanpas-studentgegevens.php">Aanpassen</a>
            </div>
        </div>
    </div>
    <?php
    //    hier kijken of de student al een form ingevuld heeft, zo niet dan krijgt die de form te zien en anders niet.
    $studentnummer = $_SESSION['studentnummer'];
    $stmt = $conn->prepare("SELECT * FROM formulier_student WHERE studentnummer = ?");
    $stmt->bind_param('i', $studentnummer);
    $stmt->execute();

    $ophalenForm = $stmt->get_result();
    $resultForm = $ophalenForm->fetch_assoc();

    if (!$resultForm) {
    ?>
    <!--formulier-->
    <div class="formulier-container">
        <div>
            <div class="titel-student">
                <h1>Enquête invullen</h1>
            </div>
            <div class="form">
                <form action="" method="post" class="form-enquete">
                    <div>
                        <label for="vraag_1">Hoeveel kilometer woon je van het GLR</label>
                        <input type="text" name="vraag_1veld" pattern="\d*" maxlength="3" required>
                    </div>
                    <div>
                        <label for="vraag_2">Hoe lang doe je er over om van huis naar
                            GLR te reizen?</label>
                        <input type="text" name="vraag_2veld" pattern="\d*" maxlength="3" required>
                    </div>

                    <div>
                        <!--                        dit is een multiple select option, de naam is daarom in een array die ik later convert naar string-->
                        <label for="vraag_3">Welke voermiddel(en) gebruik je om naar
                            het GLR te reizen?</label>
                        <select id="multiple-select" multiple="multiple" name="vraag_3veld[]" required>
                            <option value="Trein">Trein</option>
                            <option value="Tram">Tram</option>
                            <option value="Metro">Metro</option>
                            <option value="Auto">Auto</option>
                            <option value="Fiets">Fiets</option>
                            <option value="Lopend">Lopend</option>
                        </select>
                    </div>
                    <div>
                        <label for="vraag_4">Wat vind je van de begintijd van de
                            lessen (8:15 uur)?</label>
                        <select name="vraag_4veld" class="select-box" required>
                            <option class="test" value="Te vroeg">Te vroeg</option>
                            <option value="Goed">Goed</option>
                            <option value="Te laat">Te laat</option>
                        </select>
                    </div>
                    <div>
                        <label for="vraag_5">Wat vind je van de eindtijd van de lessen
                            (17:15 uur)?</label>
                        <select name="vraag_5veld" class="select-box" required>
                            <option value="Te vroeg">Te vroeg</option>
                            <option value="Goed">Goed</option>
                            <option value="Te laat">Te laat</option>
                        </select>
                    </div>
                    <div>
                        <label for="vraag_6">Heb je verder nog opmerkingen over het
                            reizen naar het GLR?</label>
                        <textarea name="vraag_6veld" id="#" cols="10" rows="10" required></textarea>
                    </div>
                    <div>
                        <button class="submit-form" type="submit" name="submit-form">Versturen</button>
                    </div>
                </form>
                <?php

                if (isset($_POST['submit-form'])) {
//                    invoervelden ophalen
                    $vraag1 = $_POST['vraag_1veld'];
                    $vraag2 = $_POST['vraag_2veld'];
                    $vraag3Array = $_POST['vraag_3veld'];
                    $vraag4 = $_POST['vraag_4veld'];
                    $vraag5 = $_POST['vraag_5veld'];
                    $vraag6 = $_POST['vraag_6veld'];


//                    array converten naar string met komma ertussen
                $vraag3 = implode(', ', $vraag3Array);

                $stmt = $conn->prepare("INSERT INTO formulier_student (studentnummer, vraag_1, vraag_2, vraag_3, vraag_4, vraag_5, vraag_6) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('iiissss', $studentnummer, $vraag1, $vraag2, $vraag3, $vraag4, $vraag5, $vraag6);
                $stmt->execute();

                if ($stmt) {
                //                        header("Refresh:0");
                //                        header(" location: http://localhost/Oefenexamen/student.php");
                ?>
                    <script>
                        window.location.replace("http://localhost/Oefenexamen/student.php");
                    </script>

                    <?php
                } else {
                    echo 'fout gegaan';
                }

                }

                ?>
            </div>
        </div>
        <?php
        }
        else {
            ?>
            <div class="titel-student">
                <h3>Je formulier is al ingevuld!</h3>
                <p>Jouw antwoorden</p>
            </div>
            <div class="info-form">
                <div class="grid-layout">
                    <div class="layout1">Hoeveel kilometer woon je van het GLR?</div>
                    <div class="layout2"><?= $resultForm['vraag_1']; ?> km</div>
                </div>
                <div class="grid-layout">
                    <div>Hoe lang doe je er over om van huis naar
                        GLR te reizen?
                    </div>
                    <div><?= $resultForm['vraag_2']; ?> min</div>
                </div>
                <div class="grid-layout">
                    <div>Welke voermiddel(en) gebruik je om naar
                        het GLR te reizen?
                    </div>
                    <div><?= $resultForm['vraag_3']; ?></div>
                </div>
                <div class="grid-layout">
                    <div>Wat vind je van de begintijd van de
                        lessen (8:15 uur)?
                    </div>
                    <div><?= $resultForm['vraag_4']; ?></div>
                </div>
                <div class="grid-layout">
                    <div>Wat vind je van de eindtijd van de lessen
                        (17:15 uur)?
                    </div>
                    <div><?= $resultForm['vraag_5']; ?></div>
                </div>
                <div class="grid-layout">
                    <div>Heb je verder nog opmerkingen over het
                        reizen naar het GLR?
                    </div>
                    <div><?= $resultForm['vraag_6']; ?></div>
                </div>
                <div class="aanpas-btn">
                    <a href="aanpas.php">Aanpassen</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php

}
else {
    header("location: login.php");
}

?>
</body>
</html>