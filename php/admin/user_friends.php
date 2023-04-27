<?php
require_once("../utils/db-connect.php");
require("../function.php");

is_connected();
is_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $method=$_POST;
}
else {
    $method=$_GET;
}

switch ($method["choice"]){

    case "select_friends_list" :

        $query=$db->prepare("SELECT friend_id, username FROM user_friends f INNER JOIN users u ON u.id=f.user_id_friends WHERE user_id_friends=? AND friend_invite=1");
        $query->execute([$_SESSION["id"]]);
        $friends_list=$query->fetchall(PDO::FETCH_ASSOC);
        echo json_encode(["success"=>true, "user"=>$friends_list]);
        break;

    // case "select_friend" :

    //     request_method();
    //     if(!isset($method["id"])){
    //         echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
    //         die;
    //     }
    //     if(empty(trim($method["id"]))){
    //         echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
    //         die;
    //     }
    //     $query=$db->prepare("SELECT username FROM user_friends f INNER JOIN users u ON u.id=f.user_id_friends WHERE friend_id=? AND friend_invite=1");
    //     $query->bindValue(":id",$method["id"]);
    //     $query->execute();
    //     $user=$query->fetch(PDO::FETCH_ASSOC);
    //     echo json_encode(["success"=>true, "user"=>$user]);
    //     break;

    case "add_friends" :
        if(!isset($method["friend_id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["friend_id"]))){
            echo json_encode(["success"=>false,"error"=>"Donnees vides"]);
            die;
        }
        if($method["friend_invite"]==1){
            $query=$db->prepare("INSERT INTO user_friends (user_id_friends,friend_id,friend_invite) VALUES (:user_id_friends,:friend_id,:friend_invite)");
            $query->bindValue(":user_id_friends",$_SESSION["id"]);
            $query->bindValue(":friend_id",$method["friend_id"]);
            $query->bindValue(":friend_invite",$method["friend_invite"]);
            $query->execute();
            echo json_encode(["success"=>true]);
        }
        else{
            echo json_encode(["success"=>false,"error"=>"Invitation refusee"]);
        }
        break;

    case "delete_friends" :

        if(!isset($method["friend_id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["friend_id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("DELETE FROM user_friends WHERE friend_id=?");
        $query->execute([$method["friend_id"]]);
        echo json_encode(["success"=>true]);
        break;

    default :
        echo json_encode(["success"=>false, "error"=>"Mauvaise selection"]);
        break;

}

?>