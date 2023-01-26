<?php
// Connect to the MySQL server
$conn = new mysqli("localhost", "root", "", "lyon");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve all users from the database
$sql = "SELECT * FROM users";

$result = $conn->query($sql);
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM users WHERE id = $id";
        $result = $conn->query($sql);
        if ($result) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
        $conn->close();
        header("Location: index.php");}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Lyon Users</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Add User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">Info</a>
                    </li>
                </ul>
            </div>
        </nav>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Shop Name</th>
                <th>Shop Phone</th>
                <th>Shop Location</th>
                <th>Actions</th>

            </tr>
            <?php

           

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo " <td><img src='images/" . $row["image"] . "''  alt='" . $row["name"] . "'></td> ";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["user_type"] . "</td>";
                echo "<td>" . $row["shop_name"] . "</td>";
                echo "<td>" . $row["shop_phone"] . "</td>";
                echo "<td>" . $row["shop_location"] . "</td>";
                echo "<td>";
                echo "<a href='view.php?id=" . $row["id"] . "' class='view'>View</a>";
                echo "<a href='edit.php?id=" . $row["id"] . "'  class='edit'>Edit</a>";
                echo "<a href='index.php?id=" . $row["id"] . "&action=delete' class='delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>X</a>";
                echo "</td>";
                echo "</tr>";
            }

        

            ?>
        </table>



    </div>
    <footer>
        <p>Lyon</p>
        <p>Created on: <?php echo '24/1/2023 by Abdulla Nsour'; ?></p>
        <p>
            <a href="https://github.com/AbdullaNsour/lyon">GitHub</a>
            <a href="https://www.linkedin.com/in/abdulla-nsour-886887166/">LinkedIn</a>
        </p>
    </footer>



</body>


</html>