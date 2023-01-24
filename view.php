<!DOCTYPE html>
<html>

<head>
    <title>View User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var id = <?php echo $_GET['id']; ?>;
            $.ajax({
                url: 'user_info.php',
                type: 'post',
                data: { id: id },
                success: function(response) {
                    $("#user_info").html(response);
                }
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="add.php">Add User</a>
            <a href="info.php">Info</a>
        </nav>
        <div id="user_info"></div>
        <a href="pdf_view.php?id=<?php echo $_GET['id']; ?>">Download as PDF</a>
        <footer>
            <p>Lyon</p>
            <p>Created on: <?php echo date('Y-m-d'); ?></p>
            <p>
                <a href="https://github.com/yourusername">GitHub</a>
                <a href="https://www.linkedin.com/in/yourusername">LinkedIn</a>
            </p>
        </footer>
    </div>
</body>

</html>
