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
    $query = "SELECT * FROM instructor ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    ?>
    <div class="container">
        <div class="table-responsive">
            <h3 align="center">Instructor Details</h3><br />
            <button style="float:right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add new
                instructor </button>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new instructor</h4>
                            <!-- <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div> -->
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="sname">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        aria-describedby="name">
                                </div>
                                <div class="form-group">
                                    <label for="semail">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                        with
                                        anyone
                                        else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        aria-describedby="emailHelp">
                                    <small id="passwordHelp" class="form-text text-muted">Password should be min 4
                                        charcter
                                        longer</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="butsave" class="btn btn-primary"
                                        onclick="saveData()">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <table id="editable_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                            <tr>
                            <td>'.$row["id"].'</td>
                            <td>'.$row["name"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["password"].'</td>
                            <td>'.$row["created_at"].'</td>
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
    
function saveData() {
    // alert('in 1');
    $("#butsave").attr("disabled", "disabled");
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();

    if (name != "" || email != "" || password != "") {
        //  alert('inside 2 if');
        $.ajax({
            url: "insert.php?from=instructor",
            type: "POST",
            data: {
                name: name,
                email: email,
                password: password
            },
            cache: false,
            success: function(dataResult) {
                // alert('suc in 3');
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
}
//     // insert data query end
// alert('test');

// $(document).ready(function() {
//     // insert data query start
//     $('#butsave').click(function() {
//         //   alert('inside1');
//         $("#butsave").attr("disabled", "disabled");
//         var name = $('#name').val();
//         var email = $('#email').val();
//         var password = $('#password').val();

//         if (name != "" || email != "" || password != "") {
//             // alert('inside 2 if');
//             $.ajax({
//                 url: "insert.php?from=instructor",
//                 type: "POST",
//                 data: {
//                     name: name,
//                     email: email,
//                     password: password
//                 },
//                 cache: false,
//                 success: function(dataResult) {
//                     var dataResult = JSON.parse(dataResult);
//                     if (dataResult.statusCode == 200) {
//                         $("#butsave").removeAttr("disabled");
//                         $('#fupForm').find('input:text').val('');
//                         $("#success").show();
//                         $('#success').html('Data added successfully !');
//                     } else if (dataResult.statusCode == 201) {
//                         alert("Error occured !");
//                     }

//                 }
//             });
//         } else {
//             alert('Please fill all the field !');
//         }
//     });
    // insert data query end
    $('#editable_table').Tabledit({
        url: 'instructor-action.php?from=instructor',
        columns: {
            identifier: [0, "id"],
            editable: [
                [1, 'name'],
                [2, 'email'],
                [3, 'password'],
                [4, 'created_at'],

            ]
        },
        restoreButton: false,
        onSuccess: function(data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id).remove();
                editable_table.ajax.reload();
            }
            window.location.reload();

        }
    });

});
</script>

<?php
ob_end_flush();
?>