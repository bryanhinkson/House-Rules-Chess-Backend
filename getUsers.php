<?php
header("Access-Control-Allow-Origin: *");

    require_once("dbconfig.php");

    $error = false;
    $errorMessage = "";
    $loginSuccess = false;

// Compare users
try{
    $stmt = $conn->prepare("SELECT username FROM users"); 
    $stmt->execute();

    // set the resulting array to associative
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
    catch(PDOException $e) {
        $errorMessage = $e->getMessage();
        $error = true;
    }

// Compare users


    echo '{
        "users": ' . json_encode($row) . ',
        "error":' . (int)$error . ',
        "errorMessage":"' . $errorMessage . '"
        }';
    
?>