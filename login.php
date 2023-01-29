<?php
    require_once("db-connect.php");
    session_start();
    session_unset();

    if ($_SERVER ["REQUEST_METHOD"] != "POST") {
        echo json_encode(["success" => false, "error"=>"Mauvaise methode"]);
        die;
    }

    if(!isset($_POST["email"],$_POST["pwd"])){
        echo json_encode(["success"=> false, "error" => "email ou mot de passe manquant"]);
        die;
    }

    if (empty(trim($_POST["email"])) || empty(trim($_POST["pwd"]))) {
        echo json_encode(["success"=> false, "error" => "email ou mot de passe vide"]);
        die;
    }

    $query = $db->prepare("SELECT id, firstname, pwd, user_rights FROM users WHERE email = :gmail");
    $query->bindValue(":gmail", $_POST['email']);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($_POST["pwd"],$user["pwd"])){
        $_SESSION["connected"]="true";
        $_SESSION["id"]=$user["id"];
        $_SESSION["firstname"]=$user["firstname"];
        $_SESSION["user_rights"]=$user["user_rights"];
        print_r($_SESSION);
        echo json_encode(["success"=> true]);
    }
    else{
        session_unset();
        echo json_encode(["success"=> false, "error" => "email ou mot de passe errone"]);
    }
    

?>