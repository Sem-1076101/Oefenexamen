<?php
session_start();
require 'config/config.php';
if ($_SESSION['level'] == 1) {
    ?>
    <script>
        window.location.replace("http://localhost/Oefenexamen/login.php");
    </script>

    <?php
} else {

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Docent</title>
        <link rel="stylesheet" href="css/docent.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/JS.js" defer></script>
        <link rel="stylesheet" href="css/form.css">
    </head>
    <body>
    <?php
    include 'header.php';
    ?>
    <div class="container">
        <div class="inner-container">
            <div class="titel">
                <h1>Welkom <?= $_SESSION['voornaam'] . " " . $_SESSION['achternaam']; ?></h1>
            </div>
            <div class="info">
                <form action="" method="post" class="form-zoeken">
                    <div><h2>Leerling zoeken</h2></div>
                    <div>
                        <label for="">Studentnummer</label>
                        <input type="number" name="studentveld">
                    </div>
                    <div>
                        <button class="zoek-btn" type="submit" name="submitstudent">Zoeken</button>
                    </div>
                </form>

                <?php

                if (isset($_POST['submitstudent'])) {
                    $studentnummer = $_POST['studentveld'];

                    $stmt = $conn->prepare("SELECT * FROM accounts_studenten WHERE studentnummer = ?");
                    $stmt->bind_param('i', $studentnummer);
                    $stmt->execute();

                    $get = $stmt->get_result();
                    $resultStudent = $get->fetch_assoc();


                    $stmtForm = $conn->prepare("SELECT * FROM formulier_student WHERE studentnummer= ?");
                    $stmtForm->bind_param('i', $studentnummer);
                    $stmtForm->execute();

                    $getForm = $stmtForm->get_result();
                    $resultForm = $getForm->fetch_assoc();


                    if ($resultStudent) {


                        ?>
                        <div class="student-data">

                            <div class="student-titel">
                                <h2>Gegevens
                                    van <?= $resultStudent['voornaam'] . ' ' . $resultStudent['achternaam']; ?></h2>
                            </div>
                            <div class="container-info-student">
                                <div class="info-student">
                                    <div class="links">
                                        <p>Studentnummer: <?= $resultStudent['studentnummer']; ?></p>
                                        <p>Klas: <?= $resultStudent['klas']; ?></p>
                                        <p>Leeftijd: <?= $resultStudent['leeftijd']; ?></p>
                                    </div>
                                    <div class="rechts">
                                        <p>Adres: <?= $resultStudent['adres']; ?></p>
                                        <p>Postcode: <?= $resultStudent['postcode']; ?></p>
                                        <p>Woonplaats: <?= $resultStudent['woonplaats']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="student-form">
                            <div class="student-titel">
                                <h1>Ingevulde Enquête</h1>
                            </div>
                            <?php
                            if ($resultForm) {
                                ?>
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
                                <?php
                            } else {
                                ?>
                                <div class="student-titel">De leerling moet het formulier nog invullen!</div>
                                <?php
                            }
                            ?>

                        </div>
                        <?php

                    } else {
                        ?>
                        <div class="student-titel">Gekozen leerling bestaat niet!</div>
                        <?php
                    }

//            $sql = "SELECT accounts_studenten.studentnummer, formulier_student.studentnummer
//                    FROM accounts_studenten INNER JOIN formulier_student
//                    ON accounts_studenten.studentnummer = formulier_student.studentnummer
//                    WHERE studentnummer = ?";
//            $stmt = $conn->prepare($sql);
//            $stmt->bind_param('i', $studentnummer);
//
//            $get = $stmt->get_result();
//            $result = $get->fetch_assoc();
//
//            if($result) {
//                echo $result['voornaam'];
//            }
                }


                ?>
            </div>
        </div>
    </div>


    </body>
    </html>
    <?php
}

?>