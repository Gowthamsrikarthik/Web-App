<?php include('backend.php') ?>
<?php

   if (!isset($_SESSION['users'])) {
    header('location: login.php');
}
?>
<html>
    <head>
        <title>
            CHANGE
        </title>
        <link  href="pr.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form method="POST" id="chanemail">
        <label>OTP:</label>
        <input type="number" name="ot">
        <br>
        <label id="nel">Enter New Email</label>
<input type="email" name="nem" id="ne" placeholder="enter new email">
<button name="sub" id="chanem">Submit</button>
        </form>
        <?php
        if(isset($_POST['sub']))
{
$otpconf=$_POST['ot'];
$newemail=mysqli_real_escape_string($db,$_POST['nem']);
$name=$_SESSION['users'];
if($otpconf==$_SESSION['otp'])
{
    $query="SELECT email FROM `users`  WHERE users<>'$name'";
  $result=mysqli_query($db,$query);
  $emails=[];
  while($re=$result->fetch_assoc())
  {
      array_push($emails,$re['email']);
  }
  $temp=0;
  for($x=0;$x<sizeof($emails);$x++)
  {
      if($emails[$x]!=$newemail)
      {
          $temp++;
      }
  }
  if($temp==sizeof($emails))
  {
      $query="UPDATE `users` SET `email`='$newemail'  WHERE users='$name'";
      mysqli_query($db,$query);
      $mess="email is changed";
      echo "<script>alert('$mess');</script>";
      echo "<script>window.close();</script>";
  }
  else
  {
      $mess="email already exist";
      echo "<script>alert('$mess');</script>";
  }
}
else
{
  echo "<p> Entered wrong OTP </p>";
}
}
        ?>
        <script>
                             if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
        </script>
    </body>
</html>