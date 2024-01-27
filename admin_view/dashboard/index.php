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
        $page_name = "dashboard";


        $sql_books = "select id from books";

        $sql_borrowers = "select id from borrowers";

        $sql_not_returned = "select id from transactions where status='borrowed'";

    

        ?>

        <!-- main content -->
        <div class="main-content flex-grow-1 bg-light py-5 d-flex flex-row gap-3 justify-content-center">
            <!-- side nav -->
            <?php
            include "../../includes/sidebar.php";
            ?>

            <!-- main content -->
            <div class="content card col-md-8 p-4">
                <!-- page name -->
                <h4 class="text-uppercase text-secondary ">Dashboard</h4>

                <!-- cards statistics -->
                <div class="container p-3 d-flex flex-row gap-4">
                    <div class="card flex-fill p-4 bg-gradient bg-primary d-flex flex-column">
                        <div class="d-flex justify-content-center align-items-center ">
                            <img src="../../src/img/books.png" class="mx-3" alt="books" width="30">
                            <h6 class="text-center text-uppercase h6 text-light">Registered Books</h6>
                        </div>
                        <h4 class="text-center text-white py-1"><?php $books = mysqli_num_rows(mysqli_query($con, $sql_books)); echo $books; ?></h4>
                    </div>
                    <div class="card flex-fill p-4 bg-gradient bg-dark d-flex flex-column">
                        <div class="d-flex justify-content-center align-items-center ">
                            <img src="../../src/img/turn-back.png" class="mx-3" alt="books" width="30">
                            <h6 class="text-center text-uppercase h6 text-light">Unreturned Books</h6>
                        </div>
                        <h4 class="text-center text-white py-1"><?php $not_returned = mysqli_num_rows(mysqli_query($con, $sql_not_returned)); echo $not_returned; ?></h4>
                    </div>
                    <div class="card flex-fill p-4 bg-gradient bg-custom1 d-flex flex-column">
                        <div class="d-flex justify-content-center align-items-center ">
                            <img src="../../src/img/group.png" class="mx-3" alt="books" width="30">
                            <h6 class="text-center text-uppercase h6 text-light">Registered Borrowers</h6>
                        </div>
                        <h4 class="text-center text-white py-1"><?php $borrowers =mysqli_num_rows(mysqli_query($con, $sql_borrowers)); echo $borrowers; ?></h4>

                    </div>
                </div>


                <!-- carousel -->
                <div class="border col-8 mx-auto rounded">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner img">
                            <div class="carousel-item active">
                                <img src="../../src/img/pexels-photo-1106468.jpeg" class="d-block w-100" height="450" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../src/img/pexels-photo-256431.jpeg" class="d-block w-100" height="450" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../src/img/books-bookstore-book-reading-159711.jpeg" class="d-block w-100" height="450" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
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