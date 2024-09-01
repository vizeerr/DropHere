<!DOCTYPE HTML>

<html lang="en">

<head>
	<title>Sagar's Drop</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords"
		content=" ">
	<meta name="description"
		content="">
	<meta name="theme-color" content="#ffffff">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link rel="canonical" href="https">

	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/content.css?v=0.4">
	
	<link rel="apple-touch-icon" href="/julion.png">
	<meta name="msapplication-square150x150logo" content="">
	<link rel="icon" href="" sizes="250x250" type="image/x-icon">
	
	<link href="https://fonts.googleapis.com/css?family=Lobster|Playball|Kaushan+Script|Josefin+Sans|Mansalva|Satisfy|Yesteryear|Courgette|Damion|Great+Vibes|Pacifico&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/021dafb166.js"></script>


</head>

<body>

    <?php 
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	            $dire = "uploads";
	            $file = $_POST["file"];
	            unlink($dire."/".$file);
	    }   
	    
	    ?>
	    
	<div class = "bodycover"></div>
	<div class="mainprompt">
	    <div class="delprompt">
	        <div class="promptbody">
	            <div class = "head"><p class="headp"></p></div>
	            <div class = "promptbtn">
	                <a class="yesbtn">Confirm ✅</a>
	                <a class="nobtn">Cancel ❌</a>
	            </div>

	        </div>
	    </div>
	</div>
	<div class = "uploadcover">
	    
	
	</div>
	
        <div class="snav">
		    
		    <div class="navleft">
		        <ul>
		            <div class="navright">
		                <h2>Sagar's drop</h2>
		            </div>
		            <!--<li><a href="https://padhlomitro.000webhostapp.com/sagardrop/uploader.php"><i class="fas fa-upload"></i> Upload</a></li>-->
              <!--      <li><a class="active" href="#home"><i class="fas fa-home"></i> Home</a></li>-->
                </ul>

		    </div>
	    </div>
	    <div class="main">
	        <div class="Head">
	            <h1>Sagar's Drop</h1>
	            <div class="search-box">
	                <form name="search" class = "searchbox" method="post">
	                    </h3><input type="text" name="inputval" value="" placeholder="Search File / Text File / Zip File etc.....">
	                    <input type = 'hidden' name="searchhid" value = "searh">
	                    <div class="search" onClick="document.forms['search'].submit()">
	                        <i class="fa fa-search" aria-hidden="true"></i>
	                    </div>
	           
                    </form>
	            </div>
	        </div>
	   
	   
	    <?php
	    
	    function truncate($string, $length, $dots = "...") {
            return (strlen($string) > $length) ? substr($string, 0, $length):$string;
	    }
  
	    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["searchhid"]== "searh" ){
	        echo "<div class='heading'>
	            <h2>| Search 🔍 Result..</h2>
	       </div> <div class ='wrappers'>
	       ";
	        $tosearch = ucwords($_POST["inputval"]);
	        $strsize = strlen($tosearch);
	        $directory = "uploads/";
            if ($opendirectory = opendir($directory)){
                while (($file = readdir($opendirectory)) !== false){
                    if ($file != '.' && $file != '..') {
                            if(truncate($file,$strsize)==$tosearch){
                                $i++;
                                $fileNameParts = explode('.', $file);
                                $ext = ucwords(end($fileNameParts));
                                $target_dir = "uploads/$file";
                                $fsize = filesize($target_dir);
                                $ftime= date("F d Y H:i:s.", fileatime($target_dir));
                                $thumb="NA";
                                    
                                echo "<div class='wrap'>
	                <div class='tag'>
	                    <h2 class='tagsub'>".fname($file)."</h2> 
	                    <div class = 'thumb'><i class='far fa-file-alt'></i></div>
	                </div>
	                <hr>
	                <div class='disp'>
	                    <p id='filename'>Name:<span>".ucwords($file) ."</span> </p>
	                    <p>Uploaded On:<span>".$ftime ."</span> </p>
	                    <p>File Size:<span>".formatBytes($fsize)."</span> </p>
	                    <div class = 'allbtn'>
	                        <a class='viewa' href='uploads/".$file."'><i class='fa fa-eye' aria-hidden='true'></i> View</a>
	                        <a class= 'downa' href='uploads/ ".$file."' download><i class='fa fa-download' aria-hidden='true'></i> Download</a>
	                        <form id = '".$i."' style = 'display:none;' method='post' action=''>
	                            <input type = 'hidden' name='file' value ='".$file."' >
                            </form>
                            <i onclick='name(\"$i\",\"$file\")' class='far fa-trash-alt delbtn'></i>
	                    </div>
	                        <p style='color: #ffdf00; float: right; margin: 0;' >".$ext."</p>
	                </div>
	            </div> <br>";
                            }
                        
                    }
                        }
                            closedir($opendirectory);
            }echo "</div>";
            if($i==0){
                echo "<div class='heading'>
	            <h2 style='color:red;margin-top:'>No Search Results Found.. </h2>
	       </div>";
            }
	        
	    }
            
            
	?>
	
	<?php 
	    if(isset($_POST['upload'])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;  

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "<div class = 'message'><p>Sorry, file already exists. ❗<</p></div>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<div class = 'message'><p>Sorry, your file was not uploaded.❗<</p></div>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<div style='color: #36c331;' class = 'message'><p>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded. ✅</p></div>";
            }else {
                echo "<div class = 'message'><p>Sorry, there was an error uploading your file. ❗</p>/div>";
            }
        }
	        
	    }
