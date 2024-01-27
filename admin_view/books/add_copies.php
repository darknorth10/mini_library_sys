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

        $id = $_GET['id'];

        $sql = "select * from books where id='$id'";

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
                    <div class="card-header bg-custom2 bg-gradient text-white">Add Copies Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                           
                            if (!empty($_POST['copies']) && !empty($_POST['hidden_id'])) {
                                $add_copy = mysqli_escape_string($con, intval($_POST['copies']));
                                $id = mysqli_escape_string($con, $_POST['hidden_id']);
                                
                                $sql = "update books set copies= copies + $add_copy where id='$id'";

                                    mysqli_query($con, $sql);

                                    if (mysqli_affected_rows($con) == 1) {
                                        header('location: index.php');
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Error: </strong> An error occured while updating the copies of book.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                    }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Specify Quantity.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>"; 
                            }

                        }

                        ?>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Serial Number</label>
                                <input type="number" min="0" name="serial" value="<?php echo $row['serial_no']; ?>"
                                    class="form-control form-control-sm" aria-describedby="passwordHelpBlock" disabled>
                            </div>
                            <div class="col">
                                <label class="form-label">Book title</label>
                                <input type="text" name="title" value="<?php echo $row['title']; ?>"
                                    class="form-control form-control-sm" aria-describedby="passwordHelpBlock" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col ">
                                <label class="form-label">Current Copies</label>
                                <input type="text" name="author" value="<?php echo $row['copies']; ?>"
                                    class="form-control form-control-sm" aria-describedby="passwordHelpBlock" disabled>
                            </div>
                            <div class="col">
                                <label class="form-label">Copies to be added</label>
                                <input type="number" min="1" max="100" name="copies"
                                    class="form-control form-control-sm" aria-describedby="passwordHelpBlock" required>
                            </div>

                            <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                        </div>



                        <input type="submit" name="createBtn" value="Add Copies"
                            class="btn btn-sm w-100 btn-custom2 bg-gradient text-white mb-2">
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