<?php session_start();

if(!isset($_SESSION['auth'])){
    echo "<script>window.top.location='/RAZIN/web2/index.php';</script>"; exit;
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
    <?php include '../../header.php';?>
    <?php include '../../connection.php';?>

    <?php 
    ob_start();
        $error="";
    $cid=$_GET['id'];
    $sql="Select * from course where id='".$cid."'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    if ($result->num_rows == 0) {
   echo "<script type='text/javascript'>window.top.location='../';</script>"; exit;

die();
    
    }

    $sql_i = "SELECT * FROM instructor where id='".$row['i_id']."'";
    $result_i = $conn->query($sql_i);
    $row_i=$result_i->fetch_assoc();

    ?>
    <div class="row">
        <div class="col col-md-6">

            <div class="card  shadow-lg  rounded-lg" style="max-width: 40rem;">
                <img src="<?php echo "../../".$row['path']."Thumbnail.jpg";?>" class="card-img-top" alt="..."
                    style="max-height:400px; background-size:contain;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo  $row['title']; ?></h5>
                </div>
                <div class="card-footer">
                    <span class="text-muted">By :<?php echo  $row_i['name']; ?>
                        <br /> At :<?php echo  $row['created_at']; ?></span>
                    <span class="btn btn-secondary mx-2 float-right">&#8377;<?php echo  $row['amount']; ?></span>
                </div>
            </div>
        </div>
        <div class="col col-md-6" style="background-color:#bf42f5;">

            <form method="post" class="mx-auto text-light my-5" style="max-width:30rem;">
                <fieldset>

                    <legend>Payment</legend>
                    <div class="form-group">
                        <label for="number">Card number </label>
                        <input type="number" name="number" class="form-control" id="number"
                            aria-describedby="numberHelp" placeholder="Enter card number" required maxlength="254">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="month">Month </label>
                                <select class="custom-select" name="month" class="form-control" id="month" required>
                                    <option value="1">Jan</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Mar</option>
                                    <option value="4">Apr</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">Aug</option>
                                    <option value="9">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Now</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="year">Year </label>
                                <select class="custom-select" name="year" class="form-control" id="year" required>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cvv">CVV </label>
                                <input type="number" name="cvv" class="form-control" id="cvv" aria-describedby="cvvHelp"
                                    placeholder="Enter CVV" required maxlength="3">
                            </div>
                        </div>
                    </div>
                    <div class="text-danger"><?php if($error!=""){echo $error;}?></div>
                    <input type="submit" class="btn btn-primary" name="payment">
                    <fieldset>
            </form>
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
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if($row['status'] == 'free'){
       

        $sql_u = "SELECT * FROM enduser where email='".$_SESSION['email']."'";
    $result_u = $conn->query($sql_u);
    $row_u=$result_u->fetch_assoc();
    $sql="INSERT INTO enduser_course (u_id,c_id) VALUE('".$row_u['id']."','".$cid."')";
    $result=$conn->query($sql);

    $sql_pbyuser="INSERT INTO payment_by_user (u_id,c_id) VALUE('".$row_u['id']."','".$cid."')";
    $result_pbyuser=$conn->query($sql_pbyuser);

    $sql_ptoinstructor="INSERT INTO payment_to_instructor (i_id,c_id) VALUE('".$row['i_id']."','".$cid."')";
    $result_ptoinstructor=$conn->query($sql_ptoinstructor);

    echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/index.php';</script>"; exit;

    }   
        
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST)){
    $error="";
$num=$_POST['number'];
$month=$_POST['month'];
$year=$_POST['year'];
$cvv=$_POST['cvv'];

    if(strlen($num)<12){
        echo "<script>alert('Invalid card number');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/coursebuy/payment/index.php';</script>"; exit;

    }
    if($month<0 || $month>12){
        echo "<script>alert('Invalid month selected');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/coursebuy/payment/index.php';</script>"; exit;

     }

    if($year<2020 || $year>2028){
        echo "<script>alert('Invalid year selected');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/coursebuy/payment/index.php';</script>"; exit;

     }
    if($cvv<100){
        echo "<script>alert('Invalid cvv');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/coursebuy/payment/index.php';</script>"; exit;

    }
    $sql_u = "SELECT * FROM enduser where email='".$_SESSION['email']."'";
    $result_u = $conn->query($sql_u);
    $row_u=$result_i->fetch_assoc();
    $sql="INSERT INTO enduser_course (u_id,c_id) VALUE('".$row['id']."','".$cid."')";
    $result=$conn->query($sql);

    $sql_pbyuser="INSERT INTO payment_by_user (u_id,c_id) VALUE('".$row['id']."','".$cid."')";
    $result_pbyuser=$conn->query($sql_pbyuser);


    $sixpamount=$row['amount']/100*60;
    
    $sql_ptoinstructor="INSERT INTO payment_to_instructor (i_id,c_id,amount) VALUE('".$row['i_id']."','".$cid."','".$sixpamount."')";
    $result_ptoinstructor=$conn->query($sql_ptoinstructor);


    if(!$result || !$result_pbyuser){
        echo "<script>alert('Payment failed');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/coursebuy/index.php';</script>"; exit;

    }
    else{
        echo "<script type='text/javascript'>window.top.location='../../';</script>"; exit;

    }
}
}

ob_end_flush();

?>