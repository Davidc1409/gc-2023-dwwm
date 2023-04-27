<?php
require_once("utils/db-connect.php");
require("utils/function.php");

is_connected();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $method = $_POST;
}
else{
    $method = $_GET;
}

switch ($method["choice"]){
    case "select_carousel" :

        $query = $db->prepare("SELECT a.*, CONCAT(firstname, ' ', lastname) AS fullname FROM articles a INNER JOIN users u ON u.id = a.user_id_articles WHERE carousel!=0 OR carousel!=NULL");
        $query->execute();
        $articles= $query->fetchall(PDO::FETCH_ASSOC); //:: signifie opérateur de résolution de portée.
        echo json_encode(["success"=>true, "articles"=>$articles]);
        break;
    case "select_all" :

        $query = $db->prepare("SELECT a.*, CONCAT(firstname, ' ', lastname) AS fullname FROM articles a INNER JOIN users u ON u.id = a.user_id_articles ORDER BY created_at DESC");
        $query->execute();
        $articles= $query->fetchall(PDO::FETCH_ASSOC); //:: signifie opérateur de résolution de portée.
        echo json_encode(["success"=>true, "articles"=>$articles]);
        break;

    case "select_articles" :

        $query = $db->prepare("SELECT a.*, CONCAT(firstname, ' ', lastname) AS fullname FROM articles a INNER JOIN users u ON u.id = a.user_id_articles WHERE user_id_articles=:user_id_articles");
        $query->bindValue(":user_id_articles",$_SESSION["id"]);
        $query->execute();
        $articles= $query->fetchall(PDO::FETCH_ASSOC); //:: signifie opérateur de résolution de portée.
        echo json_encode(["success"=>true, "articles"=>$articles]);
        break;

    case "select_id_articles" :

        if(!isset($method["id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query = $db->prepare("SELECT a.*, CONCAT(firstname, ' ', lastname) AS fullname FROM articles a INNER JOIN users u ON u.id = a.user_id_articles WHERE a.id=:id_articles AND user_id_articles=:user_id_articles");
        $query->bindValue(":id_articles",$method["id"]);
        // $query->bindValue(":user_id_articles",$_SESSION["id"]);
        $query->execute();
        $article=$query->fetch(PDO::FETCH_ASSOC);
        if ($article){
            echo json_encode(["success"=>true, "article"=>$article]);
        }
        else{
            echo json_encode(["success"=>false, "error"=>"Aucun article correspond a cet id"]);
        }
        break;

    case "insert_articles" :

        request_method();
        $list_str_column=[];
        $list_str_placeholder=[];

        foreach($method as $key => $val){
            if(isset($val) && !empty(trim($val)) && $key!="choice"){
                $list_str_column[$key]=$key;
                $list_str_placeholder[$key]=":".$key;
            }
        }

        // if(isset($method["articles_name"]) && !empty(trim($method["articles_name"]))){
        //     $list_str_column["articles_name"]="articles_name";
        //     $list_str_placeholder["articles_name"]=":articles_name";
        // }

        // if(isset($method["text_content"]) && !empty(trim($method["text_content"]))){
        //     $list_str_column["text_content"]="text_content";
        //     $list_str_placeholder["text_content"]=":text_content";
        // }

        // if(isset($method["media_content"]) && !empty(trim($method["media_content"]))){
        //     $list_str_column["media_content"]="media_content";
        //     $list_str_placeholder["media_content"]=":media_content";

        // }


        if(count($list_str_column)>1){
            $list_str_column["user_id_articles"]="user_id_articles";
            $list_str_placeholder["user_id_articles"]=":user_id_articles";
            $list_concat_column=implode(",",$list_str_column);
            $list_concat_placeholder=implode(",",$list_str_placeholder);
            
        }
        else{
            $list_str_column["user_id_articles"]="user_id_articles";
            $list_str_placeholder["user_id_articles"]=":user_id_articles";
            $list_concat_column=implode(",",$list_str_column);
            $list_concat_placeholder=implode(",",$list_str_placeholder);
            
        }
        
        $query=$db->prepare("INSERT INTO articles($list_concat_column) VALUES($list_concat_placeholder)");
        $query->bindValue(":user_id_articles",$_SESSION["id"]);

        foreach($list_str_column as $key => $val){
            if(isset($val)){
                $query->bindValue(":".$key,$method[$key]);
            }
        }
        // if(isset($list_str_column["articles_name"])){
        //     $query->bindValue(":articles_name",$method["articles_name"]);
        // }
        // if(isset($list_str_column["text_content"])){
        //     $query->bindValue(":text_content",$method["text_content"]);
        // }
        // if(isset($list_str_column["media_content"])){
        //     $query->bindValue(":media_content",$method["media_content"]);
        // }

        $query->execute();
        echo json_encode(["success"=>true]);
        break;

    case "update_articles" :

        request_method();
        $list_update=[];

        foreach($method as $key => $val){
            if(isset($val) && !empty(trim($val)) && $key!="choice"){
                $list_update[$key]=$key."=:".$key;
            }
        }

        // if(isset($method["articles_name"]) && !empty(trim($method["articles_name"]))){
        //     $list_update["articles_name"]="articles_name=:articles_name";
        // }

        // if(isset($method["text_content"]) && !empty(trim($method["text_content"]))){
        //     $list_update["text_content"]="text_content=:text_content";
        // }

        // if(isset($method["media_content"]) && !empty(trim($method["media_content"]))){
        //     $list_update["media_content"]="media_content=:media_content";
        // }

        if(count($list_update)>1){
            $list_concat=implode(",",$list_update);
            
        }
        else{
            $list_concat=implode($list_update);

        }
        
        $query=$db->prepare("UPDATE articles SET $list_concat WHERE id=:id AND user_id_articles=:user_id_articles");
        $query->bindValue(":id",$method["id"]);
        $query->bindValue(":user_id_articles",$_SESSION["id"]);
        foreach($list_update as $key => $val){
            if(isset($val)){
                $query->bindValue(":".$key,$method[$key]);
            }
        }
        // if(isset($list_update["articles_name"])){
        //     $query->bindValue(":articles_name",$method["articles_name"]);
        // }
        // if(isset($list_update["text_content"])){
        //     $query->bindValue(":text_content",$method["text_content"]);
        // }
        // if(isset($list_update["media_content"])){
        //     $query->bindValue(":media_content",$method["media_content"]);
        // }
        $query->execute();
        echo json_encode(["success"=>true]);
        break;

    case "delete_articles" :
        request_method();
        if(!isset($method["id"])){
            echo json_encode(["success"=>false, "error"=>"Donnees manquantes"]);
            die;
        }
        if(empty(trim($method["id"]))){
            echo json_encode(["success"=>false, "error"=>"Donnees vides"]);
            die;
        }
        $query=$db->prepare("DELETE FROM articles WHERE id=? AND user_id_articles=?");
        $query->execute([$method["id"],$_SESSION["id"]]);
        echo json_encode(["success"=>true]);
        break;

    default:
        
        echo json_encode(["success" => false, "error" => "Mauvaise selection"]);
}

?>