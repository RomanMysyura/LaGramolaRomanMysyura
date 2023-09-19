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
    <script src="scripts.js" defer></script>
    <title>Gramola MP3</title>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="index.php">Playlists</a></li>
        <li><a href="infotecnica.php">Informació Tècnica</a></li>
        <li><a href="crearplaylist.php">Crear Playlist</a></li>
    </ul>
</nav>





<form class="nomusuari" name="formulario" method="post">

    Nom: <input type="text" name="nom" value="">

<input type="submit" />

</form>


<?php

if (isset($_POST["nom"]))  {
    $nom = $_POST['nom'];
    $_SESSION["usuari"] = $nom;
}

if (isset($_SESSION["usuari"])) {
    echo "<p>Nom del usuari: " . $_SESSION["usuari"] . "</p>";
}

?>







<div class="fondotext"><h1 class="titol">Playlists</h1></div>




    <div class="reproductor">

        <div class="art-box">
            <div class="logosong">
                
                <img src='<?= $songs[$songid]->image ?>' class="iconasong" alt="Logo de la cancó" width="300" height="200">
            </div>
            <h3 class="nomsong"><?=$songs[$songid]->num," - " , $songs[$songid]->title ?></h3>
        </div>

        <div class="controls-box">
            <button onclick="previousSong('<?= $songid ?>')"><img src="images/rebobinar.svg"></button>
            <button onclick="stopSong()"><img src="images/detengase.svg"></button>
            <button class="botoprincipal" onclick="playPause()"><img src="images/tocar.svg"></button>
            <button onclick="nextSong('<?= $songid ?>')"><img src="images/delantero.svg"></button>
            <button onclick="randomSong('<?= count($songs)?>', '<?=$songid?>')"><img src="images/barajar.svg"></button>
            
        </div>
        <input class="progreso" type="range" value="">
        <input class="volum" type="range">
        <div class="status-box">

        </div>

    </div>


    
    <div class="musica">
        <div class="playlists" id="playlists">

        </div>
    

    </div>


    




</body>
</html>
