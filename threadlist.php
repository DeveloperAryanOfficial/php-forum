<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iSecure demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php
    include 'partials/_DBconnect.php';
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['category_name'];
        $desc = $row['category_description'];
    }

    ?>
    <?php
$showalert = false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=="POST"){
    // Insert data into DB
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showalert = true;
    if ($showalert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfull</strong> Your thread has been added , Please wait for community to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> ';
    }

}
?>



    <div class="container my-3 bg-body-secondary">
        <div class="container scrollspy-examplebg-body-tertiary p-3 rounded-2">
            <h1 class=" display-1 ">Welcome to <?php echo $name; ?> forums</h1>
            <p><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.
                Keep it clean. Don't post anything obscene or sexually explicit.
                Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.
                Respect our forum.</p>
            <button type="button" class="btn btn-success">Learn more</button>
        </div>
    </div>





    <div class="container">
        <h1>Ask Questions here</h1>
        <div class="container">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><b>Problme Title</b></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Keep your title as shorts as crips as possible</div>
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea" class="form-label"><b>Elaborate your problem</b></label>
                    <textarea class="form-control" name="desc" placeholder="Leave a problem" id="floatingTextarea"></textarea>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="container bg-body-secondary my-3" style="min-height: 800px;">


        <?php
        include 'partials/_DBconnect.php';
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` where thread_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $id = $row['thread_id'];

            echo '<div class="media my-3">
            <i class="fas fa-user" style="border: 1px solid black;border-radius:50%;padding:5px;" id="user"></i>
            <label for="user">Username</label>
            <div class="media-body">
                <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                ' . $desc . '
            </div>
        </div>';
        }
        if ($noResult == true) {
            echo ' <div class="container">
                <h1 class="display-2">No Threads Found</h1>
                <p>Be the first person you can ask a question</p>
            </div> ';
        }
        ?>
    </div>


    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>