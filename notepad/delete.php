<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$db = "test"; // Replace with your database name

// Establish a database connection
$conn = new mysqli($servername, $username, $password, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID to delete
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

// Validate the ID
if ($id <= 0) {
    die("Invalid ID.");
}

// Use a prepared statement to delete the record by ID
$sql = "DELETE FROM notepad WHERE sno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Clean up
$stmt->close();
$conn->close();
?>
