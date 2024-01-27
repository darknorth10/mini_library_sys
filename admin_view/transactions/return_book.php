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
        $page_name = "transaction";

        $id = mysqli_escape_string($con, $_GET['id']);

        $sql = "select * from transactions where id='$id'";

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
                <h4 class="text-uppercase text-secondary">Transactions - Returning Book</h4>
                <a href="transactions.php" class="btn btn-sm btn-dark bg-gradient text-white my-2">Back</a>

                <div class="card bg-light mt-3 mx-auto col-5">
                    <div class="card-header bg-primary bg-gradient text-white">Return Book Confirmation</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {

                            if (isset($_POST['hidden_id']) && isset($_POST['bsn']) && isset($_POST['bid'])) {

                                $id = mysqli_escape_string($con, $_POST['hidden_id']);
                                $bid = mysqli_escape_string($con, $_POST['bid']);
                                $bsn = mysqli_escape_string($con, $_POST['bsn']);
                                $returned_at = date('Y-m-d');

                                $sql = "update transactions set status='complete', returned_at='$returned_at' where id='$id'";
                                mysqli_query($con, $sql);

                                if (mysqli_affected_rows($con) == 1) {
                                    $sql = "update books set copies = copies + 1 where serial_no='$bsn'";
                                    mysqli_query($con, $sql);
                                    $sql = "update borrowers set status = 'eligible' where id='$bid'";
                                    mysqli_query($con, $sql);

                                    if (mysqli_errno($con) == 0) {
                                        header('location: transactions.php');
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <strong>Error: </strong> Error occured while processing request.
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                             </div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                            <strong>Error: </strong> Error occured while processing request.
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                         </div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error: </strong> Error occured.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                            }
                        }

                        ?>

                        <div class="row mb-4">
                            <p>Are you really sure the book with serial number <span class="text-custom2"><?php echo $row['book_serial_no']; ?></span> has been returned?</p>

                            <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="bid" value="<?php echo $row['borrower_id']; ?>">
                            <input type="hidden" name="bsn" value="<?php echo $row['book_serial_no']; ?>">
                        </div>


                        <div class="container d-flex gap-3">
                            <a href="transactions.php" class="btn btn-sm w-100 btn-secondary">Cancel</a>
                            <input type="submit" name="createBtn" value="Confirm" class="btn btn-sm w-100 btn-primary bg-gradient text-white flex-grow-1">
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