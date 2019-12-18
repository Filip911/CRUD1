<?php 
    session_start();
    include 'config.php';

    if(isset($_POST['add'])) {
        $name = $_POST['name']; 
        $email = $_POST['email']; 
        $phone = $_POST['phone']; 

        $photo = $_FILES['image']['name'];
        $upload = "upload/" .$photo;

        $query = "INSERT INTO crud(name,email,phone,photo)
        VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss",$name,$email,$phone,$upload);
        $stmt->execute();
        move_uploaded_file($_FILES['image']['tmp_name'], $upload);

        header('location:index.php');
        $_SESSION['response'] = "Successfully inserted in DB!";
        $_SESSION['res_type'] = "Success";
    }