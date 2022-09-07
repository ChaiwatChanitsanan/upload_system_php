<?php
     session_start();
    include_once('dbConfig.php');

    //File upload path
    $targetDir = "uploads/";

    if (isset($_POST['submit'])) {
        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir.$fileName;
            $filType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            //Allow certain  file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($filType, $allowTypes)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $insert = $db->query("INSERT INTO images(file_name,uploaded_on) VALUES ('".$fileName."', NOW())");
                    if ($insert) {
                        $_SESSION['statusMsg'] = "The file <b>".$fileName ."</b> has been uploasded successfully.";
                        header('location: index.php');
                    } else {
                        $_SESSION['statusMsg'] = "The file upload failed, please try again.";
                        header('location: index.php');
                    }
                } else {
                    $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                    header('location: index.php');
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, Only JPG, JPEG, PNG & GIF are allow to upload.";
                header('location: index.php');
            }
        } else {
            $_SESSION['statusMsg'] = "Please select a file to upload.";
            header('location: index.php');
        }
    }
?>