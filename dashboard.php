<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PCOS Acystant</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard-styles.css">
</head>
<body>
    <script>
        // Check if the user is logged in
        if (localStorage.getItem('loggedIn') !== 'true') {
            alert("You must log in to access the dashboard.");
            window.location.href = 'login.php'; // Redirect to login if not logged in
        }
         
    </script>
    
    <header class="hero-section">
        <nav>
            <div class="logo"> <a href="dashboard.php">PCOS Acystant</a> </div>
           <div><span id="welcome_text" >Welcome Back!</span></div>
        </nav>
        <div class="dashboard-container">
            <h2>Your Dashboard</h2>
            <p>Manage your health and gain insights on PCOS.</p>
            <div class="cta-buttons">
                <a href="tracker.html" class="cta-btn">Menstrual Cycle Tracker</a>
                <a href="quiz.html" class="cta-btn">PCOS Knowledge Quiz</a>
            </div>
        </div>
    </header>
</body>
</html>
