<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_playlist = $_POST["nom_playlist"];
    $cancons = $_POST["cancons"];

    // Carrega el arxiu playlists.json
    $playlists = json_decode(file_get_contents("playlists.json"), true);

    // Genera nova id per la playlist nova, sumant les playlists.
    $id = count($playlists);

    // Crear la nueva playlist
    $nueva_playlist = [
        "name" => $nom_playlist,
        "id" => $id,
        "songs" => $cancons 
    ];

    // Añadir la nueva playlist al array de playlists
    $playlists[] = $nueva_playlist;

    // Guardar las playlists actualizadas en el archivo playlists.json
    file_put_contents("playlists.json", json_encode($playlists));

    header("Location: index.php");
    exit;
}
?>



