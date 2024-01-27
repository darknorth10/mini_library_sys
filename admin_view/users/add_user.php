<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>

    <!-- Css -->
    <link rel="stylesheet" href="../../src/css/custom.css">
    <link rel="stylesheet" href="../../src/css/styles.css">
</head>

<body>
    <div class="main d-flex flex-column">
        <!-- header -->
        <?php
        require "../../config.php";
        include "../../includes/header.php";
        $page_name = "um";

        ?>

        <!-- main content -->
        <div class="main-content flex-grow-1 bg-light py-5 d-flex flex-row gap-3 justify-content-center">
            <!-- side nav -->
            <?php
            include "../../includes/sidebar.php";
            ?>

            <!-- main content -->
            <div class="content card col-md-8 p-4 d-block">
                <!-- page name -->
                <h4 class="text-uppercase text-secondary">Users Management</h4>
                <a href="index.php" class="btn btn-sm btn-dark bg-gradient text-white my-2">Back</a>

                <div class="card bg-light mt-3 mx-auto col-5">
                    <div class="card-header bg-primary bg-gradient text-white">User Creation Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                            $fname = $_POST['fname'];
                            $mname = $_POST['mname'];
                            $lname = $_POST['lname'];
                            $uname = $_POST['uname'];
                            $pwd1 = $_POST['pwd1'];
                            $pwd2 = $_POST['pwd2'];
                           
                            if ($pwd1 == $pwd2) {
                                $sql = "select username from users where username='$uname'";

                                if (mysqli_num_rows(mysqli_query($con, $sql)) > 0) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Username has already been taken.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                                } else {
                                    $sql = "insert into users values (null, '$fname', '$mname', '$lname', '$uname', '$pwd1', 'admin', 1)";

                                    if (mysqli_query($con, $sql)) {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Success: </strong> User has been registered.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                                    }
                                }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Passwords does not match.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>"; 
                            }
                        }
                        ?>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control form-control-sm" aria-describedby="passwordHelpBlock" required>
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                            <div class="col">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="mname" class="form-control form-control-sm" aria-describedby="passwordHelpBlock">
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col ">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control form-control-sm" aria-describedby="passwordHelpBlock" required>
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                            <div class="col">
                                <label class="form-label">Username</label>
                                <input type="text" name="uname" class="form-control form-control-sm" aria-describedby="passwordHelpBlock" minlength="6" required>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col ">
                                <label class="form-label">Password</label>
                                <input type="password" minlength="8" name="pwd1" class="form-control form-control-sm" aria-describedby="passwordHelpBlock" required>
                                
                            </div>
                            <div class="col">
                                <label class="form-label">Retype Password</label>
                                <input type="password" name="pwd2" minlength="8" class="form-control form-control-sm" aria-describedby="passwordHelpBlock" minlength="6" required>
                            </div>
                            <div id="passwordHelpBlock" class="form-text px-4 py-2" style="font-size: 0.7rem;">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>

                        <input type="submit" name="createBtn" value="Create Account" class="btn btn-sm w-100 btn-custom2 bg-gradient text-white">
                    </form>
                </div>
            </div>


        </div>

        <!-- footer -->
        <?php
        include "../../includes/footer.php";
        ?>
    </div>

    <script src="../../src/js/bootstrap.bundle.min.js"></script>
</body>

</html>