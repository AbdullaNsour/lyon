<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="add.php">Add User</a>
            <a href="info.php">Info</a>
        </nav>
        <?php
            // Connect to the MySQL server
            $conn = new mysqli("localhost", "root", "", "lyon");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Retrieve user from the database
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            <br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
            <br>
            <label for="user_type">User Type:</label>
            <input type="text" id="user_type" name="user_type" value="<?php echo $row['user_type']; ?>">
            <br>
            <label for="shop_name">Shop Name:</label>
            <input type="text" id="shop_name" name="shop_name" value="<?php echo $row['shop_name']; ?>">
            <br>
            <label for="shop_phone">Shop Phone:</label>
            <input type="text" id="shop_phone" name="shop_phone" value="<?php echo $row['shop_phone']; ?>">
            <br>
            <label for="shop_location">Shop Location:</label>
            <input type="text" id="shop_location" name="shop_location" value="<?php echo $row['shop_location']; ?>">
            <br>
            <input type="submit" value="Save">
        </form>
        <?php
            $conn->close();
        ?>
    </div>
</body>
</html>
