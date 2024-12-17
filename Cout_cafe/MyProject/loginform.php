<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f7f3ef;
    }

    .btn {
      text-decoration: none;
      padding: 10px 20px;
      font-size: 16px;
      color: white;
      background-color: #7b5e2d; /* Button color */
      border-radius: 5px;
      margin: 5px;
      transition: background-color 0.3s;
      display: inline-block; /* To keep them side by side */
    }

    .btn:hover {
      background-color: #6b4c20; /* Darker color on hover */
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
      margin-top:9px;
      margin-left:9px;
    }

    .back-button:hover {
      background-color: brown;
    }

    /* Position buttons at the upper left */
    .top-buttons {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 10;
    }

    .login-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #7b5e2d;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    h2 img {
      margin-left: 10px;
      width: 45px;
      height: auto;
    }

    .login-form {
      margin-top: 20px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      color: #7b5e2d;
    }

    .input-group input {
      width: 95%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .login-btn {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #7b5e2d;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .login-btn:hover {
      background-color: #6b4c20;
    }

    .header_login {
      font-family: monaco;
      letter-spacing: 3px;
    }
  </style>
</head>
<body>
  <div class="top-buttons">
    <a href="lp.php" class="btn">HOME</a>
    <a href="menuone.php" class="btn">MENU</a>
  </div>

  <br><br><br>
  <div class="login-container">
    <h2 class="header_login">Login <img src="images/giphy.gif" alt="Cat"></h2>
    <form class="login-form" action="process_login.php" method="post">
      <div class="input-group">
        <label>Username</label>
        <input name="f_username" type="text" id="username" class="form-control" placeholder="Username" name="username" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input name="f_password" type="password" id="password" class="form-control" placeholder="Password" name="password" required>
      </div>
      <button type="submit" class="login-btn">Login</button>

      <center><p>Don't have an account?<a href="form.php"> Create one</a></p></center>
    </form>
  </div>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
