<?php
include("connection.php");
session_start();

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = md5($_POST['pass']);
    $user_type = $_POST['user_type'];
    $sql = " SELECT * FROM login WHERE username = '$name' && Password = '$pass' ";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        if($row['user_type'] == 'admin')
        {
            $_SESSION['admin_name'] = $row['user'];
            header('location:admin_page.php');
        }
        elseif($row['user_type'] == 'user')
        {
            $_SESSION['user_name'] = $row['user'];
            header('location:user_page.php');
        }
    }
    else
    {
        $error[] = 'incorrect email or password!';
    }

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
    <h1>Login Form</h1>
    <form name="form" method="post" action="">
        <div class="input">
            Username:<input type="text" id="user" name="user" required><br><br>
            Password:<input type="password" id="pass" name="pass" required><br><br>
            <select name="user_type">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select><br><br>
            <input type="submit" id="btn" value="LOGIN" name="submit">
            <p>don't have an account? <a href="signup.php">signup</a></p>
            <p>(OR)</p><i class="fa-brands fa-facebook fa-2xl"></i>
            <i class="fa-brands fa-google fa-2xl"></i>
            <p>(OR)</p>
            Mobile number: <input type="number" id="mobile" class="form-input" placeholder="Enter the 10 digit mobile"><br><br>
            <input type="button" id="btn" value="Send OTP" onClick="sendOTP();">
        </div>
    </form>
    <script>
        function sendOTP() 
        {
            $(".error").html("").hide();
            var number = $("#mobile").val();
            if (number.length == 10 && number != null) 
            {
                var input = 
                {
                    "mobile_number" : number,
                    "action" : "send_otp"
                };
                $.ajax
                (
                    {url : 'controller.php',
                        type : 'POST',
                        data : input,
                        success : function(response) 
                        {
                            $(".container").html(response);
                        }
                    });
                } 
                else 
                {
                    $(".error").html('Please enter a valid number!')
                    $(".error").show();
                }
            }
    </script>
    </div>
</body>
</html>