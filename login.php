<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PCOS Acystant</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header class="hero-section">
        <nav>
            <div class="logo">PCOS Acystant</div>
            <ul>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        <div class="form-container">
            <h2>Welcome Back!</h2>
            <p>Login to continue your journey with us.</p>

            <?php 

       

            if($_POST){

            
// Database connection;
$conn = new mysqli('localhost:3306','root','','test_db');


if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else 
{

    $Email = $_POST['Email'];
	$Pass = $_POST['password'];

    
    

    $eml_check = "SELECT * FROM registration WHERE Email='$Email' AND Password='$Pass' LIMIT 1";
    $result = $conn->query($eml_check);

    //We check whether the sql query returns any data. Which we can find by
    //checking the number of rows of data returned. If more than 0 data is returned
    //which means email id already exists.
    if ($result->num_rows == 0){
        $conn->close();

       
        echo "<script>alert('Invalid Email ID or Password');</script>";
        


    }else if($result->num_rows == 1 )
    {

        $row = $result->fetch_assoc();

        $emailid = $row['Email'];

        echo "<script>localStorage.setItem('loggedIn', 'true');localStorage.setItem('emailid', '$emailid');window.location.href = 'dashboard.php';</script>";

        
        $conn->close();
    };


    
    

//     if ($stmt->execute()) {

//         echo "<script>alert('Registration Successful');</script>";

//         //Navigating to the login page if registration successfull.
//         header("Location: login.php ");
//         exit();
//     }
//     else {
//         echo "<script>alert('Registration Unsuccessful');</script>";
//         header("Location: register.php");
// exit();

//     };
    
    
};

};

            

?>
            <form id="login_form" method="post" action="login.php" >
                <div class="input-group">
                    <label  for="username">Email ID</label>
                    <input name="Email" type="text" id="Email" placeholder="Enter your Email ID" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password" placeholder="Enter your password" required>
                </div>

                <button onclick="handleLogin()" type="button" id="login_submit" class="cta-btn">Login</button>
            </form>
            <p class="switch-form">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </header>
    
    
    <script>
        function handleLogin() {
            
    
            const password = document.getElementById('password').value;
            const passwordCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/; // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
            
            if (!passwordCriteria.test(password)) {
                alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.');
               
            }
            else{

            document.getElementById('login_form').submit();};
            // Simulate successful login


            // localStorage.setItem('loggedIn', 'true'); // Set login status
            // window.location.href = 'dashboard.php'; // Redirect to dashboard
        }
    
        
    </script>
    
    
</body>
</html>