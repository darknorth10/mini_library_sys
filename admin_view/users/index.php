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
        $page_name = "um";

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
                <h4 class="text-uppercase text-secondary ">Users Management</h4>

                <!-- action buttons -->
                <div class="col d-flex justify-content-end">
                    <a href="add_user.php" class="btn btn-sm btn-primary bg-gradient text-white my-4">New User</a>

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
                        <thead class="table-primary">
                            <tr>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            if (isset($_GET['search'])) {

                                $search = $_GET['search'];

                                $sql = "select * from users where first_name LIKE '%$search%' or last_name LIKE '%$search%' or username LIKE '%$search%'";

                                $results = mysqli_query($con, $sql);
                                
                                if (mysqli_num_rows($results) > 0) {
                                    while ($row = mysqli_fetch_assoc($results)) {
                                        echo "<tr>
                                                <td>$row[first_name] $row[last_name]</td>
                                                <td>$row[username]</td>
                                                <td>$row[role]</td>
                                                ";
                                        if ($row['is_active'] == 1) {
                                            echo "<td class='text-custom2'>ACTIVE</td></tr>";
                                        } else {
                                            echo "<td class='text-danger'>INACTIVE</td></tr>";
                                        }
                                    }
                                } else
                                echo "<tr><td colspan='4' class='text-secondary text-center'>No result</td></tr>";
                                
                            } else {
                                $sql = "select * from users order by id desc";
                                $results = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<tr>
                                            <td>$row[first_name] $row[last_name]</td>
                                            <td>$row[username]</td>
                                            <td>$row[role]</td>
                                            ";
                                    if ($row['is_active'] == 1) {
                                        echo "<td class='text-custom2'>ACTIVE</td></tr>";
                                    } else {
                                        echo "<td class='text-danger'>INACTIVE</td></tr>";
                                    }
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