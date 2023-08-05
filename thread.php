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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_description'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE user_id = '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    if ($method == 'POST') {
        if (isset($_POST['comment']) && !empty($_POST['comment'])) {
            // Insert comment into db
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            $user_id = $_POST['user_id'];
            $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES (NULL, '$comment', '$id', current_timestamp(), '$user_id')";
            $result = mysqli_query($conn, $sql);
            $showalert = true;
            if ($showalert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>Your comment has been added successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>';
            }
        }
    }


    ?>

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
                Posted By:<em>
                    <?php echo " $posted_by"; ?>
                </em>
            </p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container">
        <h1 class="my-4">Post a Comment</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . ' " method="post">

            <div class="mb-3">

                <label for="exampleForControlTextarea1">Type your Comment</label>

                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="user_id" value= " ' . $_SESSION['user_id'] . '">
                </div>
                
                <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
                </div>';
    } else {
        echo '<div class = "container"><h1 class="my-2">Post a Comment</h1>
                <p class = "lead"><b>You are not logged in. Please login to post Comment.</b></p></div>';
    }
    ?>



    <div class="container mb-5" id="ques">
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
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE user_id = '$comment_by'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo ' <div class="media my-3">
            <!-- <div class="flex-shrink-0"> -->
        <img src="https://user-images.githubusercontent.com/124037849/222655455-78516d85-2d8c-423b-8b77-24ab5c552dd8.png"
            class="mr-3" width="54px">

        <!-- </div> -->
        <div class="media-body">
        <p class="my-0"><b>' . $row2['user_email'] . '</b> on ' . date('F j, Y', strtotime($comment_time)) . '</p>
           
            ' . $content . '
        </div>
    </div>';

        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <p class="display-4">No Comments Found</p>
            <p class="lead">Be the first person to add a comment.</p>
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