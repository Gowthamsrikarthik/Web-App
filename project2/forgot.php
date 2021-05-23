<?php include('backend.php') ?>
<?php

if(isset($_POST['subforlpass']))
{
    $mail=$_SESSION['fmail'];
    if($_POST['forpasotp']==$_SESSION['otp2'])
    {
        if($_POST['flpass']==$_POST['flpass2'])
        {
            $pass=hash('md5',$_POST['flpass']);
            $query="UPDATE `users` SET `password`='$pass' WHERE email='$mail'";
            mysqli_query($db,$query);
            $message="password changed successfully";
            echo "<script>alert('$message')</script>";
            echo "<script>window.close()</script>";
        }
        else
        {
            echo " passwords does not match";
        }
    }
    else
    {
        echo "Invalid OTP";
    }
}
?>
<html>
<head>
    <title>
        forgot password
    </title>
    <link href="pr.css" type="text/css" rel="stylesheet" />
</head>
    <body>
        <form method="post" id="forgotpass">
        <label>
            Enter the OTP:
        </label>
            <input type="number" name="forpasotp" required/>
            <br />
            <br />
            <label>
                Enter New Password
            </label>
            <input type="password" name="flpass" required/>
            <br />
            <br />
            <label>
                Confirm Password
            </label>
            <input type="password" name="flpass2" required/>
            <br />
            <br />
            <button id="subforlpass" name="subforlpass" type="submit">
                Submit
            </button>
        </form>
        <script>
            document.getElementById("forgotpass").style.position = "absolute";
            document.getElementById("forgotpass").style.left = "35%";
            document.getElementById("forgotpass").style.top = "30%";
            document.getElementById("forgotpass").style.backgroundColor = "rgba(255,248,220,0.4)";
            document.getElementById("forgotpass").style.padding = "20px";
            document.getElementById("forgotpass").style.borderRadius = "10px";
                           if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
        </script>
    </body>
</html>