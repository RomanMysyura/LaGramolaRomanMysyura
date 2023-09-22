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
    <title>Crear Playlist</title>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="index.php">Playlists</a></li>
        <li><a href="infotecnica.php">Informació Tècnica</a></li>
        <li><a href="crearplaylist.php">Crear Playlist</a></li>
    </ul>
</nav>
<?php

if (isset($_POST["nom"]))  {
    $nom = $_POST['nom'];
    $_SESSION["usuari"] = $nom;
}

if (isset($_SESSION["usuari"])) {
    echo "<p>Nom del usuari: " . $_SESSION["usuari"] . "</p>";
}



?>
<div class="fondotext">
    <h1 class="titol">Crear Playlist</h1>
</div>

<div class="divCreacioPlayist">
<form action="guardar_playlist.php" method="post" id="formulariplaylists">
    <label for="nom_playlist" id="titolcrearplaylist">Nom de la playlist:</label>
    <input id="nom_playlist" type="text" name="nom_playlist" required>
        <br><br>
        <div class="divMostrarcançons">
        <details>
            <summary><h3>Clica per afegir les cançons</h3></summary>

            <?php
        $songs = json_decode(file_get_contents("songs.json"), true);
            foreach ($songs as $song) {
                echo "<input type='checkbox' name='cancons[]' value='{$song['num']}'>  {$song['title']}<br>";
        }
    ?>

        </details>
        </div>
    

        <br>
    <input id="enviarplaylist" type="submit" value="Enviar">
</form>
</div>



<div class="divCreacioPlayist">
    <br>
    <label for="nom_playlist" id="titoleliminarplaylist">Eliminar la playlist:</label>
    <br><br>


        
    <?php
        $playlists = json_decode(file_get_contents("playlists.json"), true);
            foreach ($playlists as $playlist) {
        echo "
            <div id='eliminarplaylist'>{$playlist['name']} 
                <a href='eliminar_playlist.php?id={$playlist['id']}'>Eliminar</a>
            </div>";
        }
    ?>

    <br>
</div>


</body>
</html>
