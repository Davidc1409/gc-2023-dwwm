<?php
session_start();
require_once("db-connect.php");

function is_admin(){
    if(!isset($_SESSION["user_rights"]) || !$_SESSION["user_rights"]){
        echo json_encode(["success"=>false, "error"=> "Vous n'etes pas un admin"]);
        die;
    }
}

function is_connected(){
    if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
        echo json_encode(["success"=>false, "error"=>"Vous n'etes pas connecte"]);
        die;
    }
}

function request_method(){
    if($_SERVER["REQUEST_METHOD"]!=="POST"){
        echo json_encode(["success"=>false, "error"=>"Erreur de methode"]);
        die;
    }
}

function upload($file)
{
    //? Si une image est transmise via le formulaire alors
    if (isset($file["media_content"]["name"])) {
        
        //* Récupération du nom de fichier dans la superglobale FILES
        $filename = $file["media_content"]["name"];

        //* Chemin du fichier
        $location = __DIR__ . "/../../ressources/images/$filename";

        //* Récupération de l'extension du fichier
        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension); //* Transformation de l'extension en minuscule

        //* Liste des extensions possibles
        $valid_extensions = ["jpg", "jpeg", "png"];

        //? Si l'extension du fichier appartient au tableau des extensions valides alors
        if (in_array($extension, $valid_extensions)) {
            //? Si le fichier est bien enregistré à l'endroit souhaité alors
            if (move_uploaded_file($file["media_content"]["tmp_name"], $location)){
                return $filename;
            } 
            else return false;
        } else return false;
    } else return false;
}

function upload_avatar($file)
{
    //? Si une image est transmise via le formulaire alors
    if (isset($file["avatar"]["name"])) {
        
        //* Récupération du nom de fichier dans la superglobale FILES
        $filename = $file["avatar"]["name"];

        //* Chemin du fichier
        $location = __DIR__ . "/../../ressources/images/$filename";

        //* Récupération de l'extension du fichier
        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension); //* Transformation de l'extension en minuscule

        //* Liste des extensions possibles
        $valid_extensions = ["jpg", "jpeg", "png"];

        //? Si l'extension du fichier appartient au tableau des extensions valides alors
        if (in_array($extension, $valid_extensions)) {
            //? Si le fichier est bien enregistré à l'endroit souhaité alors
            if (move_uploaded_file($file["avatar"]["tmp_name"], $location)){
                return $filename;
            } 
            else return false;
        } else return false;
    } else return false;
}

?>