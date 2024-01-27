<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management - Login</title>

    <!-- Css -->
    <link rel="stylesheet" href="../src/css/custom.css">
    <link rel="stylesheet" href="../src/css/styles.css">

</head>
<body>
    <div class="main d-flex flex-column">
        <h5 class="header p-4 m-0 bg-custom2 shadow text-uppercase text-dark">
            Library Management System
        </h5>
        <div class="main-content flex-grow-1 bg-light py-5">
            <div class="card mx-auto position-relative top-25 p-0 col-3">
                <div class="card-header py-3 px-4 text-bg-dark h5">
                    <span>Sign in</span>
                </div>
                <div class="card-body p-4">
                    <form method="post">

                        <?php
                        session_start();
                        require "../config.php";
                        
                        // when sign in button is pressed
                        if (isset($_POST['signInBtn'])) {
                            $username = mysqli_escape_string($con, $_POST['username']);
                            $password = mysqli_escape_string($con, $_POST['password']);

                            $sql = "select username from users where username='$username'";

                            // check if username exists
                            if (mysqli_num_rows(mysqli_query($con, $sql)) == 1) {
                                $sql2 = "select * from users where username='$username' and password='$password' and is_active=1";
                                $results = mysqli_query($con, $sql2);

                                // check if username and password is matched and also if the status is active
                                if (mysqli_num_rows($results) == 1) {
                                    $row = mysqli_fetch_assoc($results); 
                                    $_SESSION['username'] = $row['username'];

                                    // redirecct to dashboard
                                    header('location: ../admin_view/dashboard/');
                                    
                                } else {
                                    echo "<div class='my-3 border border-2 border-danger-subtle text-danger text-center bg-danger-subtle p-2 rounded'>
                                <small>
                                    Username or password is incorrect.
                                </small>
                            </div>";
                                }
                            } else {
                                echo "<div class='my-3 border border-2 border-danger-subtle text-danger text-center bg-danger-subtle p-2 rounded'>
                                <small>
                                    Account does not exist.
                                </small>
                            </div>";
                            }
                        }

                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-text p-2">No account yet? <a href="#" class="link-custom1">Sign up</a></div>
                        
                        <input type="submit" value="Sign In" name="signInBtn" class="btn btn-custom2 my-3 w-100 text-white text-uppercase">
                    </form>
                </div>
            </div>
        </div>
        <div class="footer p-2 bg-secondary-subtle text-secondary small text-center">
            <span>All Rights Reserve &#169; <?php echo date('Y'); ?></span> 
        </div>
    </div>
</body>
</html>