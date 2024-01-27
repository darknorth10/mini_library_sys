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
                <h4 class="text-uppercase text-secondary ">Books Management</h4>

                <!-- action buttons -->
                <div class="col d-flex justify-content-end">
                    <a href="add_book.php" class="btn btn-sm btn-dark bg-gradient text-white my-4">Add New Book</a>
                </div>
                

                <div class="col d-flex justify-content-end">
                    <form method="get" class="input-group input-group-sm p-3 w-50 bg-light rounded d-flex flex-row justify-content-end">
                        <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white bg-gradient" type="submit" id="button-addon2">Search</button>
                    </form>
                </div>


                <!-- table -->

                <div class="tbl-div container my-4 p-3 overflow-y-auto" style="max-height: 400px;">
                    <table class="table table-hover table-responsive table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Serial No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>No. of Copies</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            if (isset($_GET['search'])) {

                                $search = mysqli_escape_string($con, $_GET['search']);

                                $sql = "select * from books where title LIKE '%$search%' or author LIKE '%$search%' or serial_no LIKE '%$search%'";

                                $results = mysqli_query($con, $sql);
                                
                                if (mysqli_num_rows($results) > 0) {
                                    while ($row = mysqli_fetch_assoc($results)) {
                                        echo "<tr>
                                                <td>$row[serial_no]</td>
                                                <td>$row[title]</td>
                                                <td>$row[author]</td>
                                                <td>$row[category]</td>
                                                <td>$row[copies]</td>
                                                ";
                                        if ($row['copies'] > 0) {
                                            echo "<td class='text-custom2'>Available</td>";
                                        } else {
                                            echo "<td class='text-danger'>Out of Stocks</td>
                                            ";
                                        }
                                        echo "<td class='p-0 d-flex justify-content-center'><a href='update_book.php?id=$row[id]' class='btn btn-sm btn-custom2 bg-gradient text-white m-2 text-uppercase'>Update</a>
                                        <a href='add_copies.php?id=$row[id]' class='btn btn-sm btn-primary bg-gradient text-white m-2 text-uppercase'>Add Copies</a>
                                        <a href='#.php' class='btn btn-sm btn-danger bg-gradient text-white m-2 text-uppercase'>Delete</a>
                                        </td>
                                        </tr>";
                                    }
                                } else
                                echo "<tr><td colspan='6' class='text-secondary text-center'>No result</td></tr>";
                                
                            } else {
                                $sql = "select * from books order by id desc";
                                $results = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<tr>
                                            <td>$row[serial_no]</td>
                                            <td>$row[title]</td>
                                            <td>$row[author]</td>
                                            <td>$row[category]</td>
                                            <td>$row[copies]</td>
                                            ";
                                    if ($row['copies'] > 0) {
                                        echo "<td class='text-custom2'>Available</td>
                                        ";
                                    } else {
                                        echo "<td class='text-danger'>Out of Stocks</td>
                                        ";
                                    }
                                    echo "<td class='p-0 d-flex justify-content-center'><a href='update_book.php?id=$row[id]' class='btn btn-sm btn-custom2 bg-gradient text-white m-2 text-uppercase'>Update</a>
                                    <a href='add_copies.php?id=$row[id]' class='btn btn-sm btn-primary bg-gradient text-white m-2 text-uppercase'>Add Copies</a>
                                    <a href='delete_book.php?id=$row[id]' class='btn btn-sm btn-danger bg-gradient text-white m-2 text-uppercase'>Delete</a>
                                    </td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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