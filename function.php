<?php
    session_start();
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

?>