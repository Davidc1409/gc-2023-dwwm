<?php
require_once("../utils/db-connect.php");
require("../utils/function.php");
require("../mailer.php");

is_connected();
is_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $method=$_POST;
}
else {
    $method=$_GET;
}

switch ($method["choice"]){

    case "select_users" :

        $query=$db->query("SELECT id, username,firstname,lastname,email,user_rights, avatar FROM users");
        $users_list=$query->fetchall(PDO::FETCH_ASSOC);
        echo json_encode(["success"=>true, "user"=>$users_list]);
        break;

    case "select_id_users" :

        request_method();
        if(!isset($method["id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("SELECT username,firstname,lastname,email,user_rights,avatar FROM users WHERE id=:id");
        $query->bindValue(":id",$method["id"]);
        $query->execute();
        $user=$query->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["success"=>true, "user"=>$user]);
        break;

    case "update_users_info" :

        request_method();
        $list_update=[];

        foreach($method as $key => $val){
            if(isset($val) && !empty(trim($val)) && $key!="choice"){
                $list_update[$key]=$key."=:".$key;
                if($key=="pwd"){
                    $hash=password_hash($method["pwd"],PASSWORD_DEFAULT);
                }
            }
        }

        $upload_img = "";
        if (isset($_FILES["avatar"]["name"])){
            $upload_img = ", avatar= :avatar";
        } 
        
        if(count($list_update)>1){
            $list_concat=implode(",",$list_update);
        }
        else{
            $list_concat=implode($list_update);
        }
        
        $query=$db->prepare("UPDATE users SET $list_concat $upload_img WHERE id=:id");
        $query->bindValue(":id",$method["id"]);

        foreach($list_update as $key => $val){
            if(isset($val)){
                $query->bindValue(":".$key,$method[$key]);
                if($key=="pwd"){
                    $query->bindValue(":".$key,$hash);
                }
            }
        }
        if (isset($_FILES["avatar"]["name"])) $img_bind = upload_avatar($_FILES);
        if ($img_bind) $query->bindValue(":avatar", "../ressources/images/" . $img_bind);
        $query->execute();
        echo json_encode(["success"=>true]);
        break;
    
    case "add_user" :

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

        $upload_img = "";
        $upload_bind_img="";
        if (isset($_FILES["avatar"]["name"])){
            $upload_img = ", avatar";
            $upload_bind_img= ", :avatar";
        } 
        
        $hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        
        $query = $db->prepare("INSERT INTO users (firstname,lastname,username,email,pwd,birthdate $upload_img) Values (:firstname,:lastname,:username,:email,:pwd,:birthdate $upload_bind_img)");
        $query->bindValue(":firstname", $_POST['firstname']);
        $query->bindValue(":lastname", $_POST['lastname']);
        $query->bindValue(":username", $_POST['username']);
        $query->bindValue(":email", $_POST['email']);
        $query->bindValue(":pwd", $hash);
        $query->bindValue(":birthdate", $_POST["birthdate"]);
        $img_bind = false;
        if (isset($_FILES["avatar"]["name"])) $img_bind = upload_avatar($_FILES);
        if ($img_bind) $query->bindValue(":avatar", "../ressources/images/" . $img_bind);

        $query->execute();
        echo json_encode(["success"=> true]);
        mailer($_POST["email"],"MAil test","Mail reçu");
        break;

    case "delete_users" :

        if(!isset($method["id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("DELETE FROM users WHERE id=?");
        $query->execute([$method["id"]]);
        echo json_encode(["success"=>true]);
        break;

    default :
        echo json_encode(["success"=>false, "error"=>"Mauvaise selection"]);
        break;

}

?>