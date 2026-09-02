<?php

// Include the database connection
require "db.php";

// Function to safely get form data
function cleanInput($data)
{
    return htmlspecialchars(trim($data));
}

// Check whether the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form values
    $name = cleanInput($_POST["name"] ?? "");
    $email = cleanInput($_POST["email"] ?? "");
    $message = cleanInput($_POST["message"] ?? "");

    // Validate required fields
    if ($name === "" || $email === "" || $message === "") {
        die("Please fill in all required fields.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    // Insert data into the database
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    // Check whether the data was inserted successfully
    if (mysqli_stmt_execute($stmt)) {
        echo "<h2>Thank you, $name!</h2>";
        echo "<p>Your message has been submitted successfully.</p>";
        echo '<p><a href="index.html">Return to Portfolio</a></p>';
    } else {
        echo "Error submitting your message.";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

} else {
    echo "Invalid request.";
}

// Close database connection
mysqli_close($conn);

?>