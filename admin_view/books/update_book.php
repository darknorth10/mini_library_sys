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
                    <div class="card-header bg-custom1 bg-gradient text-white">Update Book Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                            $serial = mysqli_escape_string($con, $_POST['serial']);
                            $title = mysqli_escape_string($con, $_POST['title']);
                            $author = mysqli_escape_string($con, $_POST['author']);
                            $category = mysqli_escape_string($con, $_POST['category']);
                           // $copies = $_POST['copies'];
                            
                           
                            if (!empty($title) && !empty($author) && !empty($category)) {
                                $sql = "update books set title='$title', author='$author', serial_no='$serial', category='$category' where serial_no='$serial'";

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
                                <label class="form-label">Serial Number</label>
                                <input type="number" min="0" name="serial" value="<?php echo $row['serial_no']; ?>" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col">
                                <label class="form-label">Book title</label>
                                <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col ">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" value="<?php echo $row['author']; ?>" class="form-control form-control-sm" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" value="<?php echo $row['category']; ?>" class="form-control form-control-sm" minlength="6" required>

                            </div>
                        </div>
                       

                        <input type="submit" name="createBtn" value="Update Book" class="btn btn-sm w-100 btn-custom1 bg-gradient text-white mb-2">
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