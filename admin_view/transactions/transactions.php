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
                <h4 class="text-uppercase text-secondary ">Transactions</h4>

                <!-- action buttons -->
                <div class="col d-flex justify-content-end">
                    <a href="index.php" class="btn btn-sm btn-dark bg-gradient text-white my-4">Lend Book</a>
                </div>


                <div class="col d-flex justify-content-end">
                    <form method="get"
                        class="input-group input-group-sm p-3 w-50 bg-light rounded d-flex flex-row justify-content-end">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white bg-gradient" type="submit"
                            id="button-addon2">Search</button>
                    </form>
                </div>


                <!-- table -->
                <div class="overflow-auto container-fluid" style="max-height: 400px;">
                    <div class="tbl-div my-4 p-3" style="width: 90vw;">
                        <table class="table table-hover table-responsive table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Borrower ID</th>
                                    <th>Book Serial</th>
                                    <th>Borrowed at</th>
                                    <th>Returned At</th>
                                    <th>Processed By</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            
                            if (isset($_GET['search'])) {

                                $search = mysqli_escape_string($con, $_GET['search']);

                                $sql = "select * from transactions where id LIKE '%$search%' or borrower_id LIKE '%$search%' or book_serial_no LIKE '%$search%' order by returned_at asc";

                                $results = mysqli_query($con, $sql);
                                
                                if (mysqli_num_rows($results) > 0) {
                                    while ($row = mysqli_fetch_assoc($results)) {
                                        echo "<tr>
                                                <td>$row[id]</td>
                                                <td>$row[borrower_id]</td>
                                                <td>$row[book_serial_no]</td>
                                                <td>$row[borrowed_at]</td>
                                                <td>$row[returned_at]</td>
                                                <td>$row[processed_by]</td>
                            
                            
                                                ";
                                        if ($row['status'] == "complete") {
                                            echo "<td class='text-custom2'>Completed</td>";
                                        } else if($row['status'] == "borrowed") {
                                            echo "<td class='text-danger'>Borrowed</td>
                                            ";
                                        }

                                        if ($row['status'] == "borrowed") {
                                                echo "<td class='p-0 d-flex justify-content-center'><a href='return_book.php?id=$row[id]' class='btn btn-sm btn-primary bg-gradient text-white m-2 text-uppercase'>Return</a>
                                            
                                                </td>
                                            </tr>";
                                        }
                                        
                                    }
                                } else
                                echo "<tr><td colspan='6' class='text-secondary text-center'>No result</td></tr>";
                                
                            } else {
                                $sql = "select * from transactions order by returned_at asc";
                                $results = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<tr>
                                            <td>$row[id]</td>
                                            <td>$row[borrower_id]</td>
                                            <td>$row[book_serial_no]</td>
                                            <td>$row[borrowed_at]</td>
                                            <td>$row[returned_at]</td>
                                            <td>$row[processed_by]</td>
                        
                        
                                            ";
                                    if ($row['status'] == "complete") {
                                        echo "<td class='text-custom2'>Completed</td>";
                                    } else if($row['status'] == "borrowed") {
                                        echo "<td class='text-danger'>Borrowed</td>
                                        ";
                                    }

                                    if ($row['status'] == "borrowed") {
                                            echo "<td class='p-0 d-flex justify-content-center'><a href='return_book.php?id=$row[id]' class='btn btn-sm btn-primary bg-gradient text-white m-2 text-uppercase'>Return</a>
                                        
                                            </td>
                                        </tr>";
                                    }
                                    
                                }
                            }
                            ?>
                            </tbody>
                        </table>
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