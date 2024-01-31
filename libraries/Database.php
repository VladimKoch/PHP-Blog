<?php

/*-----------------------------------------
            Spojení s databází
------------------------------------------*/

$server="localhost";
$user="Vlada89";
$pass="Tyr2017";
$name = "blog";


$conn = new mysqli($server,$user,$pass,$name);
 
/*----------- Kontrola chyby --------------*/

if ($conn -> connect_errno){
    die('Prihlašeni k databazi se nezdařilo: ' . $conn->connect_errno);
    exit();
}

// else{
//    echo 'Spojeni s databází proběhlo úspěšně';
// }

/*--------------------------------------------------
             SQL dotaz, tvroba tabulky
----------------------------------------------------*/
 $db_posts =

    "CREATE TABLE IF NOT EXISTS posts(
    id INT (11) NOT NULL AUTO_INCREMENT,
    category INT (11) ,
    title VARCHAR (255),
    body TEXT ,
    author VARCHAR (255),
    tags VARCHAR (255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id))";

$db_categories =

    "CREATE TABLE IF NOT EXISTS categories(
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR (255) NOT NULL,
        PRIMARY KEY (id))";

/*----------------- Kontrola zda tabulka existuje -----------------*/
    if ($conn -> query($db_posts) && $conn->query($db_categories) === TRUE) {
        print("<br> Tabulky byly vytvořeny");
    }

?>