
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
//     // insert data query end
//     $('#editable_table').Tabledit({
//         url: 'instructor-action.php?from=instructor',
//         columns: {
//             identifier: [0, "id"],
//             editable: [
//                 [1, 'name'],
//                 [2, 'email'],
//                 [3, 'password'],
//                 [4, 'created_at'],

//             ]
//         },
//         restoreButton: false,
//         onSuccess: function(data, textStatus, jqXHR) {
//             if (data.action == 'delete') {
//                 $('#' + data.id).remove();
//                 editable_table.ajax.reload();
//             }
//             window.location.reload();

//         }
//     });

// });