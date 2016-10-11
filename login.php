<?php
header("Access-Control-Allow-Origin: *");

    require_once("dbconfig.php");

    $data = json_decode($_GET['data']);

    $user = strtolower($data->username);
    $pass = $data->password;

    $error = false;
    $errorMessage = "";
    $loginSuccess = false;

// Compare users
try{
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = '$user'"); 
    $stmt->execute();

    // set the resulting array to associative
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    if(password_verify($pass, $row['password'])){   
        $loginSuccess = true;
    }
    
}
    catch(PDOException $e) {
        $errorMessage = $e->getMessage();
        $error = true;
    }

// Compare users

    $data = json_decode($_GET['data']);

    echo '{
        "username": "' . $data->username . '",
        "loginSuccess":' . (int)$loginSuccess . ',
        "error":' . (int)$error . ',
        "errorMessage":"' . $errorMessage . '"
        }';
    
?>