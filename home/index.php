
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="../home/index.css">
    <link rel="stylesheet" href="../login.css">
    <title>Login & Sign up</title>
</head>
<body>
    <style>
        body {
            background-color: #2E5A2A;
        }
        form {
            /* border: solid 1px white;        */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            width: 40%;
            gap: 20px;
        }
        form input {
            padding: 20px;
            width: 100%;
        }        

        form img {
            height: 100px;
            width: 100px;
        }
    </style>       
    <form action="index.php" method="post" class="login-form">
        <img src="../img/logo1.png" alt="img">
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="submit" id="login_btn" value="login">
        <p>Dont have an Account?<a href="../home/signup.php">Sign Up</a></p>
    </form>
    <?php
        session_start();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($password)) {
                die("Please fill in all fields.");
            }
            
            $db_host     = "localhost";
            $db_user     = "JFCompany";
            $db_password = ""; 
            $db_name     = "user_accounts";

            $mySQLi = new mysqli($db_host, $db_user, $db_password, $db_name); //connection of php to myPHPAdmin/mySQL

            if ($mySQLi->connect_error) { 
                die("Connection Failed: " . $mySQLi->connect_error);
            }

            //retrieve data from db 
            $stmt = $mySQLi->prepare("SELECT user_ID, userName, userPassword FROM fields WHERE userName = ?");
            if (!$stmt) {
                die("Prepare failed: " . $mySQLi->error);
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            //check if the data retrieve exist the 1 means there is only 1 recors existing if then its true
            if ($stmt->num_rows === 1) { 
                $stmt->bind_result($user_ID, $db_username, $hashed_password);
                $stmt->fetch();
        
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set up the session variables
                    $_SESSION['user_ID'] = $user_ID;
                    $_SESSION['username'] = $db_username;
                    // Redirect to the dashboard
                    header("Location: dashboard.php");
                    exit;
                } else {
                    echo "Incorrect password. Please try again.";
                }
            } else {
                echo "No user found with that username.";
            }
        }
    ?>
</body>
</html>