<?php
header("Access-Control-Allow-Origin: *");

    require_once("dbconfig.php");

    $data = json_decode($_GET['data']);
    //Check for user with that name

    $user = strtolower($data->username);
    $pass = password_hash($data->password, PASSWORD_DEFAULT);

    $error = false;
    $errorMessage = "";
    $userExists = false;

// Compare users
try{
    $stmt = $conn->prepare("SELECT username FROM users"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) { 
        if($user == $row['username']){
            $userExists = true;
        }
    }
}
    catch(PDOException $e) {
        $errorMessage = $e->getMessage();
        $error = true;
    }

// Compare users




if(!$userExists){

    try {
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        $conn->exec($sql);
    }
    catch(PDOException $e){
        $errorMessage = $e->getMessage();
        $error = true;
    }
}

    echo '{
        "username": "' . $data->username . '",
        "userExists":' . (int)$userExists . ',
        "error":' . (int)$error . ',
        "errorMessage": "' . $errorMessage . '"
        }';

        $conn = null;

?>