<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">
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
    <!-- slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?microsoft,programmer" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,hacking" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- categories container starts here -->
    <div class="container my-4" id=ques>
        <h2 class="text-center my-4">Code Talk - Browse Categories</h2>
        <div class="row my-4">
            <!-- fetch all the categories -->
            <!-- using a for loop to iterate through categories -->
            <?php
            $sql = "SELECT * FROM `categories` ";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_assoc($result)) 
            {
                    //  $row['category_id'];
                    $id =  $row['category_id'];
                    $cat =  $row['category_name'];
                    $desc = $row['category_description'];
                    echo  '<div class="col-md-4 my-2">
                    <div class="card " style="width: 18rem;">
                    <img src="https://source.unsplash.com/500x400/?'.$cat.',coding" class="card-img-top">
                            <div class="card-body ">
                                <h5 class="card-title"><a class = "text-dark" href = "threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                                <p class="card-text">'.substr($desc,0,100).'...</p>
                                <a href="threadlist.php?catid='.$id.'" class="btn btn-success">View Threads</a>
                            </div>
                        </div>
                    </div>';
        }
        ?>
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