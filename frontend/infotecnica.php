<?php
session_start();
$songs = json_decode(file_get_contents("songs.json"));

$songid = 0;

if (!isset($_GET["songid"])) {
    $songid = 0;
} else {
    $songid = $_GET["songid"];
    if ($songid > count($songs) - 1) {
        $songid = 0;
    }
};
if ($songid == -1) {
    $songid = count($songs) - 1;
}








?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="images/jukeboxlogo.png">
    <title>Informació Tècnica</title>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="index.php">Playlists</a></li>
        <li><a href="infotecnica.php">Informació Tècnica</a></li>
        <li><a href="crearplaylist.php">Crear Playlist</a></li>
    </ul>
</nav>

<div class="fondotext"><h1 class="titol">Informació Tècnica</h1></div>

<div class="informaciotecnica">


</div>

<div class="DivUltimaPlaylist"> 
<?php


//Si hi ha valor a la nostra cookie, escriura per pantalla la valor
if(isset($_COOKIE["ultimaPlaylist"])&&($_COOKIE["DataDeLaUltimaPlaylist"])) {
    
    echo "<h3 class='ultimaPlaylist'>"," Ultima playlist reproduida"," a les: " . $_COOKIE["DataDeLaUltimaPlaylist"] ."<li><a class='lastplay' href='index.php'>", $_COOKIE["ultimaPlaylist"] ,"</a></li>" ,"</h3>";

}
?>
</div>

<div class="DivUltimaPlaylist"> 
<h3 class='ultimaPlaylist'> Top cançons:</h3>

<?php
        $songs = json_decode(file_get_contents("songs.json"), true);

        usort($songs, function($a, $b) {
            // Si quieres ordenar de mayor a menor usamos $b contra $a
            return $b['reproduccions'] - $a['reproduccions'];
        });
            foreach ($songs as $song) {
               
                echo "<b>",$song['reproduccions']," - " , $song['title'] ,'<br>';
        }
?>



</div>



<?php
if (isset($_POST["nom"]))  {
    $nom = $_POST['nom'];
    $_SESSION["usuari"] = $nom;
}

if (isset($_SESSION["usuari"])) {
    echo "<p>Nom del usuari: " . $_SESSION["usuari"] . "</p>";
}

?>





</body>
</html>
