<?php
$servername = "localhost";   // ya apna host
$username   = "harsh";       // DB username
$password   = "your_password"; // DB password
$dbname     = "your_database_name"; // DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully to database: " . $dbname;
}

$conn->close();
?>
