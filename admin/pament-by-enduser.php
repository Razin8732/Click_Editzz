<?php
session_start();
if(!isset($_SESSION['auth_a'])){
    echo "<script>window.top.location='login.php';</script>"; exit;
  
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- bootstrap css ee -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <!-- bootstrap css ee -->
    <script src="/RAZIN/web2/script/jquery.tabledit.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Admin</title>
</head>

<body>
    <?php include 'header.php';?>
    <?php include 'connection.php';?>

    <?php
    $query = "SELECT * FROM payment_by_user ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    ?>
    <div class="container">
        <div class="table-responsive">
            <h3 align="center">Payment details by enduser</h3><br />
            <!-- <button style="float:right;" class="btn btn-info btn-sm" data-toggle="modal"
                data-target="#myModal">Add</button> -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new payment</h4>
                            <!-- <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div> -->
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="sname">Payment Id</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        aria-describedby="name" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="semail">Instructor id</label>
                                    <input type="number" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="courseid">Course id</label>
                                    <input type="number" class="form-control" id="password" name="password"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="butsave" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <table id="editable_table" class="table table-bordered table-striped border" style="margin-top:5rem; ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Course Id</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                            <tr>
                            <td>'.$row["id"].'</td>
                            <td>'.$row["u_id"].'</td>
                            <td>'.$row["c_id"].'</td>
                            </tr>
                            ';
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    // insert data query start
    $('#butsave').click(function() {
        alert('inside1');
        $("#butsave").attr("disabled", "disabled");
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if (email != "" || password != "") {
            alert('inside 2 if');
            $.ajax({
                url: "insert.php?from=pbyuser",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $("#butsave").removeAttr("disabled");
                        $('#fupForm').find('input:text').val('');
                        $("#success").show();
                        $('#success').html('Data added successfully !');
                    } else if (dataResult.statusCode == 201) {
                        alert("Error occured !");
                    }

                }
            });
        } else {
            alert('Please fill all the field !');
        }
    });
    // insert data query end
    $('#editable_table').Tabledit({
        url: 'instructor-action.php?from=pbyuser',
        columns: {
            identifier: [0, "id"],
            editable: [
                [1, 'id'],
                [2, 'u_id'],
                [3, 'c_id'],


            ]
        },
        restoreButton: false,
        onSuccess: function(data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id).remove();
                editable_table.ajax.reload();
            }
        }
    });

});
 </script>
 

<?php
ob_end_flush();
?>