<?php

    function file_upload($pic){
        if($pic["error"] == 4){
            $picture_name = "product.png";
            $message = "No image has been chosen, a placeholder will be added!";
        }else {
            $check_if_image = getimagesize($pic["tmp_name"]);
            $message = $check_if_image ? "Ok" : "Not an image";
        }

        if($message == "Ok"){
            $ext = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $picture_name = uniqid("") . "." . $ext;

            $destination = "Pictures/{$picture_name}";
            move_uploaded_file($pic["tmp_name"], $destination);
        }

        return [$picture_name, $message];
    }

?>