<?php
session_start();
include "_dbconnect.php";
echo '

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/Code-Talk">Code Talk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/Code-Talk">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Code-Talk/profile.php">Profile</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                   Top Categories
                </a>
                <ul class="dropdown-menu">';
$sql = "SELECT category_name,category_id FROM `categories` LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';

}

echo '
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href = "contact.php">Contact</a>
            </li>

        </ul>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    echo '
        <form class="d-flex" action = "search.php" method = "get" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success mx-2" type="submit">Search</button>
            <p class ="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
            
    <a href="Partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>

        </form>';

} else {

    echo '
        <form class="d-flex" action = "search.php" method = "get" role="search">
        <input class="form-control me-2" type="search" name = "search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button></form>
        <div class="mx-2">
    <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>';
}
echo '</div>

        </div>
    </div>
</div>
</nav>';

include 'Partials/_loginModal.php';
include 'Partials/_signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success! </strong> Now you can login
   
  </div>';
}

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Warning! </strong> ' . $_GET['error'] . '
   
  </div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success! </strong> You have logged in successfully.
   
  </div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Warning! </strong> ' . $_GET['error'] . '
   
  </div>';
}

?>