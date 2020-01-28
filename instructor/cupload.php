<?php
ob_start();
    
session_start();

include '../connection.php';
if(!isset($_SESSION['auth_i'])){
    echo "<script>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit;
  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!file_exists('D:/xampp/htdocs/RAZIN/web2/courses/'.$_POST['title'])) {
        mkdir('D:/xampp/htdocs/RAZIN/web2/courses/'.$_POST['title'], 0777, true);

        $info = pathinfo($_FILES['thumbnail']['name']);
	
        $ext = $info['extension']; // get the extension of the file
        $newname = "Thumbnail.".$ext; 
       
        $target = 'D:/xampp/htdocs/RAZIN/web2/courses/'.$_POST['title']."/".$newname;
        $targetp='courses/'.$_POST['title'].'/';
        $result=copy( $_FILES['thumbnail']['tmp_name'], $target);
        if(!$result){
            // echo "error".$result->error();
        }else{
            //thumbanil upload success
        }

        $filename = $_FILES["file"]["name"];
        $source = $_FILES["file"]["tmp_name"];
        $type = $_FILES["file"]["type"]; 	
        $name = explode(".", $filename);
           $continue = strtolower($name[1]) == 'zip' ? true : false;
           if(!$continue) {
               $message = "The file you are trying to upload is not a .zip file. Please try again.";
           }

            $coursename=$_POST['title'];
            $target_path = "D:/xampp/htdocs/RAZIN/web2/courses/".$coursename."/abc.zip"; 	
         $target_path_db = "D:/xampp/htdocs/RAZIN/web2/courses/".$coursename."/"; 			
       
        
           $upload_zip=copy($_FILES["file"]["tmp_name"], $target_path);

           if($upload_zip) {
                //echo "<script> alert('into if '); </script>";	
               $zip = new ZipArchive();
               $x = $zip->open($target_path);
               if ($x === true) {
                   $zip->extractTo("D:/xampp/htdocs/RAZIN/web2/courses/".$_POST['title']."/");
                    // change this to the correct site path
                   $zip->close();
           
                   unlink($target_path);
                   // console.log(in);
               }
               else{
                   echo "<script>alert('failed to open zip file');</script>";
               }
               
               // $sql="UPDATE `course_table` SET `course-path`='".$target_path_db."' WHERE '".$_SESSION['current-insert-id']."'";

               $sql_i="SELECT * from instructor where email='".$_SESSION['email_i']."'";
               $result_i=$conn->query($sql_i);
               $row_i=$result_i->fetch_assoc();
             
             $sql="INSERT INTO `course`(`i_id`, `title`, `description`, `path`, `lern`, `prereq`, `status`, `amount`)  VALUES ('".$row_i['id']."','".$_POST['title']."','".$_POST['description']."','".$targetp."','".$_POST['learn']."','".$_POST['prereq']."','".$_POST['status']."','".$_POST['amount']."')";
               if(!$conn->query($sql)){
                   echo "<script>alert('Error  inserting course to database');</script>";
                   echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit;
               }
           else{
                //    echo "<br/>thumbnail record inderted<br/>";
        //    echo "<br/>course record inderted";
        echo "<script>alert('Sucess fully inserted');</script>";
        echo "<script>window.top.location='/RAZIN/web2/instructor/';</script>";


       
           }
               $message = "Your .zip file was uploaded and unpacked.";
               echo "<script> alert('Your .zip file was uploaded and unpacked.'); </script>";	
       }
        else 
        {	
            echo "<script>alert('There was a problem with the upload. Please try again.');</script>";
            echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit;


        }

    }
    else{
        echo "<script>alert('Course title already exist.');</script>";
        echo "<script type='text/javascript'>window.top.location='/RAZIN/web2/instructor/index.php';</script>"; exit;

    }
    
}
ob_end_flush();

?>