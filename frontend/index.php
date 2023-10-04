<?php
//Serveix per obrir una sessió
session_start();
//Serverix per cambiar posar la zona horaria
date_default_timezone_set('Europe/Madrid');
//Aquesta part serveix per agafar la cancó del arxiu songs.json a partir de la la id
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

// - Aixo es la part de las cookies
if(isset($songid)) {
    // Busquem la playlist que te la cançó B
    $playlistData = file_get_contents("playlists.json");
    $playlists = json_decode($playlistData, true);

    // $currentPlaylistName = null; // Seveix per si la canço no esta en cap playlist, que no hi hagi cap error
    // $dataDeLaPlaylist = null; // Seveix per lo mateix pero per la data
    
    foreach($playlists as $playlist) {
        if(in_array($songid, $playlist["songs"])) {
            $currentPlaylistName = $playlist["name"]; // Assignem a la variabla al nom de la playlist
            $dataDeLaPlaylist = date('Y-m-d H:i:s');
            break;
        }
    }

    // Si trobem la canco en una playlist, guardem el nom de la playlist 
    if($currentPlaylistName !== "") {
		// Guardem el nom de la ultima playlist reproduida, la cookie es caduca en 1 hora
        setcookie("ultimaPlaylist", $currentPlaylistName, time() + 3600, "/"); 
		// Guardem la data de la ultima playlist reproduida, la cookie es caduca en 1 hora
        setcookie("DataDeLaUltimaPlaylist", $dataDeLaPlaylist, time() + 3600, "/");
    }
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
	


		<!-- Menu -->
		<nav class="menu">
			<ul> 
				<li><a href="index.php">Playlists</a></li>
				<li><a href="infotecnica.php">Informació Tècnica</a></li>
				<li><a href="crearplaylist.php">Crear Playlist</a></li>
			</ul>
		</nav>
		
<!-- Formulari per introduir el nom del usuari -->
		<form class="nomusuari" name="formulario" method="post">
			<input class="textnom" type="text" name="nom" value="" placeholder=" Introdueix el teu nom:">
			<input class="enviar" type="submit" />
		</form>

		<!-- Serveix per guardar el nom del usuari en una sessió -->
		<?php
                if (isset($_POST["nom"]))  {
                    $nom = $_POST['nom'];
                    $_SESSION["usuari"] = $nom;
                }   
                if (isset($_SESSION["usuari"])) {
                    echo "<p>" . $_SESSION["usuari"] . "</p>";
                }
        ?>
			<audio id="player"></audio>
			<div class="fondotext">
				<h1 class="titol">Playlists</h1></div>

				<!-- Div del Reproductor -->
			<div class="reproductor">
				<div class="art-box">
					<div class="logosong">
                			<!-- Busca la ruta del imatge a partir la id  -->
						<img src='<?= $songs[$songid]->image ?>' id="rotateiconasong" class="iconasong" alt="Logo de la cancó" width="300" height="200">
					</div>
							<!-- Busca el nom de la canço a partir de la id -->
					<h3 id="idnomsong" class="nomsong"><?= $songs[$songid]->title ?></h3>
				</div>
					<!-- Div dels buttons del reproductor -->
				<div class="controls-box">
					<button onclick="previousSong('<?= $songid ?>')"><img id="bcntrlbefore" src="images/rebobinar.svg"></button>
					<button onclick="stopSong()"><img id="bcntrlstop" src="images/detengase.svg"></button>
					<button class="botoprincipal" onclick="playPause()"><img id="bcntrlplay" src="images/tocar.svg"></button>
					<button onclick="nextSong('<?= $songid ?>')"><img id="bcntrlnext" src="images/delantero.svg"></button>
					<button onclick="randomSong('<?= count($songs)?>', '<?=$songid?>')"><img id="bcntrlrandom" src="images/barajar.svg"></button>
				</div>
				
				<!-- La barra de progress -->
				<input class="progreso" type="range" min="0" value="0" max=100>

				<!-- La barra per pujar o baixar el volum -->
				<input class="volum" type="range">

				<!-- Div, on posa el temps real i temps total de la cançó -->
				<div class="status-box">
					<span id="currentTime">00:00</span> <span id="totalTime">00:00</span>
				</div>
			</div>


			<!-- Es el div on s'afegeixen automaticament les playlists -->
			<div class="musica"><div class="playlists" id="playlists"></div></div>


			<!-- Son els div de les barres falses del volum -->
			<div id="IDequalizer">
				<div id="IDequalizer1"></div>
				<div id="IDequalizer2"></div>
				<div id="IDequalizer3"></div>
				<div id="IDequalizer4"></div>
				<div id="IDequalizer5"></div>
				<div id="IDequalizer6"></div>
				<div id="IDequalizer7"></div>
				<div id="IDequalizer8"></div>
			</div>
			
	</body>
	</html>