<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Sagar's Drop</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff">
    <link rel="canonical" href="https://example.com">  <!-- Fix canonical URL -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css?v=0.5">
    <link rel="stylesheet" type="text/css" href="../assets/css/content.css?v=1.0">
    <link rel="icon" href="/favicon.ico" sizes="250x250" type="image/x-icon">  <!-- Fix favicon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster|Playball|Kaushan+Script|Josefin+Sans|Mansalva|Satisfy|Yesteryear|Courgette|Damion|Great+Vibes|Pacifico&display=swap">
    <script src="https://kit.fontawesome.com/021dafb166.js"></script>
</head>
<body>
    <div class="snav">
        <div class="navleft">
            <ul>
                <div class="navright">
                    <h2>Sagar's drop</h2>
                </div>
                <li><a class="active" href="/notepad"><i class="fas fa-pen"></i> Notepad</a></li>
                <li><a href="/"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="Head">
            <h1>Sagar's Drop</h1>
            <!-- <div class="search-box">
                <form name="search" class="searchbox" method="GET" action="/">  
                    <input type="text" name="q" placeholder="Search File / Text File / Zip File etc.....">
                    <button type="submit" class="search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div> -->
        </div>	    
        <form class="noteform" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input type="text" name="title" id="title" placeholder="Enter Title">
            <textarea name="textwritten" id="textwritten" cols="30" rows="10" placeholder="Enter Text Here"></textarea>
            <button type="submit" class="addbtn"><i class="fas fa-plus"></i> Save Note</button>
			
        </form>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Using prepared statements to avoid SQL injection
			$title = $_POST["title"];
            $text = $_POST["textwritten"];
            $servername = "localhost";
$username = "root";
$password = "";
$db = "test";

            // Establish a new connection
            $conn = new mysqli($servername, $username, $password, $db);

            // Check connection
            if ($conn->connect_error) {
                die("<p style='color:Red;'>Connection Failed</p>");
            }

            $stmt = $conn->prepare("INSERT INTO notepad (title,text) VALUES (?,?)");
            $stmt->bind_param("ss",$title, $text);

            if ($stmt->execute()) {
                echo "<p style='color:Red;'>New Notes created successfully</p>";
				header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
				exit();
            } else {
                echo "Error Occurred ";
            }

            // Clean up
            $stmt->close();
            $conn->close();
        }
        ?>

        <div class="heading" style="margin-top:3em;">
            <h2>| Saved Notes 	📝</h2>	
        </div>

        <div class="wrappers notewrapper">
            <!-- Example display of saved notes -->
			<?php 


	// Using prepared statements to avoid SQL injection
	$servername = "localhost";
$username = "root";
$password = "";
$db = "test";

	// Establish a new connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
		die("<p style='color:Red;'>Connection Failed</p>");
	}

	$sql = "SELECT * FROM notepad ORDER BY date DESC";
	$result = $conn->query($sql);


			        // Check if there are any results
        if ($result->num_rows > 0) {
            // Iterate over each row and output the HTML structure with dynamic content
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="wrap">
                    <div class="tag">
                        <h2 class="tagsub"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <div class="thumb"><i class="far fa-file-alt" aria-hidden="true"></i></div>
                    </div>
                    <hr>
                    <div class="disp">
                        <p>
                            <?php echo htmlspecialchars($row['text']); ?> <!-- Display the text from the table -->
                        </p>
                        <div class="allbtn" style="justify-content:end;">
                            <!-- Adding delete and link icons with dummy functionality -->
                            <a href="view.php?id=<?php echo $row['sno']; ?>"><i class="fa fa-expand expbtn" style="color:#01c400" aria-hidden="true"></i></a> <!-- Link action -->
                            <i class="far fa-trash-alt delbtn"  onclick="deleteRecord(<?php echo $row['sno']; ?>)" aria-hidden="true"></i> <!-- Delete action -->
                            <i class="fa fa-link delbtn" style="color:#a7a7a7" aria-hidden="true"></i> <!-- Link action -->
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            // If no records are found, display a message
            echo "<p>No notes found.</p>";
        }
	
        ?>
 

            
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
    function deleteRecord(id) {
        if (confirm("Are you sure you want to delete this record?")) { // Confirmation dialog
            $.post("delete.php", { id: id }, function(response) { // Send POST request
                alert(response); // Show response message
                location.reload(); // Reload the page to refresh the list
            }).fail(function() {
                alert("Error deleting record."); // Handle failure
            });
        }
    }
    </script>
</body>
</html>
