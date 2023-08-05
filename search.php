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
        #maincontainer {
            min-height: 700px;
        }
    </style>
    <title>Code Talk</title>
</head>

<body>
    <?php include 'Partials/_dbconnect.php'; ?>
    <?php include 'Partials/_headers.php'; ?>
    <!-- search results starts here -->

    <div class="container my-3" id = "maincontainer">
        <h1>Search Results for
            <em>
                <?php echo $_GET["search"]; ?>
            </em>

        </h1>
        <hr>
        <?php
        $query = $_GET["search"];
        $noresults = true;
        $sql = "select * from threads where match(thread_title,thread_description) against ('$query')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noresults = false;
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=" . $thread_id;
            echo ' <h3 class="my-3"> <a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
            <p> ' . $desc . '</p>';
        }
        if($noresults)
        {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">No Results Found</p>
                <p class="lead">Suggetions:
                <ul><li>Make sure all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords</li><ul>
                </p>
            </div>
        </div>';
        }
        ?>
        <div class="result">

        </div>
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