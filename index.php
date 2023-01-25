<!DOCTYPE html>
<html>

<head>
    <title>Lyon Users</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">


        <!-- <nav>
            <a href="index.php">Home</a>
            <a href="add.php">Add User</a>
            <a href="info.php">Info</a>
        </nav> -->
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
            // Connect to the MySQL server
            $conn = new mysqli("localhost", "root", "", "lyon");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Retrieve all users from the database
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td><img src='images/" . $row["image"] . "' style='border-radius: 50%; height: 100px; width: 100px;'  alt='" . $row["name"] . "'></td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["user_type"] . "</td>";
                echo "<td>" . $row["shop_name"] . "</td>";
                echo "<td>" . $row["shop_phone"] . "</td>";
                echo "<td>" . $row["shop_location"] . "</td>";
                echo "<td>";
                echo "<a href='view.php?id=" . $row["id"] . "' class='view'>View</a>";
                echo "<a href='edit.php?id=" . $row["id"] . "'  class='edit'>Edit</a>";
                echo "<a href='index.php?id=" . $row["id"] . "&action=delete'  class='delete' > X </a>";
                echo "</td>";
                echo "</tr>";
            }


            // Check if the delete action is set
            if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                // Get the user id
                $id = $_GET['id'];

                // Delete the user from the database
                $sql = "DELETE FROM users WHERE id = $id";
                $conn->query($sql);

                // Redirect to the home page
                header("Location: index.php");
            }

            $conn->close();
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