<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PCOS Acystant</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register-styles.css"> <!-- Updated CSS file link -->
    <script>


    
        function validatePassword() {
            // event.preventDefault(); // Prevent form submission for validation
            
            
            const password = document.getElementById('password').value;
            const passwordRequirements = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

            if (!passwordRequirements.test(password)) {
               
                // document.getElementById('caution').style.display="block"
                
               
            }
            else{

                document.getElementById('regis_form').submit()
                // document.getElementById('caution').style.display="none"

            }
            
            // If validation passes, redirect to the dashboard
            // window.location.href = "dashboard.html"; // Change to your actual dashboard URL
        }

        function checkPassword(){
            const password = document.getElementById('password').value;
            const passwordRequirements = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRequirements.test(password)) {
                
                document.getElementById('caution').style.display="block"
                
               
            }
            else{

                
                document.getElementById('caution').style.display="none"

            }


        }
    </script>
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
            <div class="form-section left">
                <h3>Personal Details</h3>


                <!-- Since we wrote php code inside HTML pages we changed the format to .php.
                 In this way we can make the page submit to itself so that the php code below is run when page is submitted. -->
                <?php

    



    //Checking whether the page is submitted using post method.
    if($_POST){


    //Personal Information
	$Name = $_POST['name_input'];
	$Age = $_POST['age_input'];
	$Weight = $_POST['wt_input'];
	$Height = $_POST['ht_input'];
	$Cycle = $_POST['cycle_input'];
	$Lifestyle = $_POST['lfst_input'];
	
	//Account Data
	$UserName = $_POST['username_input'];
	$Email = $_POST['eml_input'];
	$Password = $_POST['pass_input'];



	

	

	
	// Database connection;
	$conn = new mysqli('localhost:3306','root','','test_db');

	
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else 
    {

        
        // We check whether the email id already exists in the database which means the same 
        // email id cannot be used again. 

        
        $eml_check = "SELECT * FROM registration WHERE Email='$Email'";
        $result = $conn->query($eml_check);

        //We check whether the sql query returns any data. Which we can find by
        //checking the number of rows of data returned. If more than 0 data is returned
        //which means email id already exists.
        if ($result->num_rows>0){
            $conn->close();

            //Show an alert saying emailid already exists
            echo "<script>alert('Email ID already exists');</script>";
            header("Location: register.php");


        }
        else{

		
        //Create the insert statement for inserting the data
		$stmt = $conn->prepare("INSERT INTO registration (Name, Age, Weight, Height, Cycle, Lifestyle, UserName, Email, Password ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$stmt->bind_param('siiiissss', $Name, $Age, $Weight, $Height ,$Cycle, $Lifestyle, $UserName, $Email, $Password);

		if ($stmt->execute()) {

            echo "<script>alert('Registration Successful');</script>";

            //Navigating to the login page if registration successfull.
            header("Location: login.php ");
            exit();
		}
		else {
            echo "<script>alert('Registration Unsuccessful');</script>";
            header("Location: register.php");
    exit();

		};


		
		$stmt->close();
		
		$conn->close();
        
    };

};
};

?>
                <form action="register.php" method="post" id="regis_form" >
                    
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input name="name_input" type="text" id="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="input-group">
                        <label for="age">Age</label>
                        <input name="age_input" type="number" id="age" placeholder="Enter your age" required>
                    </div>

                    <div class="input-group">
                        <label for="weight">Weight (kg)</label>
                        <input name="wt_input" type="number" id="weight" placeholder="Enter your weight in kg" required>
                    </div>

                    <div class="input-group">
                        <label for="height">Height (cm)</label>
                        <input name="ht_input" type="number" id="height" placeholder="Enter your height in cm" required>
                    </div>

                    <div class="input-group">
                        <label for="cycle-length">Menstrual Cycle Length (days)</label>
                        <input name="cycle_input" type="number" id="cycle-length" placeholder="Enter the length of your menstrual cycle in days" required>
                    </div>

                    <div class="input-group">
                        <label for="lifestyle">Lifestyle</label>
                        <select name="lfst_input" id="lifestyle" required>
                            <option value="" disabled selected>Select your lifestyle</option>
                            <option value="highly-active">Highly Active</option>
                            <option value="moderately-active">Moderately Active</option>
                            <option value="lightly-active">Lightly Active</option>
                        </select>
                    </div>
                
                     </div>

                 <div class="form-section right">
                 <h3>Account Details</h3>
                 <!-- Added onsubmit event -->
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input name="username_input" type="text" id="username" placeholder="Enter your username" required>
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input name="eml_input" type="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div
                     class="input-group">
                        <label for="password">Password</label>
                        <input oninput="checkPassword()" name="pass_input"  type="password" id="password" placeholder="Enter your password" required>
                        <span id="caution"
                        style="font-size: 12px;color: red;"
                        >Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.</span>
                    </div>

                    <button type="button" onclick="validatePassword()" class="cta-btn">Register</button>
                </form>
            </div>
            
            <p class="switch-form">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </header>
</body>
</html>
