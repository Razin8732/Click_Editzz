<?php ob_start();
 session_start(); 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
    .card .overflow-auto {
        max-height: 30rem;
    }

    .card .tick li {
        list-style-type: none;
        margin-top: 8px;
    }

    .card .tick li:nth-child(odd) {
        background: #eee;
    }

    .card .tick li:nth-child(even) {
        background: #faf;
    }

    .card .tick li::before {
        content: "✔";
        padding: 4px;
    }
    </style>

</head>

<body>
    <?php include '../header.php';?>
    <?php include '../connection.php';?>

    <?php echo $_GET['id']; ?>

    <?php 
    $cid=$_GET['id'];
    $sql="Select * from course where id='".$cid."'";
    $result=$conn->query($sql);
    if ($result->num_rows == 0) {
   header("Location: ../");
die();
    
    }
    $row=$result->fetch_assoc();

    $sql_i = "SELECT * FROM instructor where id='".$row['i_id']."'";
    $result_i = $conn->query($sql_i);
    $row_i=$result_i->fetch_assoc();

    ?>

    <div class="card m-auto shadow-lg  rounded-lg " style="max-width: 40rem;">
        <img src="<?php echo "../".$row['path']."Thumbnail.jpg";?>" class="card-img-top" alt="..."
            style="max-height:400px; background-size:contain;">
        <div class="card-body">
            <h5 class="card-title">
                <?php     echo $row['title']; ?>
            </h5>
        </div>
        <div class="card-footer">
            <span class="text-muted">By <?php echo $row_i['name']; ?> at <?php echo $row['created_at']; ?></span>
            <span class="btn btn-secondary mx-2 float-right">&#8377; <?php echo $row['amount'];?></span>
            <a class="btn btn-outline-primary stretched-link float-right"
                href="payment/index.php?id=<?php echo $row['id'];?>"> Buy Now</a>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-lg-6">
            <div class="card  shadow-lg rounded-lg my-3">
                <div class="card-header">
                    <h5 class="card-title">What you'll learn</h5>
                    <div class="text-dark tick overflow-auto"><?php echo $row['lern']; ?></div>
                </div>
            </div>
        </div>
        <div class="col col-12 col-lg-6">
            <div class="card shadow-lg rounded-lg my-3">
                <div class="card-header">
                    <h5 class="card-title">Requirements </h5>
                    <div class="text-danger tick overflow-auto"><?php echo $row['prereq']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg rounded-lg my-3">
        <div class="card-header">
            <h5 class="card-title">Description</h5>
            <div class="text-secondary overflow-auto"><?php echo $row['description']; ?></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>

<?php 
ob_end_flush();
?>