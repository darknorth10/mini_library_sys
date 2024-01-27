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

        $id = $_GET['id'];

        $sql = "select * from borrowers where id='$id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        } else {
            header('location: index.php');
        }

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
                    <div class="card-header bg-custom1 bg-gradient text-white">Update Borrowers Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {

                            if (isset($_POST['fn']) && isset($_POST['id_presented']) && isset($_POST['address'])) {
                                $fn = $_POST['fn'];
                                $id_presented = $_POST['id_presented'];
                                $address = $_POST['address'];
                                $status = $_POST['status'];
                                $sql = "update borrowers set full_name='$fn', id_presented='$id_presented', address='$address', status='$status' where id='$id'";

                                mysqli_query($con, $sql);

                                if (mysqli_affected_rows($con) == 1) {
                                    header('location: index.php');
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Error: </strong> An error occured while updating the book.
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
                                <input type="text" name="fn" value="<?php echo $row['full_name']; ?>"
                                    class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col">
                                <label class="form-label">ID Presented</label>
                                <input type="text" name="id_presented" value="<?php echo $row['id_presented']; ?>"
                                    class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col mb-4">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" cols="10" rows="3"><?php echo $row['address'] ?></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="">-----------</option>

                                    <?php
                                    if ($row['status'] == "eligible") {
                                        echo "<option value='eligible' selected>Eligible</option>
                                        
                                        <option value='suspended'>Suspended</option>";
                                    } else if ($row['status'] == "ineligible") {
                                        echo "
                                        <option value='ineligible' selected>Ineligible</option>
                                        ";
                                    } else if ($row['status'] == "suspended") {
                                        echo "<option value='eligible'>Eligible</option>
                                        
                                        <option value='suspended' selected>Suspended</option>";
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>


                        <input type="submit" name="createBtn" value="Update Borrower"
                            class="btn btn-sm w-100 btn-custom1 bg-gradient text-white mb-2">
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