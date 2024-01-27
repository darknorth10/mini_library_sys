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
        $page_name = "borrowers";

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
                    <div class="card-header bg-primary bg-gradient text-white">Borrower Registration Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                            

                            if (isset($_POST['full_name']) && isset($_POST['id_presented']) && isset($_POST['address']) && isset($_POST['status'])) {

                                $fn = mysqli_escape_string($con, $_POST['full_name']);
                                $id_presented = mysqli_escape_string($con, $_POST['id_presented']);
                                $address = mysqli_escape_string($con, $_POST['address']);
                                $status = mysqli_escape_string($con, $_POST['status']);
                                $joined_at = date('Y-m-d');
                                
                                $sql = "insert into borrowers values (null, '$fn', '$id_presented', '$address', '$status', '$joined_at')";

                                if (mysqli_query($con, $sql)) {
                                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>Success: </strong> Borrower has been registered.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> All fields are required.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                            }
                        }
                        ?>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control form-control-sm" required>
                            </div>
                            <div class="col">
                                <label class="form-label">ID Presented</label>
                                <input type="text" name="id_presented" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" cols="10" rows="3" required></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="">-----------</option>
                                    <option value="eligible" selected>Eligible</option>
                                    <option value="suspended">Suspended</option>

                                </select>
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