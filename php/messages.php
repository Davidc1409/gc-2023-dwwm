<?php
require_once("utils/db-connect.php");
require("../function.php");

is_connected();
is_admin();

if($_SERVER("REQUEST_METHOD"=="POST")){
    $method=$_POST;
}
else{
    $method=$_GET;
}

switch($method("choice")){

    // case "select_messages_id" :

    //     request_method();
    //     if(!isset($method["id_messages"])){
    //         echo json_encode(["success"=>false, "error"=>"Données manquantes"]);
    //         die;
    //     }
    //     if(empty(trim($method["id_messages"]))){
    //         echo json_encode(["success"=>false,"error"=>"Données vides"]);
    //         die;
    //     }

    //     $query=$db->prepare("SELECT text_content FROM messages WHERE id_messages=:id_messages AND user_id_messages=:user_id_messages");
    //     $query->binduValue(":user_id_messages",$_SESSION["user_id_messages"]);
    //     $query->bindValue(":id_messages", $method["id_messages"]);
    //     $query->execute();
    //     $messages=$query->fetch(PDO::FETCH_ASSOC);
    //     echo json_encode(["success"=>true, "messages"=>$messages]);
    //     break;

    // case "select_messages_user" :

    //     request_method();
    //     if(!isset($method["user_id_messages"])){
    //         echo json_encode(["success"=>false, "error"=>"Données manquantes"]);
    //         die;
    //     }
    //     if(empty(trim($method["user_id_messages"]))){
    //         echo json_encode(["success"=>false,"error"=>"Données vides"]);
    //         die;
    //     }

    //     $query=$db->prepare("SELECT text_content FROM messages WHERE user_id_messages=:user_id_messages");
    //     $query->bindValue(":user_id_messages", $_SESSION["user_id_messages"]);
    //     $query->execute();
    //     $messages=$query->fetch(PDO::FETCH_ASSOC);
    //     echo json_encode(["success"=>true, "messages"=>$messages]);
    //     break;

    // case "select_messages_disc_user" :

    //     request_method();
    //     if(!isset($method["discussions_id_messages"])){
    //         echo json_encode(["success"=>false, "error"=>"Données manquantes"]);
    //         die;
    //     }
    //     if(empty(trim($method["discussions_id_messages"]))){
    //         echo json_encode(["success"=>false,"error"=>"Données vides"]);
    //         die;
    //     }

    //     $query=$db->prepare("SELECT text_content FROM messages WHERE discussions_id_messages=:discussions_id_messages AND user_id_messages=:user_id_messages");
    //     $query->bindValue(":discussions_id_messages", $method["discussions_id_messages"]);
    //     $query->bindValue(":user_id_messages",$_SESSION["user_id_messages"]);
    //     $query->execute();
    //     $messages=$query->fetchall(PDO::FETCH_ASSOC);
    //     echo json_encode(["success"=>true, "messages"=>$messages]);
    //     break;
    
    case "insert_messages" :

        request_method();
        if(!isset($method["text_content"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if (empty(trim($method["text_content"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("INSERT INTO messages(text_content,discussions_id_messages,user_id_messages) VALUES (':text_content,:discussions_id_messages,:user_id_messages')");
        $query->bindValue(":text_content",$method["text_content"]);
        $query->bindValue(":discussions_id_messages",$method["discussions_id_messages"]);
        $query->bindValue(":user_id_messages",$_SESSION["id"]);
        $query->execute();
        echo json_encode(["success"=>true]);
        break;
    
    case "delete_messages" :
        
        request_method();
        if(!isset($method["id_messages"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["id_messages"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("DELETE FROM messages WHERE id_messages=:id_messages AND user_id_messages=:user_id_messages");
        $query->bindValue(":id_messages",$methode["id_messages"]);
        $quer->bindValue(":user_id_messages",$_SESSION["user_id_messages"]);
        $query->execute();
        echo json_encode(["success"=>true]);
        break;
    
    default:
        echo json_encode(["success" => false, "error" => "Mauvaise selection"]);
        break;
}


?>