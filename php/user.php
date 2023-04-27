<?php
require_once("utils/db-connect.php");
require("utils/function.php");

is_connected();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $method=$_POST;
}
else {
    $method=$_GET;
}

switch ($method["choice"]){

    case "select_id_users" :

        if(!isset($_SESSION["id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($_SESSION["id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("SELECT id,username,firstname,lastname,email,user_rights,avatar,birthdate FROM users WHERE id=:id");
        $query->bindValue(":id",$_SESSION["id"]);
        $query->execute();
        $user=$query->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["success"=>true, "user"=>$user]);
        break;

    case "update_users_info" :

        request_method();
        $list_update=[];
        $list_variables=[];

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
            $list_variables["id"]=$_SESSION["id"];    
        }
        else{
            $list_concat=implode($list_update);
        }
        
        $query=$db->prepare("UPDATE users SET $list_concat $upload_img WHERE id=:id");
        $query->bindValue(":id",$_SESSION["id"]);

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
        
    default :
        echo json_encode(["success"=>false, "error"=>"Mauvaise selection"]);
        break;

}

?>