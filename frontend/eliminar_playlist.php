<?php

if (isset($_GET['id'])) {
    $idEliminar = $_GET['id'];

    // Carreguem el arxiu json
    $playlists = json_decode(file_get_contents("playlists.json"), true);

    // Busquem la playlist amb la mateixa id i la 
    foreach ($playlists as $index => $playlist) {
        if ($playlist['id'] == $idEliminar) {
            unset($playlists[$index]);
            break;
        }
    }

    // Actualitza el arxiu json per que no quedin espais en blanc
    $playlists = array_values($playlists);

    // Guardar les playlists actualitzades
    file_put_contents("playlists.json", json_encode($playlists));

    // Torna a la pagina home
    header("Location: index.php");
    exit;
}
?>
