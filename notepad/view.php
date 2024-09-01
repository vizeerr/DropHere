<!DOCTYPE html>
<html lang="en">
<head>
    <title>View</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff">
    <link rel="canonical" href="https://example.com">  <!-- Fix canonical URL -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css?v=0.6">
    <link rel="stylesheet" type="text/css" href="../assets/css/content.css?v=0.9">
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
    <div class="textcont">
<?php
// Get the ID from the URL and ensure it's a positive integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate the ID
if ($id <= 0) {
    die("<p style='color:Red;'>Invalid ID.</p>"); // Handle invalid ID
}

// Database connection parameters
$servername = "sql203.infinityfree.com";
            $username = "epiz_33393912";
            $password = "fSiVIvMqY30";
            $db = "epiz_33393912_general";


// Establish a new connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("<p style='color:Red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// Prepared statement to avoid SQL injection
$sql = "SELECT * FROM notepad WHERE sno = ?";
$stmt = $conn->prepare($sql); // Prepare the query
$stmt->bind_param("i", $id);  // Bind the integer parameter
$stmt->execute();             // Execute the query
$result = $stmt->get_result(); // Get the result

// Check if the result contains data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { // Fetch each row
        // Display the data in a user-friendly format
        echo "<h1 class='viewerhead'>" . htmlspecialchars($row['title']) . "</h1>";
        echo "<p class='viewertext'>" . htmlspecialchars($row['text']) . "</p>";
    }
} else {
    echo "<p class='viewertext' style='color:Red;'>No record found with the provided ID.</p>"; // No records found
}

// Clean up
$stmt->close();
$conn->close();
?>
</div>
</body>
</html>