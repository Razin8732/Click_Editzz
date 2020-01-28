<?php

session_start();

if(!isset($_SESSION['auth_i'])){

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
    <?php include '../connection.php';?>


    <?php
                $sql_u = "SELECT * FROM instructor where email='".$_SESSION['email_i']."'";
                $result_u = $conn->query($sql_u);
                $row_i=$result_u->fetch_assoc();
                
                ?>
    <div class="card  shadow-lg  rounded-lg m-auto mt-5" style="max-width: 40rem;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    Name :

                </div>
                <div class="col">
                    <?php echo $row_i['name']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Email :

                </div>
                <div class="col">
                    <?php echo $row_i['email']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Password :

                </div>
                <div class="col">
                    <?php echo $row_i['password']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Created At :
                </div>
                <div class="col">
                    <?php echo $row_i['created_at']; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    
    $sql = "SELECT * FROM payment_to_instructor where i_id ='".$row_i['id']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {?>
    <div class="alert alert-primary mt-2">
     <?php
                    $sql_c = "SELECT * FROM course where id ='".$row['c_id']."'";
                    $result_c = $conn->query($sql_c);
                    $course = $result_c->fetch_assoc();
                ?>
        <h5 class="card-title"><?php echo $course['title'];?></h5>

        At :<?php echo $row['created_at'];?>
        &#8377;<?php echo $course['amount']; ?>
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