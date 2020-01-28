<?php

session_start();

if(!isset($_SESSION['auth'])){

    echo "<script>window.location='/RAZIN/web2/index.php'</script>";
}


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
</head>

<body>
    <?php include 'header.php';?>
    <?php include 'connection.php';?>


    <?php
                $sql_u = "SELECT * FROM enduser where email='".$_SESSION['email']."'";
                $result_u = $conn->query($sql_u);
                $row_u=$result_u->fetch_assoc();
                
                ?>
    <div class="card  shadow-lg  rounded-lg m-auto mt-5" style="max-width: 40rem;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    Name :

                </div>
                <div class="col">
                    <?php echo $row_u['name']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Email :

                </div>
                <div class="col">
                    <?php echo $row_u['email']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Password :

                </div>
                <div class="col">
                    <?php echo $row_u['password']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Created At :
                </div>
                <div class="col">
                    <?php echo $row_u['created_at']; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    
    $sql = "SELECT * FROM course where id in (SELECT c_id from enduser_course where u_id= $row_u[id])";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {?>
            <div class="card" style="width: 18rem;">
            <img src="<?php echo $row['path']."Thumbnail.jpg";?>" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title"><?php echo $row['title'];?></h5>
           BY: <?php
            $sql_i = "SELECT * FROM instructor where id='".$row['i_id']."'";
            $result_i = $conn->query($sql_i);
            $row_i=$result_i->fetch_assoc();
            echo $row_i['name'];

           ?>

           <a  href="coursebuy/?id=<?php echo $row['id'];?>" class="btn btn-outline-secondary float-right btn-lg"> &#8377;<?php echo $row['amount']; ?></a>
           
            </div>
            </div>
        <?php
        }
    } else {
        // echo "0 results";
    }
   ?>
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