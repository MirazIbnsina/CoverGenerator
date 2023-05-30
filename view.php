<!DOCTYPE html>
<html>
<head>
  <title>Cover Page [PCIU]</title>
  <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="text-center">
    <nav class="navbar fixed-top navbar-dark bg-dark mb-3">
        <span class="navbar-brand">
            <img src="images/logo-224.png" width="32" height="32" class="d-inline-block align-top" alt=""> Cover Page Generator <sup> <span class="badge badge-secondary">Beta</span> <span class="badge badge-secondary">V 1.5</span></sup>
        </span>
    </nav><br><br>
<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Student info
        $name = $_POST['name'];
        $temp_id = $_POST['id'];
        
        $dept = $_POST['program'];
        $dept .= substr($temp_id, 0, 3);
        $id = "ID: ";
        $id .= $temp_id;
        
        
        
        
        // Course info
        $code = "Course Code: ";
        $code .= $_POST['code'];
        $course = $_POST['course'];
        $type = $_POST['type'];
        $topics1 = $_POST['topics1'];
        $topics2 = $_POST['topics2'];

        $date = "Date of submission: ";
        $date .= $_POST['date'];
        
        // Faculty info
        $teacher = $_POST['teacher'];
        $desig = $_POST['desig'];
        $tdept = "Department of ";
        $tdept .= $_POST['tdept'];
    } else {
        echo '<script type="text/javascript">alert("You didn\'t fill the form completely.\nPlease complete the form first.");</script>';
       $script = "<script>
        window.location = 'https://cover-cse.000webhostapp.com';</script>";
            echo $script;
    }

    // Global... (no chnage)
	$save = 'images/'.str_replace(" ","_",$id).'.jpg';
	$_SESSION['card']=$save;
	$bgpic = imagecreatefromjpeg("cover.jpg");
	$textcolor = imagecolorallocate($bgpic,0,0,0);
    $f1 = 'fonts/arial.ttf';
    $imageWidth = imagesx($bgpic);
    $imageHeight = imagesy($bgpic);
    
    
	if ($type == 1) {
		imagettftext($bgpic, 50, 0, 935.5, 1530, $textcolor, $f1, "Assignment Topics:");
	} else {
	    imagettftext($bgpic, 50, 0, 1017, 1530, $textcolor, $f1, "Report Topics:");
	}
	
	imagettftext($bgpic, 50, 0, 868, 1170, $textcolor, $f1, $code);
	imagettftext($bgpic, 50, 0, 1045, 1270, $textcolor, $f1, "Course Title:");


	// course 
	$textBoxCode = imagettfbbox(55, 0, $f1, $course);
	$x = ($imageWidth - $textBoxCode[4]) / 2;
	$y = ($imageHeight - $textBoxCode[5]) / 2;
	imagettftext($bgpic, 55, 0, $x, 1370, $textcolor, $f1, $course);


	// topics 
	$textBoxCode = imagettfbbox(55, 0, $f1, $topics1);
	$x = ($imageWidth - $textBoxCode[4]) / 2;
	imagettftext($bgpic, 55, 0, $x, 1630, $textcolor, $f1, $topics1);

	if (empty($topics2)) { 
	} else {
	    $textBoxCode = imagettfbbox(50, 0, $f1, $topics2);
	    $x = ($imageWidth - $textBoxCode[4]) / 2;
	    imagettftext($bgpic, 50, 0, $x, 1725, $textcolor, $f1, $topics2);
	}
	    
	
	    
	
	// date
	$textBoxCode = imagettfbbox(55, 0, $f1, $date);
	$x = ($imageWidth - $textBoxCode[4]) / 2;
	imagettftext($bgpic, 55, 0, $x, 2930, $textcolor, $f1, $date);

	// Submitted by
	imagettftext($bgpic, 47, 0, 1300, 2070, $textcolor, $f1, $name);
	imagettftext($bgpic, 47, 0, 1300, 2160, $textcolor, $f1, $dept);
	imagettftext($bgpic, 47, 0, 1300, 2250, $textcolor, $f1, $id);


	// Submitted to...
	$textbox = imagettfbbox(47, 0, $f1, $teacher);
	$text_width = $textbox[2] - $textbox[0];
	$x = imagesx($bgpic) - $text_width - 1359;
	imagettftext($bgpic, 47, 0, $x, 2070, $textcolor, $f1, $teacher);
	
	$textbox = imagettfbbox(47, 0, $f1, $desig);
	$text_width = $textbox[2] - $textbox[0];
	$x = imagesx($bgpic) - $text_width - 1359;
	imagettftext($bgpic, 47, 0, $x, 2160, $textcolor, $f1, $desig);
	
	$textbox = imagettfbbox(47, 0, $f1, $tdept);
	$text_width = $textbox[2] - $textbox[0];
	$x = imagesx($bgpic) - $text_width - 1359;
	imagettftext($bgpic, 47, 0, $x, 2250, $textcolor, $f1, $tdept);




	imagejpeg($bgpic,$save);
	imagedestroy($bgpic);
    
?>


    
    <div class="jumbotron py-30">
	  	<h1>Ready !!!</h1>
	        <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> </div>
            </div>
	</div>
    
    <div class="container">
        <h3>Check the preview before downloading</h3>
        <div class="row">
            <div class="col">
                <div class="card card-body mx-auto border">
                    <img src="<?php  echo($save);  ?>" class="rounded">
                 </div>
            </div>
        </div>
        <br><br>
        <?php
            $file_name = "$save";
            $url = "https://cover-cse.000webhostapp.com/pdf.php?file_name=" . urlencode($file_name) . "&id=" . urlencode($id);
        ?>
        
        <a href="<?php  echo($url);  ?>" class="btn btn-primary btn-lg">Click to download your PDF</a><br><br>
    </div>



<br><br><hr><br><p>Thank you for using the generator <3</p>
<a class="btn btn-outline-secondary" href="https://bmc.link/mirazibnsina">Buy me a coffee 😑</a><br><br><br><hr><br><br>
</body>
</html>