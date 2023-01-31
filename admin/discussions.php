<?php
    require_once("../db-connect.php");
    require("../function.php");

    is_connected();
    is_admin();

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $method = $_POST;
    }
    else{
        $method = $_GET;
    }

    switch ($method["choice"]){
        case "select_discussions" :

            $query = $db->query("SELECT * FROM discussions");
            $discussions= $query->fetchall(PDO::FETCH_ASSOC); //:: signifie opérateur de résolution de portée.
            echo json_encode(["success"=>true, "discussions"=>$discussions]);
            break;

        case "select_id_discussions" :

            request_method();
            if(!isset($method["id"])){
                echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                die;
            }
            if(empty(trim($method["id"]))){
                echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                die;
            }
            $query = $db->prepare("SELECT * FROM discussions WHERE id=:id");
            $query->bindValue(":id",$method["id"]);
            $query->execute();
            $discussions=$query->fetch(PDO::FETCH_ASSOC);
            if ($discussions){
                echo json_encode(["success"=>true, "article"=>$discussions]);
            }
            else{
                echo json_encode(["success"=>false, "error"=>"Aucun article correspond a cet id"]);
            }
            break;

        case "insert_discussions" :

            request_method();
            $list_str_column=[];
            $list_str_placeholder=[];

            if(isset($method["discussions_name"]) && !empty(trim($method["discussions_name"]))){
                $list_str_column["discussions_name"]="discussions_name";
                $list_str_placeholder["discussions_name"]=":discussions_name";
                
            }
            else{
                echo json_encode(["success"=>false, "erreur"=> "données manquantes"]);
                die;
            }

            $list_concat_column=implode($list_str_column);
            $list_concat_placeholder=implode($list_str_placeholder);

           
            // $list_str_column["user_id_discussions"]="user_id_discussions";
            // $list_str_placeholder["user_id_discussions"]=":user_id_discussions";
            
            $query=$db->prepare("INSERT INTO discussions($list_concat_column) VALUES($list_concat_placeholder)");
            // $query->bindValue(":user_id_articles",$_SESSION["id"]);
            if(isset($list_str_column["discussions_name"])){
                $query->bindValue(":discussions_name",$method["discussions_name"]);
            }
            $query->execute();
            echo json_encode(["success"=>true]);
            break;
        
        case "update_discussions" :

            request_method();
            $list_update=[];

            if(isset($method["discussions_name"]) && !empty(trim($method["discussions_name"]))){
                $list_update["discussions_name"]="discussions_name=:discussions_name";
            }
            else{
                echo json_encode(["success"=>false, "erreur"=> "données manquantes"]);
                die;
            }


            $list_concat=implode(",",$list_update);

            $query=$db->prepare("UPDATE discussions SET $list_concat WHERE id_discussions=:id");
            $query->bindValue(":id",$method["id_discussions"]);
            if(isset($list_update["discussions_name"])){
                $query->bindValue(":discussions_name",$method["discussions_name"]);
            }
            $query->execute();
            echo json_encode(["success"=>true]);
            break;
        
        case "delete_discussions" :

            request_method();
            if(!isset($method["id_discussions"])){
                echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                die;
            }
            if(empty(trim($method["id_discussions"]))){
                echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                die;
            }
            $query=$db->prepare("DELETE FROM discussions WHERE id_discussions=?");
            $query->execute([$method["id_discussions"]]);
            echo json_encode(["success"=>true]);
            break;
        
        default:
            echo json_encode(["success" => false, "error" => "Mauvaise selection"]);
            break;
    }

?>