<?php 
    // La ou l'image va être 
    $dir = "../assets/img";
    $target_file = $dir.basename($_FILES['avatar_file']['name']);
    $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



    if(check_mime($_FILES['avatar_file']['tmp_name'])){
        if(check_size($_FILES['avatar_file']['size'])){
            if(check_type($imgTypeFile)){
                if(move_uploaded_file($_FILES['avatar_file']['tmp_name'], $target_file)){
                    echo "Fichier ". basename($_FILES['avatar_file']['name']) . " a bien été uploadé";
                }
            }else 
            {
                echo "Extension mauvaises";
            }
        }else{ 
            echo "Too big";
        }
    }else{
        echo "Fake";
    }



    function check_mime($file){
        $check = $file;
        if($check !== false){return true;}
        else{return false;}
    }

    function check_size($file){
        if($file < 20000000)
            return true;
        else 
            return false;
    }

    function check_type($file){
        if($file != "jpg" && $file != "png" && $file != "jpeg" && $file != "gif" && $file != "PNG"){
            return false;
        }else {
            return true;
        }
    }