<?php
session_start();

if (isset($_POST['login']) && !empty($_POST['email']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['email'] == 'admin@judicialsystem.com' && 
                  $_POST['password'] == 'admin') {
				  $_SESSION['uid']="admin";
echo "<script type='text/javascript'> window.location.href='../phpfiles/adminhome.php'; </script>";
               }else {
                  echo "<script type='text/javascript'> alert('Invalid Username or Password');</script>";
               }
            }
			
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../template/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('../template/img/court3.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
      background-color: rgba(0, 0, 0, 0); /* Maximum transparency */
    }
    .login-container {
      margin-top: 100px;
    }
    .card {
      background-color: rgba(0, 0, 0, 0.7);
      border: none;
      border-radius: 10px;
    }
    .card-header {
      background-color: rgba(0, 0, 0, 0.5);
      border-bottom: 0;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: none;
    }
    .btn-primary {
      background-color:#3B393A;
      border-color:#110F0F;
    }
    .btn-primary:hover {
      background-color:#161415;
      border-color: #110F0F;
    }
	  .btn-primary:active {
      background-color:#161415;
      border-color: #110F0F;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 login-container">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-0">Admin Login</h4>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="username">Email</label>
                <input type="text" name="email" class="form-control" id="username" placeholder="Enter username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
              </div>
              <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
