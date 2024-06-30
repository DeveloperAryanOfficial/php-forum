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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }




    ?>

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        // Insert data into DB
        $content = $_POST['comment'];
        
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_time`) VALUES ('$content', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfull</strong> Your comment has been added .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> ';
        }
    }
    ?>
    <div class="container my-3 bg-body-secondary">
        <div class="container scrollspy-examplebg-body-tertiary p-3 rounded-2">
            <h1><?php echo $title; ?></h1>
            <p><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.
                Keep it clean. Don't post anything obscene or sexually explicit.
                Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.
                Respect our forum.</p>
            <p><b>Posted by: Aryan</b></p>
        </div>
    </div>


    <div class="container bg-body-secondary">
        <div class="container">
            <h1>Start a Discussion</h1>
            <div class="container">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                    <div class="mb-3">
                        <label for="floatingTextarea" class="form-label"><b>Type your comment</b></label>
                        <textarea class="form-control" name="comment" placeholder="Leave a problem" id="floatingTextarea"></textarea>

                    </div>
                    <button type="submit" class="btn btn-success">Post comment</button>
                </form>
            </div>
        </div>
    </div>




    <div class="container">
        <h1 class="display-1">Browse Questions : </h1>

        <?php
        include 'partials/_DBconnect.php';
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` where thread_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];

            echo '<div class="media my-3">
            <i class="fas fa-user" style="border: 1px solid black;border-radius:50%;padding:5px;" id="user"></i>
            <label for="user">Username at '.$time.'</label>
            <div class="media-body">
                
                ' . $content . '
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