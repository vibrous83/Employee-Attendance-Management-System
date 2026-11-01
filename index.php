<?php
session_start();
include ("koneksi.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/login.css">
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="./Asset/ICONNET.png">
		</div>
		<div class="login-content">
            <form action="cblogin.php" method="post">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<input type="text" name= "username" placeholder="Username" id="username" class="input" required>
						<br>
						<span id="userspan"></span>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input type="password" name="password" placeholder="Password" class="input" required>
						   <br>
						<span id="passwordspan"></span>
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login" id="loginsubmit" >
            </form>
        </div>
    </div>
</body>
</html>