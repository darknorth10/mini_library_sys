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
        $page_name = "books";

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
                <h4 class="text-uppercase text-secondary">Boooks Management</h4>
                <a href="index.php" class="btn btn-sm btn-dark bg-gradient text-white my-2">Back</a>

                <div class="card bg-light mt-3 mx-auto col-5">
                    <div class="card-header bg-primary bg-gradient text-white">Book Registration Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                            $serial = mysqli_escape_string($con, $_POST['serial']);
                            $title = mysqli_escape_string($con, $_POST['title']);
                            $author = mysqli_escape_string($con, $_POST['author']);
                            $category = mysqli_escape_string($con, $_POST['category']);
                            $copies = mysqli_escape_string($con, $_POST['copies']);
                            
                           
                            if (!empty($serial) && !empty($title) && !empty($author) && !empty($category)) {
                                $sql = "select serial_no from books where serial_no='$serial'";

                                if (mysqli_num_rows(mysqli_query($con, $sql)) > 0) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Serial number has already been taken.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                                } else {
                                    $sql = "insert into books values (null, '$serial', '$title', '$author', '$copies', '$category')";

                                    if (mysqli_query($con, $sql)) {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Success: </strong> Book has been registered.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                                    }
                                }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> All fields are required.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>"; 
                            }
                        }
                        ?>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label">Serial Number</label>
                                <input type="number" min="0" name="serial" class="form-control form-control-sm"
                                    aria-describedby="passwordHelpBlock" required>
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                            <div class="col">
                                <label class="form-label">Book title</label>
                                <input type="text" name="title" class="form-control form-control-sm"
                                    aria-describedby="passwordHelpBlock">
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col ">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" class="form-control form-control-sm"
                                    aria-describedby="passwordHelpBlock" required>
                                <!-- <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div> -->
                            </div>
                            <div class="col">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control form-control-sm"
                                    aria-describedby="passwordHelpBlock" minlength="6" required>

                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col ">
                                <label class="form-label">Number of Copies</label>
                                <input type="number" min="1" name="copies" class="form-control form-control-sm"
                                    aria-describedby="passwordHelpBlock" required>

                            </div>

                        </div>

                        <input type="submit" name="createBtn" value="Register Book"
                            class="btn btn-sm w-100 btn-custom2 bg-gradient text-white">
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