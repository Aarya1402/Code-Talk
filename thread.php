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
    <?php include 'Partials/_dbconnect.php'; ?>
    <?php include 'Partials/_headers.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_description'];
    }
    ?>
    <!-- categories container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $title; ?>
            </h1>
            <p class="lead">
                <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>

            <p class="lead">
                <b>Posted By: Harry</b>
            </p>
        </div>
    </div>

    <div class="container">
        <h1 class="my-4">Post a Comment</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
        
            <div class="mb-3">

                <label for="exampleForControlTextarea1">Type your Comment</label>

                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>

            </div>

            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>
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

    <div class="container" id="ques">
        <h1 class="my-2">Discussion</h1>
         <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id ";
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
           

            echo ' <div class="media my-3">
            <!-- <div class="flex-shrink-0"> -->
        <img src="https://user-images.githubusercontent.com/124037849/222655455-78516d85-2d8c-423b-8b77-24ab5c552dd8.png"
            class="mr-3" width="54px">

        <!-- </div> -->
        <div class="media-body">
           
            ' . $content . '
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>