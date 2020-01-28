<?php  session_start(); 
if(!isset($_SESSION['auth_i'])){
    echo "<script>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit; 
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="/RAZIN/web2/instructor/ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script>
    $(document).ready(function() {

        $("input[type='radio']").click(function() {

            var radioValue = $("input[id='free']:checked").val();

            if (radioValue) {

                $("#amount").attr("disabled", true);

            }else{
                $("#amount").attr("disabled", false);
            }

        });

    });
    </script>
    <title>Hello, world!</title>
</head>

<body>
    <?php include 'header.php';?>
    <?php include '../connection.php';?>
    <?php
     $getinstructor="SELECT * from instructor where email='".$_SESSION['email_i']."'";
     $instructor= $conn->query($getinstructor);
     $instructorvalue=$instructor->fetch_assoc();
     ?>
    <form method="post" enctype="multipart/form-data" class="mt-5" action="/RAZIN/web2/instructor/cupload.php">
        <div class="row">
            <div class="col col-auto">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp">
                </div>
            </div>
            <div class="col col-3">
                <div class="form-group">
                    <label for="">Status:</label>

                    <input type="radio" id="free" value="free" name="status">
                    <label for="free">Free</label>

                    <input type="radio" id="paid" value="paid" name="status">
                    <label for="paid">Paid</label>

                </div>
            </div>
            <div class="col col-auto">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" aria-describedby="titleHelp">
                </div>
            </div>

        </div>



        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="10" cols="80" class="form-control"
                placeholder="Description goes here" required></textarea>
            <script>
            CKEDITOR.replace('description');
            </script>
            <script>
            CKEDITOR.replace('description', {
                toolbarGroups = [{
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    },
                ];

                removeButtons =
                'Underline,Subscript,Superscript,Cut,Copy,Paste,PasteText,PasteFromWord,Scayt,Source,About';

            });
            </script>
        </div>

        <div class="form-group">
            <label for="learn">What you learn</label>
            <textarea name="learn" id="learn" rows="10" cols="80" class="form-control" required></textarea>
            <script>
            CKEDITOR.replace('learn');
            </script>
            <script>
            CKEDITOR.replace('learn', {
                toolbarGroups = [{
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    },
                ];

                removeButtons =
                'Underline,Subscript,Superscript,Cut,Copy,Paste,PasteText,PasteFromWord,Scayt,Source,About';

            });
            </script>
        </div>

        <div class="form-group">
            <label for="prereq">Prerequirements</label>
            <textarea name="prereq" id="prereq" rows="10" cols="80" class="form-control" required></textarea>
            <script>
            CKEDITOR.replace('prereq');
            </script>
            <script>
            CKEDITOR.replace('prereq', {
                toolbarGroups = [{
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    },
                ];

                removeButtons =
                'Underline,Subscript,Superscript,Cut,Copy,Paste,PasteText,PasteFromWord,Scayt,Source,About';

            });
            </script>
        </div>
        <div class="form-group">
            <label for="thumbnail">Upload thumbnail here</label>
            <input type="file" class="form-control" id="thumbnail"  accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="thumbnail" aria-describedby="titleHelp">
        </div>
        <div class="form-group">
            <label for="file">Upload zip file here</label>
            <input type="file" class="form-control" id="file" accept=".zip" name="file" aria-describedby="titleHelp">
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
