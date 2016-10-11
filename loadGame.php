<?php
header("Access-Control-Allow-Origin: *");

    $data = json_decode($_GET["data"]);

    $response = false;
    
    if(file_exists("games/" . $data->player1 . "vs" . $data->player2 . ".txt")){
        $response = file_get_contents("games/" . $data->player1 . "vs" . $data->player2 . ".txt");
    }
    else if (file_exists("games/" . $data->player2 . "vs" . $data->player1 . ".txt")){
        $response = file_get_contents("games/" . $data->player2 . "vs" . $data->player1 . ".txt");
    }

    echo $response;

?>