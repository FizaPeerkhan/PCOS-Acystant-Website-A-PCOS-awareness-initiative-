<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOS Acystant Forum - Post Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="forum-styles.css">
    <style>
        .post-details {
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 20px auto;
        }

        .post-details p {
            margin: 10px 0;
            font-size: 18px;
        }

        .post-details strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="blur-background"></div>

    <div class="main-content">
        <h1>Post Details</h1>

        <div class="post-details">
            <p><strong>Email ID:</strong> <span id="email-display"></span></p>
            <p><strong>Title:</strong> <span id="title-display"></span></p>
            <p><strong>Description:</strong> <span id="description-display"></span></p>
            <p><strong>Posted on:</strong> <span id="time-display"></span></p>
        </div>

        <h2>Previous Posts</h2>
        <div id="previous-posts">
            <?php
            // Database connection
            $host = "localhost"; // Database host
            $dbname = "test_db"; // Replace with your database name
            $username = "root"; // Replace with your database username
            $password = ""; // Replace with your database password

            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Fetch previous posts
                $stmt = $conn->prepare("SELECT email, title, description, timestamp FROM forum ORDER BY timestamp");
                $stmt->execute();
                
                // Display previous posts
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='post-details'>";
                    echo "<p><strong>Email ID:</strong> " . htmlspecialchars($row['email']) . "</p>";
                    echo "<p><strong>Title:</strong> " . htmlspecialchars($row['title']) . "</p>";
                    echo "<p><strong>Description:</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
                    echo "<p><strong>Posted on:</strong> " . htmlspecialchars($row['timestamp']) . "</p>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const email = urlParams.get('email');
        const title = urlParams.get('title');
        const description = urlParams.get('description');

        // Get current time
        const now = new Date();
        const timePosted = now.toLocaleString();

        // Display the information
        document.getElementById('email-display').innerText = email;
        document.getElementById('title-display').innerText = title;
        document.getElementById('description-display').innerText = description;
        document.getElementById('time-display').innerText = timePosted;
    </script>
</body>
</html>
