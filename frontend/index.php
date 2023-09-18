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
<div class="fondotext"><h1 class="titol">Playlists</h1></div>




<details>
  <summary>Question number 2</summary>
  
</details>
  
  <details>
  <summary>Question number 3</summary>
  <p>Another FAQ answer, and it looks like it was also hidden.</p>
</details>
  
  <details>
  <summary>Question number 4</summary>
  <p>Another response, and it seems that they are still not giving us any information.</p>
</details>
  
  <details>
  <summary>And question number 5</summary>
  <p>It seems that this is already the last answer. Finally we have reached the end!</p>
</details>



<div class="playlists" id="playlists">


</div>



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
        <input class="progreso" type="range">
        <input class="volum" type="range">
        <div class="status-box">

        </div>

    </div>
    <div class="playlists">


    </div>




</body>
</html>
