<?php
    require_once("../db-connect.php");
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

        case "select_discussions_list" :

            $query=$db->prepare("SELECT discussions_name, id_discussions FROM user_discussions u INNER JOIN discussions d ON u.discussions_id=d.id_discussions WHERE user_id_discussions=:user_id_discussions");
            $query->bindValue(":user_id_discussions",$_SESSION["id"]);
            $query->execute();
            $discussions_list=$query->fetchall(PDO::FETCH_ASSOC);
            echo json_encode(["success"=>true, "discussions"=>$discussions_list]);
            break;

        case "select_discussions_participants" :

            request_method();

            if(!isset($method["discussions_id"])){
                echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                die;
            }
            if(empty(trim($method["discussions_id"]))){
                echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                die;
            }

            $query=$db->prepare("SELECT username FROM user_discussions udisc INNER JOIN users u ON u.id=udisc.user_id_discussions WHERE discussions_id=:discussions_id");
            $query->bindValue(":discussions_id",$method["discussions_id"]);
            $query->execute();
            $discussions_list=$query->fetchall(PDO::FETCH_ASSOC);
            echo json_encode(["success"=>true, "discussions"=>$discussions_list]);
            break;
        
        case "add_discussions" :

            request_method();
            $last_id="";
            if(!isset($method["discussions_name"])){
                echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                die;
            }
            if(empty(trim($method["discussions_name"]))){
                echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                die;
            }
            $query=$db->prepare("INSERT INTO discussions (discussions_name) VALUES(:discussions_name)");
            $query->bindValue(":discussions_name",$method["discussions_name"]);
            $query->execute();
            $last_id=$db->lastInsertId();
            echo $last_id;
            $query=$db->prepare("INSERT INTO user_discussions(discussions_id,user_id_discussions) VALUES(:discussions_id,:user_id_discussions)");
            $query->bindValue(":user_id_discussions",$_SESSION["id"]);
            $query->bindValue(":discussions_id",$last_id);
            $query->execute();
            echo json_encode(["success"=>true]);
            break;



        case "update_discussions_name" :

            request_method();
            if(!isset($method["discussions_name"])){
                echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                die;
            }
            if(empty(trim($method["discussions_name"]))){
                echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                die;
            }
            
            $query=$db->prepare("UPDATE discussions SET discussions_name=:discussions_name WHERE id_discussions=:id_discussions");
            $query->bindValue(":discussions_name",$method["discussions_name"]);
            $query->bindValue(":id_discussions",$method["id_discussions"]);
            $query->execute();
            echo json_encode(["success"=>true]);
            break;

            case "delete_discussions" :

                if(!isset($method["id_discussions"])){
                    echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                    die;
                }
                if(empty(trim($method["id_discussions"]))){
                    echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                    die;
                }
                $query=$db->prepare("DELETE FROM discussions WHERE id=?");
                $query->execute([$method["id_discussions"]]);
                echo json_encode(["success"=>true]);
                break;
            
            case "delete_user_discussions" :

                if(!isset($method["id_discussions"])){
                    echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
                    die;
                }
                if(empty(trim($method["id_discussions"]))){
                    echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
                    die;
                }
                $query=$db->prepare("DELETE FROM user_discussions WHERE user_id_discussions=?");
                $query->execute([$_SESSION["id"]]);
                echo json_encode(["success"=>true]);
                break;

            default :
                echo json_encode(["success"=>false, "error"=>"Mauvaise selection"]);
                break;

}

?>