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
                <div class="card-header py-3 px-4 text-bg-dark bg-gradient h5">
                    <span>Logged Out</span>
                </div>
                <div class="card-body p-4">
                    <form method="post">

                        <?php
                        session_start();
                        session_unset();
                        session_destroy();
                        ?>
                        <p>You have been logged out. </p>
                        
                        <a class="btn btn-dark bg-gradient my-3 w-100 text-white text-uppercase" href="login.php">Continue</a>
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