<!-- <html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
               <h3 class="display-3">Registration Form</h3>
               <?php
                if(isset($_GET['error'])){
                    echo "Error:" . $_GET['error'];
                }
                ?>
                <form action="process_registration.php" method="POST">
                    <div class="mb">
                       <label for="" class="form-label">Fullname</label>
                        <input name="r_fullname" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Username</label>
                        <input name="r_username" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Password</label>
                        <input name="r_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Confirm Password</label>
                        <input name="r_conf_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Address</label>
                        <input name="r_address" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Contact</label>
                        <input name="r_contact" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Birth Certified Gender</label>
                             <select class="form-select" name="r_gender" id="">
                                 <option value="M">Male</option>
                                 <option value="F">Female</option>
                                 <option value="X">Rather Not Say</option>
                             </select>
                         
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success">
                        
                        <a href="index.php" class="btn btn-link">Login</a>
                        
                    </div>
                </form>
                
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    
</body>
    <script src="js/bootstrap.js"></script>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Coffee Shop</title>
    <style>
        body {
            background-color: #f7f3ef; /* Light beige */
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 100px;
            margin-bottom: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .registration-form h3 {
            color: #7b5e2d; /* Light brown */
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #7b5e2d; /* Light brown */
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-success {
            background-color: #7b5e2d; /* Light brown */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            display: block;
        }

        .btn-success:hover {
            background-color: #6b4c20; /* Darker brown on hover */
        }

        .btn-link {
            color: #7b5e2d; /* Light brown */
            display: block;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
        }
        .back-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: red;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: brown;
        }
          .back-button:hover {
            background-color: brown;
        }

    </style>
</head>
<body>
<button class="back-button" onclick="goBack()">Go back</button>
    <div class="container">
        <div class="registration-form">
            <h3>Sign Up </h3>
            <?php
            if(isset($_POST['error'])){
                echo "Error:" . $_POST['error'];
            }
            ?>
            <form action="process_registration.php" method="POST">
                <div class="form-group">
                    <label for="r_fullname" class="form-label">Fullname</label>
                    <input name="r_fullname" id="r_fullname" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_username" class="form-label">Username</label>
                    <input name="r_username" id="r_username" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_passwrd" class="form-label">Password</label>
                    <input name="r_passwrd" id="r_passwrd" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_conf_passwrd" class="form-label">Confirm Password</label>
                    <input name="r_conf_passwrd" id="r_conf_passwrd" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_address" class="form-label">Address</label>
                    <input name="r_address" id="r_address" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_contact" class="form-label">Contact</label>
                    <input name="r_contact" id="r_contact" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="r_gender" class="form-label">Gender</label>
                    <select class="form-control" name="r_gender" id="r_gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="X">Rather Not Say</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Register</button>
                <a href="loginform.php" class="btn btn-link">Already have an account? Login</a>
            </form>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>