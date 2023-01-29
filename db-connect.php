<?php
    $host="localhost";
    $username="root";
    $password="";
    $dbname="gc-project";
    try{
        $db =new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        //echo "Connexion ok";
    }
    catch(ErrorException $e){
        echo $e;
    }

?>