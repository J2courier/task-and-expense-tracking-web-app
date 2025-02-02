<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/casestudy/home/index.css">
        <title>Sign Up</title>
</head>
<body>

        <style>
                form {
                        border: solid 1px white;
                        display: flex;
                        flex-direction: column;
                        padding: 20px;
                        width: 40%;
                        gap: 20px;
                }
                form input {
                        padding: 20px;
                }
        </style>
        <form action="signup.php" method="POST">
                <input type="text" name="username" placeholder="Create Username">
                <input type="text" name="init_password" placeholder="Create Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <input type="submit"  id="signup_Btn" value="Sign in">
                <p>Already have an account?<a href="../home/index.php">login</a></p>
        </form><br>
       <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $username = trim($_POST['username'] ?? '');
                        $init_password = trim($_POST['init_password' ?? '']);
                        $confirm_password = trim($_POST['confirm_password' ?? '']);
                        if (empty($username) || empty($init_password) || empty($confirm_password)){
                                die("Please fill in all fields.");
                        } 

                        if ($init_password !== $confirm_password) {
                                die("Passwords do not match.");
                        }

                        $db_host = "localhost";
                        $db_user = "JFCompany";
                        $db_password = "";
                        $db_name = "user_accounts";
                        $mySQLi = new mySQLi($db_host, $db_user, $db_password,$db_name);
                        if ($mySQLi->connect_error){
                                die("Connection Failed: " . $mySQLi->connect_error);
                        }

                        $hashed_pass = password_hash($init_password, PASSWORD_DEFAULT);
                        //stmt is statement
                        $stmt = $mySQLi->prepare("INSERT INTO fields (userName, userPassword) VALUES (?, ?)");
                        if (!$stmt) {
                                die("Prepare failed: " . $mySQLi->error);
                        }
                        $stmt->bind_param("ss", $username, $hashed_pass);

                        if ($stmt->execute()) {
                                echo "<script>alert('User registered successfully!');</script>";
                        } else {
                                echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                        $mySQLi->close();

                } 
                // else {
                //         echo "Invalid request method.";
                // }
       ?>

</body>
</html>


