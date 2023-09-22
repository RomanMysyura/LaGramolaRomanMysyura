<?php

if (isset($_GET['id'])) {
    $idEliminar = $_GET['id'];

    // Cargar el archivo playlists.json
    $playlists = json_decode(file_get_contents("playlists.json"), true);

    // Buscar y eliminar la playlist con el id proporcionado
    foreach ($playlists as $index => $playlist) {
        if ($playlist['id'] == $idEliminar) {
            unset($playlists[$index]);
            break;
        }
    }

    // Reindexar el array para que no queden índices vacíos después de eliminar
    $playlists = array_values($playlists);

    // Guardar las playlists actualizadas en el archivo playlists.json
    file_put_contents("playlists.json", json_encode($playlists));

    // Redireccionar al usuario a index.php
    header("Location: index.php");
    exit;
}
?>