?>
	

	        
	        <div class="uploader">
	            <form action="" method="post" enctype="multipart/form-data">
                    <div class="inputflex">
                        <label for="files">
                            <div class="file">
                            <input type="file" id="files" name="fileToUpload" id="fileToUpload" style="display:none;"> Click Here To Choose File <strong><span>! Files Only</span></strong>
                            </div>
                        </label>
                    
                        <button class="button" type="submit" name="upload">Upload  <i class="fa fa-upload" aria-hidden="true"></i> </button>
                    </div>

                </form>
	        </div>
	        
	        

	   
	            
	        <div class="heading">
	            <h2>| Uploded Files 📁 </h2>
	       </div>
	        
	        <div class="wrappers">
	            <?php
	                $directory = "uploads/";

                    // Open a directory, and read its contents
                    if (is_dir($directory)){
                        if ($opendirectory = opendir($directory)){
                            $i = 0;
                            while (($file = readdir($opendirectory)) !== false){
                                if ($file != '.' && $file != '..') {
                                    $i++;
                                    $fileNameParts = explode('.', $file);
                                    $ext = ucwords(end($fileNameParts));
                                    $target_dir = "uploads/$file";
                                    $fsize = filesize($target_dir);
                                    $ftime= date("F d Y H:i:s.", fileatime($target_dir));
                                    $thumb="NA";
                                    
                                echo "<div class='wrap'>
	                <div class='tag'>
	                    <h2 class='tagsub'>".fname($file)."</h2> 
	                    <div class = 'thumb'><i class='far fa-file-alt'></i></div>
	                </div>
	                <hr>
	                <div class='disp'>
	                    <p id='filename'>Name:<span>".ucwords($file) ."</span> </p>
	                    <p>Uploaded On:<span>".$ftime ."</span> </p>
	                    <p>File Size:<span>".formatBytes($fsize)."</span> </p>
	                    <div class = 'allbtn'>
	                        <a class='viewa' href='uploads/".$file."'><i class='fa fa-eye' aria-hidden='true'></i> View</a>
	                        <a class= 'downa' href='uploads/ ".$file."' download><i class='fa fa-download' aria-hidden='true'></i> Download</a>
	                        <form id = '".$i."' style = 'display:none;' method='post' action=''>
	                            <input type = 'hidden' name='file' value ='".$file."' >
                            </form>
                            <i onclick='name(\"$i\",\"$file\")' class='far fa-trash-alt delbtn'></i>
	                    </div>
	                        <p style='color: #ffdf00; float: right; margin: 10px 0 0 0;' >".$ext."</p>
	                </div>
	            </div> <br> ";
                            }}
                            closedir($opendirectory);
                            if($i==0){
                                echo "<div class='heading'>
	            <h2 style='color:red;margin-top:'>Empty ! No Files 📁 To Show </h2>
	       </div>";
                            }
                        }
                    }
                function formatBytes($bytes) {
                    if ($bytes > 0) {
                        $i = floor(log($bytes) / log(1024));
                        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                        return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
                    } else {
                        return 0;
                    }
                }
                
                function fname($string){
                    $string = explode('.', $string)[0];
                    
                    $replaced = str_replace('_', ' ', $string);
                    $string = str_replace('-', ' ', $replaced);
                    $split= substr($string, 0,20);
                    return ucwords($split).'...';
                }
                
                function deletion($p){
                    
                    $dire = "uploads";
	                $file = $p;
	                unlink($dire."/".$file);
                }
	            
	            ?>
	            
	            
	             
	        </div>
	        
	    </div>
	    <script>
	    
	    var bodycover= document.querySelector(".bodycover");  
	    var mainprompt = document.querySelector(".mainprompt");  
	       bodycover.style.display="none";
	       mainprompt.style.display="none";
	   
	   function filesubmit(){
	       var fname = document.getElementById("files").value
	       bodycover.style.display="block";
	       mainprompt.style.display="block";
	       var promptbtn = document.querySelector(".promptbtn");
	       var head = document.querySelector(".headp");
	       promptbtn.style.display="none";
	       head.innerText = fname+" File 📁 Uploaded Successfuly ✅";
	       bodycover.addEventListener("click",cancelit);
	   }
	   
	    function name(a,p){
	         bodycover.style.display="block";
	         mainprompt.style.display="block";
	         
	        var yesbtn=document.querySelector(".yesbtn");
	        var nobtn=document.querySelector(".nobtn");
	        var head = document.querySelector(".headp");
	        var promptbtn = document.querySelector(".promptbtn");
	        promptbtn.style.display="block";
	        
	        yesbtn.addEventListener("click",confirmit);
	        nobtn.addEventListener("click",cancelit);
	        bodycover.addEventListener("click",cancelit);
	        head.innerText = "Do you Really Want To Delete This file !";
	        
	        function confirmit(){
	            head.innerText = p+" Deleted Successfuly ✅";
	            promptbtn.style.display="none";
	            bodycover.addEventListener("click",removeit);
	            var timeout = setTimeout(delfunc, 1500);
	            function delfunc(){
	                document.getElementById(a).submit();
	            }
	            function removeit(){
	                bodycover.style.display="none";
	                mainprompt.style.display="none";
	            }
	        }
	       function cancelit(){
	           head.innerText = " Canceled ❌ Deletion";
	           promptbtn.style.display="none";
	           var timeout = setTimeout(closefunc, 900);
	            function closefunc(){
	                bodycover.style.display="none";
	                mainprompt.style.display="none";
	            }

	       }
	    }
	   
	    </script>
	    
</body>
</html>