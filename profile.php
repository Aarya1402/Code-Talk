<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">

    <title>Code Talk</title>
    <style>
        .container .details {
            border: 2px solid #dee2e6 !important;
            height: 100%;
            padding: 15px;
            background-color: var(--body-tertiary);
            border-radius: 8px;
            border-width: 8px;
        }

        #ques {
            min-height: 433px;
        }
    </style>
</head>

<body>
    <?php
    include 'Partials/_dbconnect.php';
    include 'Partials/_headers.php';
    ?>

    <div class="container" id="ques">
        <?php
        echo '<h2 class="mt-4 mb-2"> Threads</h2>';
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `threads` WHERE thread_user_id = $user_id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noresult = false;
                $title = $row['thread_title'];
                $desc = $row['thread_description'];
                $thread_id = $row['thread_id'];
                echo '<div class="details mt-2"><a class = "link-dark text-weight-bold" href="http://localhost/PHP%20project/thread.php?threadid=' . $thread_id . '">' . $title . '</a><br>' . $desc . '</div>';
            }
            if ($noresult) {
                echo '<div class = "details mt-2"><h5>No threads found</h5></div>';
            }




            echo '<h2 class="mt-4 mb-2"> Comments</h2>';

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `comments` WHERE comment_by = $user_id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noresult = false;
                $content = $row['comment_content'];

                $thread_id = $row['thread_id'];
                echo '<div class="details "><a class = "link-dark text-weight-bold" href="http://localhost/PHP%20project/thread.php?threadid=' . $thread_id . '">See other Comments</a><br>' . $content . '</div>';
            }
            if ($noresult) {
                echo '<div class = "details mt-2"><h5>No comments found</h5></div>';
            }
        }
        else
        {
            echo '<div class = "details mt-2"><h5>Please login first.</h5></div>';

        }
        ?>

    </div>


    <?php include 'Partials/_footer.php'; ?>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    -->
</body>

</html>