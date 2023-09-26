<?php

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['songid'])) {
    $songid = $data["songid"];
    if (!isset($_COOKIE["reproduccions"])) {
        $reproduccions = [];
        $reproduccions[$data['songid']] = 1;
    } else {
        $reproduccions = json_decode($_COOKIE["reproduccions"], true);

        if (isset($reproduccions[$data['songid']])) {
            $reproduccions[$data['songid']]++;
        } else {
            $reproduccions[$data['songid']] = 1;
        }
    }

    setcookie("reproduccions", json_encode($reproduccions), time() + 3600, "/");
    die(json_encode($reproduccions));
} else {
    die("No s'ha proporcionat cap songid");
}
