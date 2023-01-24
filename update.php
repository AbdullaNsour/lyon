<?php
// Connect to the MySQL server
    $conn = new mysqli("localhost", "root", "", "lyon");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Get the user data from the form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $shop_name = $_POST['shop_name'];
    $shop_phone = $_POST['shop_phone'];
    $shop_location = $_POST['shop_location'];

    // Update the user in the database
    $sql = "UPDATE users SET name='$name', email='$email', user_type='$user_type', shop_name='$shop_name', shop_phone='$shop_phone', shop_location='$shop_location' WHERE id=$id";
    $conn->query($sql);

    // Redirect to the home page
    header("Location: index.php");

    $conn->close();
?>
