<?php 
    // La ou l'image va être 
    $dir = "../assets/img";
    $target_file = $dir.basename($_FILES['avatar_file']['name']);
    $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileMime = $_FILES['avatar_file']['type'];
    


    if (check_mime($_FILES['avatar_file']['tmp_name'])) {
        if (check_size($_FILES['avatar_file']['size'])) {
            if (check_type($imgTypeFile)) {
                if (check_double_extension($_FILES['avatar_file']['name'])) {
                    if(check_type_mime($fileMime)) {
                        if(check_null_byte($_FILES['avatar_file']['name'])){
                            if(move_uploaded_file($_FILES['avatar_file']['tmp_name'], $target_file)){
                                    echo "Fichier ". basename($_FILES['avatar_file']['name']) . " a bien été uploadé";
                            }else{
                                echo "Erreur lors de l'upload ";
                            }
                        }else {
                            echo "ERreur null byte";
                        }
                    }else {
                        echo "Erreur mime";
                    }
                } else {
                    echo "Erreur extension";
                }
            } else {
                echo "Erreur type ";
            }
        } else {
            echo "Trop gros";
        }
    } else {
        echo "Erreur image";
    }


    function check_null_byte($file){
        if(preg_match('%', $file)){
            return false;
        }else {
            return true;
        }
    }



    function check_type_mime($fileMime){
        $mime = array('image/png', 'image/jpeg', 'image/gif');

        foreach($mime as $item){
            if($item == $fileMime){
                return true;
            }else {
                return false;
            }
        }
    }


    function check_double_extension($file){
        $extension = explode('.', $file);
        if($extension[1] == "php"){
            return false;
        }
        else {
            return true;
        }
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



