<?php
include('backend.php');
?>
<?php 
   if (!isset($_SESSION['users'])) {
    header('location: login.php');
}?>
<html>
<head>
    <title>
        CHANGE
    </title>
    <link href="pr.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form method="post" id="chanpass" onsubmit="return validation()" id="changepass">
        <label>
            Enter the old password
        </label>
        <input type="password" id="oldp" name="oldp" required/>
        <br />
        <br />
        <label>
            Enter the new password:
        </label>
        <input type="password" id="newp" name="newp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" required/>
        <br />
        <br />
        <label>Confirm password</label>
        <input type="password" id="newpc" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" required/>
        <br />
        <br />
        <button type="submit" id="passch" name="changepass">
            change
        </button>
    </form>
    <br />
    <br />
    <p id="msg">
    </p>
    <?php
    $user=$_SESSION['users'];
$query="SELECT password From `users` where users='$user'";
$resu=mysqli_query($db,$query);
$pass=$resu->fetch_assoc();
$pas=$pass['password'];
    if(isset($_POST['changepass']))
    {
        $passo=$_POST['oldp'];
        $passw=hash('md5',$passo);
        if($pas==$passw)
        {
            $newpass=mysqli_real_escape_string($db,$_POST['newp']);
            $newpassh=hash('md5',$newpass);
            $query="UPDATE `users` SET `password`='$newpassh' WHERE users='$user'";
            mysqli_query($db,$query);
            $message="password has changed successfully";
            echo "<script>alert('$message');</script>";
            echo "<script>window.close();</script>";
        }
        else
        {
            echo "Please enter the coorect old password";
        }
    }
    ?>
    <script>
        function validation() {
            if (document.getElementById("newp").value == document.getElementById("newpc").value) {
                return true;
            }
            else {
                document.getElementById("msg").innerHTML = " please check the new password and confirm password";
                return false;
            }
        }
                     if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
    </html>
