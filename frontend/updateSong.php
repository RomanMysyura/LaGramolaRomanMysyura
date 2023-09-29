<?php
if (isset($_POST['currentSong'])) {
    $songToUpdate = $_POST['currentSong'];

    $data = file_get_contents('songs.json');
    $songsArray = json_decode($data, true);

    if (isset($songsArray[$songToUpdate])) {
        $songsArray[$songToUpdate]['reproduccions'] += 1;
        file_put_contents('songs.json', json_encode($songsArray));
    }
}
?>
