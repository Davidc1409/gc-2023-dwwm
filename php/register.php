<?php
require_once("utils/db-connect.php");
require("mailer.php");

if (!isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], $_POST["pwd"],$_POST["birthdate"])) {
    echo json_encode(["success"=> false, "error" => "Données Manquantes"]);
    die;
}

if (
    empty(trim($_POST["firstname"])) ||
    empty(trim($_POST["lastname"])) ||
    empty(trim($_POST["username"])) ||
    empty(trim($_POST["email"])) ||
    empty(trim($_POST["pwd"])) ||
    empty(trim($_POST["birthdate"]))
) {
    echo json_encode(["success"=> false, "error" => "Données vides"]);
    die;
}

$regex= "/^[a-zA-Z0-9-\_\.]+@[a-zA-Z0-9-\_\.]{2,}\.[a-zA-Z0-9-\_\.]{2,}$/";
if (!preg_match($regex,$_POST["email"])){
    echo json_encode(["success"=> false, "error" => "email au mauvais format"]);
    die;

}

$regex1= "/(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,12}/";
if (!preg_match($regex1,$_POST["pwd"])){
    echo json_encode(["success"=> false, "error" => "mot de passe au mauvais format"]);
    die;

}

$hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

$query = $db->prepare("INSERT INTO users (firstname,lastname,username,email,pwd,birthdate) Values (:firstname,:lastname,:username,:email,:pwd,:birthdate)");
$query->bindValue(":firstname", $_POST['firstname']);
$query->bindValue(":lastname", $_POST['lastname']);
$query->bindValue(":username", $_POST['username']);
$query->bindValue(":email", $_POST['email']);
$query->bindValue(":pwd", $hash);
$query->bindValue(":birthdate", $_POST["birthdate"]);
$query->execute();
echo json_encode(["success"=> true]);
mailer($_POST["email"],"MAil test","Mail reçu");



?>