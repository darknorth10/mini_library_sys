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
                    <div class="card-header bg-danger bg-gradient text-white">Book Deletion Confirmation</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                           
                            if (isset($_POST['hidden_id'])) {
                                $id = $_POST['hidden_id'];

                                $sql = "delete from books where id='$id'";

                                    mysqli_query($con, $sql);

                                    if (mysqli_affected_rows($con) == 1) {
                                        header('location: index.php');
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Error: </strong> An error occured while deleting the book.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                    }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Error deleting the book.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>"; 
                            }
                            
                        }

                        ?>

                        <div class="row mb-4">
                            <p>Are you really sure to delete the book entitled <span
                                    class="text-danger"><?php echo $row['title']; ?></span> ?</p>

                            <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                        </div>


                        <div class="container d-flex gap-3">
                            <a href="./" class="btn btn-sm w-100 btn-secondary">Cancel</a>
                            <input type="submit" name="createBtn" value="Delete"
                                class="btn btn-sm w-100 btn-danger bg-gradient text-white flex-grow-1">
                        </div>

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