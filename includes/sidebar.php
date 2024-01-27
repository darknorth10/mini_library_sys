<div class="sidebar p-4 col-2 card">
    <div class="sidenav">
        <div class="user">
            <img src="../../src/img/user.png" class="d-block m-auto p-3" alt="userlogo" width="150">
            <p class="text-center text-info text-uppercase">Welcome, <?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="list-group">
            <a href="../dashboard/index.php"
                class="list-group-item list-group-item-action <?php echo $retVal = ($page_name == "dashboard") ? "active" : ""; ?>">Dashboard</a>
            <a href="../transactions/index.php"
                class="list-group-item list-group-item-action <?php echo $retVal = ($page_name == "transaction") ? "active" : ""; ?>">Transactions</a>
            <a href="../borrowers/index.php"
                class="list-group-item list-group-item-action <?php echo $retVal = ($page_name == "borrowers") ? "active" : ""; ?>">Borrowers</a>
            <a href="../books/index.php"
                class="list-group-item list-group-item-action <?php echo $retVal = ($page_name == "books") ? "active" : ""; ?>">Books</a>
            <a href="../users/index.php"
                class="list-group-item list-group-item-action <?php echo $retVal = ($page_name == "um") ? "active" : ""; ?>">User
                Management</a>

        </div>
    </div>
</div>