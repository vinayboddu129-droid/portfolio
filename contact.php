<?php

// Connect to the database
include "db.php";

// Get form data
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$message = trim($_POST["message"]);

// Insert data into contacts table
$sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

// Execute the query
if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Thank you! Your message has been submitted successfully.</h2>";
    echo "<p><a href='index.html'>Go back to Portfolio</a></p>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>