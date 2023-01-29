<?php
    require_once("db-connect.php");
    require("function.php");

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
            $query=$db->prepare("SELECT username,firstname,lastname,email,user_rights FROM users WHERE id=:id");
            $query->bindValue(":id",$_SESSION["id"]);
            $query->execute();
            $user=$query->fetch(PDO::FETCH_ASSOC);
            echo json_encode(["success"=>true, "user"=>$user]);
            break;

        case "update_users_info" :

            request_method();
            $list_update=[];
            $list_variables=[];

            if(isset($method["firstname"]) && !empty(trim($method["firstname"]))){
                $list_update["firstname"]="firstname=:firstname";
            }
            if(isset($method["lastname"]) && !empty(trim($method["lastname"]))){
                $list_update["lastname"]="lastname=:lastname";
            }
            if(isset($method["username"]) && !empty(trim($method["username"]))){
                $list_update["username"]="username=:username";
            }
            if(isset($method["email"])&& !empty(trim($method["email"]))){
                $list_update["email"]="email=:email";
            }
            if(isset($method["pwd"]) && !empty(trim($method["pwd"]))){
                $hash=password_hash($method["pwd"],PASSWORD_DEFAULT);
                $list_update["pwd"]="pwd=:pwd";
            }
            if(count($list_update)>1){
                $list_concat=implode(",",$list_update);
                $list_variables["id"]=$_SESSION["id"];    
            }
            else{
                $list_concat=implode($list_update);
            }
            
            $query=$db->prepare("UPDATE users SET $list_concat WHERE id=:id");
            $query->bindValue(":id",$_SESSION["id"]);
            if(isset($list_update["firstname"])){
                $query->bindValue(":firstname",$method["firstname"]);
            }
            if(isset($list_update["lastname"])){
                $query->bindValue(":lastname",$method["lastname"]);
            }
            if(isset($list_update["username"])){
                $query->bindValue(":username",$method["username"]);
            }
            if(isset($list_update["email"])){
                $query->bindValue(":email",$method["email"]);
            }
            if(isset($list_update["pwd"])){
                $query->bindValue(":pwd",$hash);
            }

            $query->execute();
            echo json_encode(["success"=>true]);
            break;
            
        default :
            echo json_encode(["success"=>false, "error"=>"Mauvaise selection"]);
            break;

}

?>