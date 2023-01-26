<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>

<body>

    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="add.php">Add User</a>
            <a href="info.php">Info</a>
        </nav>
        <h1>Add User</h1>
        <div id="alert-box">
            <p>New record created successfully.</p>
            <button id="alert-ok-btn">OK</button>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div id="name-error" class="invalid-feedback">
                Please fill the blanks.
            </div>



            <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type" onchange="showFields(this.value)">
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
            </select>
            <br>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <br>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <br>
            <div id="seller_fields" style="display: none;">
                <label for="shop_name">Shop Name:</label>
                <input type="text" name="shop_name" id="shop_name">
                <br>
                <label for="shop_phone">Shop Phone:</label>
                <input type="tel" name="shop_phone" id="shop_phone">
                <br>
                <label for="shop_location">Shop Location:</label>
                <input type="text" name="shop_location" id="shop_location">
                <br>
            </div>
            <input type="submit" name="submit" value="Save">
            <a href="index.php" class="back">Back</a>
        </form>






        <script>
            function showFields(value) {
                if (value === "seller") {
                    document.getElementById("seller_fields").style.display = "block";
                } else {
                    document.getElementById("seller_fields").style.display = "none";
                }
            }


            function validateForm() {
                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var userType = document.getElementById("user_type").value;
                var shopName = document.getElementById("shop_name").value;
                var shopPhone = document.getElementById("shop_phone").value;
                var shopLocation = document.getElementById("shop_location").value;
                var image = document.getElementById("image").value;

                if (name == "") {
                    document.getElementById("name").classList.add("is-invalid");
                    document.getElementById("name-error").style.display = "block";
                    return false;
                }
                if (userType == "seller" && shopName == "") {
                    document.getElementById("shop_name").classList.add("is-invalid");
                    document.getElementById("name-error").style.display = "block";
                    return false;
                }
                if (userType == "seller" && shopPhone == "") {
                    document.getElementById("shop_phone").classList.add("is-invalid");
                    return false;
                }
                if (userType == "seller" && shopLocation == "") {
                    document.getElementById("shop_location").classList.add("is-invalid");
                    return false;
                }
                if (image == "") {
                    document.getElementById("image").classList.add("is-invalid");
                    return false;
                }
                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    document.getElementById("email").classList.add("is-invalid");
                    return false;
                }
                return true;
            }
        </script>



        <?php
        // Connect to the MySQL server
        $conn = new mysqli("localhost", "root", "", "lyon");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form has been submitted
        if (isset($_POST['submit'])) {
            // Get the form data
            $user_type = $_POST['user_type'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $shop_name = $_POST['shop_name'];
            $shop_phone = $_POST['shop_phone'];
            $shop_location = $_POST['shop_location'];
            // Get the image file
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            // Move the image file to the images folder
            move_uploaded_file($image_tmp, "images/$image");

            // Insert the data into the database
            if ($user_type == 'buyer') {
                $sql = "INSERT INTO users (user_type, name, email, image) VALUES ('$user_type', '$name', '$email', '$image')";
            } else {
                $sql = "INSERT INTO users (user_type, name, email, shop_name, shop_phone, shop_location, image) VALUES ('$user_type', '$name', '$email','$shop_name','$shop_phone','$shop_location', '$image')";
            }
            if ($conn->query($sql) === TRUE) {
                echo '<script>
                // Show the custom alert dialog
                document.getElementById("alert-box").style.display = "block";
            
                // Handle the click event of the OK button
                document.getElementById("alert-ok-btn").onclick = function() {
                    window.location.href = "index.php";
                }
            </script>';
                // echo '<script>setTimeout(function(){ window.alert("New record created successfully");},10);</script>';
                // header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>


    </div>
</body>

</html>