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
<!-- Menu -->
<nav class="menu">
    <ul>
        <li><a href="index.php">Playlists</a></li>
        <li><a href="infotecnica.php">Informació Tècnica</a></li>
        <li><a href="crearplaylist.php">Crear Playlist</a></li>
    </ul>
</nav>
<?php
//Escriu el nom del usuari que esta guardat a la sessio
if (isset($_POST["nom"]))  {
    $nom = $_POST['nom'];
    $_SESSION["usuari"] = $nom;
}

if (isset($_SESSION["usuari"])) {
    echo "<p>" . $_SESSION["usuari"] . "</p>";
}


?>
<div class="fondotext">
    <h1 class="titol">Crear Playlist</h1>
</div>

<div class="divCreacioPlayist">
    <!-- Formulari per crear la playlist -->
<form action="guardar_playlist.php" method="post" id="formulariplaylists"> 
    <label for="nom_playlist" id="titolcrearplaylist">Nom de la playlist:</label>
    <input id="nom_playlist" type="text" name="nom_playlist" required>
        <br><br>
        <!-- Aqui mostrem les cançons disponibles -->
        <div class="divMostrarcançons">
        <details>
            <summary><h3>Clica per afegir les cançons</h3></summary>
            <?php
            // Mostra les cançons disponibles
                $songs = json_decode(file_get_contents("songs.json"), true);
                foreach ($songs as $song) {
                    // Amb el checkbox podem seleccionar les cançons
                    echo "<input type='checkbox' name='cancons[]' value='{$song['num']}'>  {$song['title']}<br>";
                }
            ?>

        </details>
        </div>
    

        <br>
        <!-- S'esxecutara el arxiu "guardar_playlist.php" cliquem submit-->
    <input id="enviarplaylist" type="submit" value="Enviar">
</form>
</div> 


<!-- Aquesta part seveix per pujar arxius -->
<div class="divCreacioPlayist">
    <br>
    <form action="add_song.php" method="post" enctype="multipart/form-data" class="">
        <label for="artist">Artista:</label>
        <input class="posarartista" type="text" name="artist" required><br><br>
        
        <label for="title">Titol de la cançó:</label>
        <input class="posartitolsong" type="text" name="title" required><br><br>
        
        <label for="image">Imatge (PNG):</label>
        <input class="posarimatge" type="file" name="image" accept=".png" required><br><br>
        
        <label for="song">Cançó (MP3):</label>
        <input class="posarsong" type="file" name="song" accept=".mp3" required><br><br>
        
        <input class="enviarsong" type="submit" value="AFEGIR CANÇÓ">
    </form>
    <br>
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
