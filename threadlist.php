<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;

    }
    </style>
    <title>Code Talk</title>
</head>

<body>
    <?php
    include 'Partials/_dbconnect.php';
    include 'Partials/_headers.php';
    ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }

    ?>
    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    if ($method == 'POST') {

        // Insert thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `thread_time`) VALUES (NULL, '$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>Your Talk has been added successfully.Please wait for community to respond.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>';
        }
    }


    ?>

    <!-- categories container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to
                <?php echo $catname; ?> forums
            </h1>
            <p class="lead">
                <?php echo $catdesc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        echo '
    <div class="container">
        <h1 class="my-2">Start a Talk</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <div id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as possible</div>
            </div>
            <div class="mb-3">

                <label for="exampleForControlTextarea1">Ellaborate your concerns</label>

                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>

            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
';
    } else {
        echo '<div class = "container"><h1 class="my-2">Start a Talk</h1>
        <p class = "lead"><b>You are not logged in. Please login to start a Talk.</b></p></div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="my-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $noresult = true;
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $tid = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $thread_time = $row['thread_time'];

            echo ' <div class="media my-3">
            <!-- <div class="flex-shrink-0"> -->
            <img src="https://user-images.githubusercontent.com/124037849/222655455-78516d85-2d8c-423b-8b77-24ab5c552dd8.png"
                class="mr-3" width="54px">

            <!-- </div> -->
            <div class="media-body">
    <p class=" my-0"><b>Anonymous user</b>  on ' . date('F j, Y h:i A', strtotime($thread_time)) . ' </p>
    <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
    <?php echo $desc; ?>
    </div>


    </div>';

    }
    if ($noresult) {
    echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <p class="display-4">No Talks Found</p>
            <p class="lead">Be the first person to ask a question.</p>
        </div>
    </div>';
    }
    ?>


    </div>

    <?php include 'Partials/_footer.php'; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    -->
</body>

</html>