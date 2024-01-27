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
                <h4 class="text-uppercase text-secondary">Transactions - Lend Book</h4>
                <a href="transactions.php" class="col-4 btn btn-dark bg-gradient text-white mx-auto d-block my-5">View All Transactions >>></a>

                <div class="card bg-light mt-3 mx-auto col-7">
                    <div class="card-header bg-primary bg-gradient text-white">Book Lending Form</div>
                    <form class="p-4" method="post">
                        <?php
                        if (isset($_POST['createBtn'])) {
                            
                            if (isset($_POST['bid']) && isset($_POST['bsn'])) {

                                $bid = mysqli_escape_string($con, $_POST['bid']);
                                $bsn = mysqli_escape_string($con, $_POST['bsn']);
                                $processed_by = $_SESSION['username'];
                                $borrowed_at = date('Y-m-d');
                                $status = "borrowed";

                                // validations
                                $sql2 = "select copies from books where serial_no = '$bsn'";
                                $copies = mysqli_fetch_array(mysqli_query($con, $sql2));
                                $sql3 = "select status from borrowers where id = '$bid'";
                                $status1 = mysqli_fetch_array(mysqli_query($con, $sql3));
                         
                                //  if book stocks is not 0 and borrower is eligible 
                                if ($copies[0] >= 1 && $status1[0] == "eligible") {

                                    $sql = "insert into transactions values (null, '$bid', '$bsn', '$borrowed_at', null, '$processed_by', '$status')";
                                   
                                    if (mysqli_query($con, $sql)) {
                                        $sql = "update books set copies = copies - 1 where serial_no='$bsn'";
                                        mysqli_query($con, $sql);
                                        $sql = "update borrowers set status = 'ineligible' where id='$bid'";
                                        mysqli_query($con, $sql);
    
                                        if (mysqli_errno($con) == 0) {
                                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                    <strong>Success: </strong> A book has been lent.
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                        } else {
                                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Error: </strong> Error occured while processing request.
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                 </div>";
                                        }
                                    }

                                   
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Error: </strong> Error processing the request the borrower might not be eligible, or the book was already out of copies.
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
                        <div class="alert alert-info py-2 px-3" role="alert">
                            <h4 class="alert-heading small fw-bold">Note:</h4>
                            <p class="small text-center m-0 pb-2">Only one book can be lent to a borrower.</p>
            
                        </div>            
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Borrower ID</label>
                                <select class="form-select" name="bid" required>
                                    <option value="">-----------</option>
                                    <?php
                                    $sql1 = "select id, full_name from borrowers where status='eligible' order by id desc";
                                    $results = mysqli_query($con, $sql1);

                                    while ($row = mysqli_fetch_assoc($results)) {
                                        echo "<option value='$row[id]'>ID # : $row[id] | $row[full_name]</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Book Serial Number</label>
                                <select class="form-select" name="bsn" required>
                                    <option value="">-----------</option>
                                    <?php
                                    $sql2 = "select title, serial_no from books where copies > 0 ORDER BY id desc";
                                    $results = mysqli_query($con, $sql2);

                                    while ($row = mysqli_fetch_assoc($results)) {
                                        echo "<option value='$row[serial_no]'>SN : $row[serial_no] | $row[title]</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        
                        <input type="submit" name="createBtn" value="Lend Book"
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