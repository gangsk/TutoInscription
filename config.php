<?php 
    try 
    {
        $bdd = new PDO("mysql:host=HOST;dbname=DB_NAME;charset=utf8", "LOGIN", "PASS");
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
