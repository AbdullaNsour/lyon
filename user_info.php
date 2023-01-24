<?php
    // Connect to the MySQL server
    $conn = new mysqli("localhost", "root", "", "lyon");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the user id from the AJAX request
    $id = $_POST['id'];

    // Retrieve the user information from the database
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Name: " . $row["name"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>User Type: " . $row["user_type"] . "</p>";
        if($row["user_type"] == 'shop'){
            echo "<p>Shop Name: " . $row["shop_name"] . "</p>";
            echo "<p>Shop Phone: " . $row["shop_phone"] . "</p>";
            echo "<p>Shop Location: " . $row["shop_location"] . "</p>";
        }
    } else {
        echo "<p>No user found with ID: $id</p>";
    }

    $conn->close();
?>
