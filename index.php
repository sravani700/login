<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register and login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container" id="signUp" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php" >
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName"  placeholder="First Name" >
                
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName"  placeholder="Last Name" required>
                
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Email" required>
            
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password"  name="password" placeholder="password" required>
                
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">

        </form>
             <div class="links">
                <p>already have account</p>
                <button id="signInButton">Sign In </button>
             </div>

    </div>
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php" >
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Email" required>
            
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password"  name="password" placeholder="password" required>
                
            </div>
            <p class="recover">
                <a href="#">Recover password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">

        </form>
             <div class="links">
                <p>Dont  have account yet</p>
                <button id="signUpButton">Sign Up </button>
             </div>

    </div>
    <script src="script.js"></script>
    
</body>
</html>