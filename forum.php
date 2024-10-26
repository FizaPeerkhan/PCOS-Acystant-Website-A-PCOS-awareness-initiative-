<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOS Acystant Forum</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="forum-styles.css">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #ffeef8;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background-color: #f4c6d6;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .hero-content h1 {
            font-family: 'Raleway', serif;
            font-size: 2.5rem;
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: transparent;
        }

        .logo {
            font-size: 1.5rem;
            color: white;
        }

        nav button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(233, 30, 99, 0.4);
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
        }

        nav button:hover {
            background-color: #d81b60;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(216, 27, 96, 0.5);
        }

        nav button:active {
            background-color: #c2185b;
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(194, 24, 91, 0.4);
        }

        .main-content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #top_text {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .post-details {
            border: 1px solid #f1a7b8;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fef0f3;
        }

        .post-details strong {
            color: #ff6f91;
        }

        #previous-posts {
            overflow-y: auto;
            max-height: 400px;
            margin-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #ffe4e1; /* Light pastel pink for the modal content */
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-content h2 {
            text-align: center;
            color: #c2185b; /* Darker pink for the heading */
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input,
        .message-box textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #f1a7b8;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #ffffff;
        }

        .input-group input,
.message-box textarea {
    width: 80%; /* Adjusted width for smaller input boxes */
    padding: 10px; /* Reduced padding for a slimmer appearance */
    border: 2px solid #f1a7b8;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
    background-color: #ffffff;
    margin: 0 auto; /* Center the inputs within the modal */
    display: block; /* Make inputs block-level for centering */
}


        .cta-btn {
            background-color: #ff6f91;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .cta-btn:hover {
            background-color: #ff4c74;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <nav>
            <div class="logo">PCOS Acystant</div>
            <button onClick="OnOpenModal()" id="open_modal">Post New</button>
        </nav>
        <div class="hero-content">
            <h1>Join the Conversation</h1>
            <p>Connect with others, share experiences, and find support in our community.</p>
        </div>
    </div>

    <div class="main-content">
        <h1>Welcome to the PCOS Acystant Forum</h1>
        <p id="top_text">This forum is a space for women to share their stories, ask questions, and find support regarding PCOS.</p>

        <div id="previous-posts">
            <?php
            // Database connection
            $host = "localhost";
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

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span id="close" style="cursor:pointer; float:right;">&times;</span>
                <h2>Share and Empower!</h2>
                <form class="form-container" action="forum_submit.php" method="GET">
                    <div class="input-group">
                        <label for="email">Email ID</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="input-group">
                        <label for="description">Description</label>
                        <div class="message-box">
                            <textarea id="description" name="description" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="cta-btn">Post</button>
                    <button type="button" class="cta-btn" id="close_modal">Close</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function OnOpenModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        document.getElementById("close").onclick = closeModal;
        document.getElementById("close_modal").onclick = closeModal;

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
