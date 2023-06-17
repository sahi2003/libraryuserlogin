<?php
include("connection.php");
if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $CPass = md5($_POST['CPass']);
    $user_type = $_POST['user_type'];
    $select = " SELECT * FROM signup WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0)
    {
        $error[] = 'user already exist!';
    }
    else
    {
        if($pass != $CPass)
        {
            $error[] = 'password not matched!';
        }
        else
        {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    }

};
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>signup form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    <body>
        <div id="form">
            <h1 id="para">Signup Form</h1><br>
            <form name="form" method="POST" action="">
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
                <div class="input">
                    Name:<br> 
                    <input type="text" id="user" name="user" placeholder="enter username" required><br><br>
                    Email:<br>
                    <input type="email" id="email" name="email" placeholder="enter email" required><br><br>
                    Password:<br>
                    <input type="password" id="pass" name="pass" placeholder="create password" required><br><br>
                    Confirm Password:<br>
                    <input type="password" id="pass" name="CPass" placeholder="confirm password" required><br><br>
                    <select name="user_type">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <input type="submit" id="btn" value="Signup">
                <p>already have an account? <a href="login.php">login now</a></p>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>