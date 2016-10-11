<?php
header("Access-Control-Allow-Origin: *");

    $data = json_decode($_GET["data"]);
    
    $response = false;

    // The names can get switched so check if they exist first
    if(file_exists("games/" . $data->player1 . "vs" . $data->player2 . ".txt")){
        $response = file_put_contents("games/" . $data->player1 . "vs" . $data->player2 . ".txt", json_encode($data));
    }
    else if (file_exists("games/" . $data->player2 . "vs" . $data->player1 . ".txt")){
        $response = file_put_contents("games/" . $data->player2 . "vs" . $data->player1 . ".txt", json_encode($data));
    }
    else{
        $response = file_put_contents("games/" . $data->player1 . "vs" . $data->player2 . ".txt", json_encode($data));
    }

    if($response){
        echo true;
    }
    else{
        echo false;
    }
?>