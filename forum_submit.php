<?php
// db.php (for database connection)
$host = "localhost"; // Database host
$dbname = "test_db"; // Replace with your database name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET['email'] ?? '';
    $title = $_GET['title'] ?? '';
    $description = $_GET['description'] ?? '';

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO forum (email, title, description) VALUES (:email, :title, :description)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to display page after successful submission
        header("Location: forum.php");
        exit;
    } else {
        echo "Error: Could not submit the post.";
    }
} else {
    echo "Invalid request method.";
}
?>
