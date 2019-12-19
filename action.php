<?php 
    session_start();
    include 'config.php';

    if(isset($_REQUEST['add'])) {
        $name = $_REQUEST['name']; 
        $email = $_REQUEST['email']; 
        $phone = $_REQUEST['phone']; 

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
        $_SESSION['res_type'] = "success";
    }

        if (isset($_REQUEST['delete'])) {
            $id = $_REQUEST['delete'];

            $sql ="SELECT photo FROM crud WHERE id=?";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("i", $id);
            $stmt2_execute();
            $result2 = $stmt2->get_result();
            $row = $result2->fetch_assoc();

            $imagepath = $row['photo'];
            unlink($imagepath);

            $query = "DELETE FROM crud WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            header('location:index.php');
            $_SESSION['response'] = "Successfully Deleted!";
            $_SESSION['res_type'] = "danger";

        }

        if (isset($_REQUEST['edit'])) {
            $id = $_REQUEST['edit'];

            $query = "SELECT * FROM crud WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $photo = $row['photo'];
        }