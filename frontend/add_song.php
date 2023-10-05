<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image']) && isset($_FILES['song'])) {
    // Obtemin les cançons actuals
    $songs = json_decode(file_get_contents("songs.json"), true);
    $num = count($songs); //Contem el numer total de les cançons per assignar una nova id
    
    // Aqui posem al nom de la imatge song + la id de la canço
    $imagePath = "images/song" . ($num + 1) . ".png";
    
    // Per la canço utilitzarem el nom original del arxiu
    $originalSongName = $_FILES["song"]["name"];
    $songPath = "songs/" . $originalSongName;

    // Moure fitxers a les carpetes corresponents
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    move_uploaded_file($_FILES["song"]["tmp_name"], $songPath);
    
    // Afegim nova cançó al arxiu json
    $newSong = array(
        "num" => $num,
        "reproduccions" => 0,
        "arists" => $_POST["artist"],
        "title" => $_POST["title"],
        "url" => $songPath,
        "image" => $imagePath
    );
    array_push($songs, $newSong); // Serveix per afegir la cançó al final de la array json
    file_put_contents("songs.json", json_encode($songs));
    header("Location: crearplaylist.php");
    exit;
}
?>
