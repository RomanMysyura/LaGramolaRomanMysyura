<?php
session_start();
$songs = json_decode(file_get_contents("songs.json"));
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="images/jukeboxlogo.png">
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









    <div class="reproductor">

        <div class="art-box">
            <div class="logosong">
                <img src="images/BillieEilish1.png" class="iconasong" alt="Logo de la cancó" width="300" height="200">
            </div>
            <h3 class="nomsong">Billie Eilish - What Was I Made For?</h3>
        </div>

        <div class="controls-box">
            <button onclick="previousSong()"><img src="images/rebobinar.svg"></button>
            <button onclick="playPause()"><img src="images/tocar.svg"></button>
            <button onclick="stopSong()"><img src="images/detengase.svg"></button>
            <button onclick="nextSong()"><img src="images/delantero.svg"></button>
            <button onclick="randomSong()"><img src="images/simbolos.svg"></button>
        </div>

        <div class="status-box">

        </div>

    </div>
    <div class="playlists">


    </div>







</body>
</html>
