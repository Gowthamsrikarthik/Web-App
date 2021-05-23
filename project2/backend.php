<?php
session_start();
// initializing variables
$errors = array();
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'users');
// REGISTER USER
if (isset($_POST['req_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $mobile = mysqli_real_escape_string($db, $_POST['number']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE users='$username' OR email='$email' OR
  phone='$mobile' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['users'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
    if ($user['phone'] === $mobile) {
      array_push($errors, "Mobile Number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password=hash('md5',$password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (users, email, password, phone)
  			  VALUES('$username', '$email', '$password', '$mobile')";
  	mysqli_query($db, $query);
  	header('location: login.php');
  }
}
// ...
// LOGIN USER
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (count($errors) == 0) {
 $password=hash('md5',$password);
    $query = "SELECT * FROM users WHERE users='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['users'] = $username;
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
  }
}
}
if (isset($_POST['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
if (isset($_POST['orders']))
{
  header("location: orders.php");
}
if (isset($_POST['home']))
{
  header("location: index.php");
}
if (isset($_POST['account']))
{
  header("location: account.php");
}
if(isset($_POST['otp']))
{
    $usera=$_SESSION['users'];
    $query="SELECT phone,email FROM `users` WHERE users='$usera'";
    $result=mysqli_query($db,$query);
    $row=$result->fetch_assoc();
    $otp=rand(100000,999999);
    $_SESSION['otp']=$otp;
    $to=$row['email'];
    $subject="OTP";
    $headers = "From: 121810307062@gitam.in";
    if (mail($to, $subject, $otp, $headers)) {
        echo "<script>window.open('change.php','_blank')</script>";

        echo "Email successfully sent to $to... please reload in order to show the changes";
    } else {
        echo "Email sending failed...";
    }
}
if(isset($_POST['fotp']))
{
    $fomail=mysqli_real_escape_string($db,$_POST['fmail']);
    $query="SELECT email FROM `users` WHERE email='$fomail'";
    $result=mysqli_query($db,$query);
    $userinfo=$result->fetch_assoc();
    if($userinfo)
    {
        if($userinfo['email']==$fomail)
        {
            $_SESSION['fmail']=$fomail;
            $otp2=rand(100000,999999);
            $_SESSION['otp2']=$otp2;
            $to=$fomail;
            $subject="OTP";
            $headers = "From: 121810307062@gitam.in";
            if (mail($to, $subject, $otp2, $headers)) {
                $message= "Email successfully sent to  $to";
                echo "<script>alert('$message');</script>";
                echo "<script>window.open('forgot.php','_blank')</script>";
            }
            else {
                echo "Email sending failed";
            }

        }
    }
    else
    {
        echo "Email sending failed...please check the email ID";
    }
}
if(isset($_POST['cart']))
{
  $user=" ";
  $quan=mysqli_real_escape_string($db, $_POST['qaunt']);
  $quan=intval($quan);
  $_SESSION['quan']=$quan;
  $price=$quan * 120;
  if($price >0){
  $item=mysqli_real_escape_string($db, $_POST['item']);
  $que="SELECT quant FROM `items` WHERE item='$item'";
  $res=mysqli_query($db,$que);
  $cou=$res->fetch_assoc();
  $count=$cou['quant'];
  $count=$count+$quan;
  $que2="UPDATE `items` SET `quant`='$count' WHERE item='$item'";
mysqli_query($db,$que2);
  $query="SELECT item FROM items WHERE item='$item'";
  $result= mysqli_query($db, $query);
  if(mysqli_num_rows($result) == 1)
  {
    $user=$_SESSION['users'];
  }
  }
  else
  {
  $item=null;
  }
  $_SESSION['item']=$item;
  $quan1 =mysqli_real_escape_string($db, $_POST['qaunt1']);
  $quan1=intval($quan1);
  $_SESSION['quan1']=$quan1;
  $price1=$quan1 * 130;
  if($price1 > 0){
  $item1=mysqli_real_escape_string($db, $_POST['item1']);
  $que="SELECT quant FROM `items` WHERE item='$item1'";
  $res=mysqli_query($db,$que);
  $cou=$res->fetch_assoc();
  $count=$cou['quant'];
  $count=$count+$quan1;
  $que2="UPDATE `items` SET `quant`='$count' WHERE item='$item1'";
mysqli_query($db,$que2);
  $query="SELECT item FROM items WHERE item='$item1'";
  $result= mysqli_query($db, $query);
  if(mysqli_num_rows($result) == 1)
  {
    $user=$_SESSION['users'];
  }
  }
  else
  {
    $item1=null;
  }
  $_SESSION['item1']=$item1;
  $quan2 =mysqli_real_escape_string($db, $_POST['qaunt2']);
  $quan2=intval($quan2);
  $_SESSION['quan2']=$quan2;
  $price2=$quan2 * 50;
  if($price2 > 0){
      $item2=mysqli_real_escape_string($db, $_POST['item2']);
      $que="SELECT quant FROM `items` WHERE item='$item2'";
      $res=mysqli_query($db,$que);
      $cou=$res->fetch_assoc();
      $count=$cou['quant'];
      $count=$count+$quan2;
      $que2="UPDATE `items` SET `quant`='$count' WHERE item='$item2'";
      mysqli_query($db,$que2);
      $query="SELECT item FROM items WHERE item='$item2'";
      $result= mysqli_query($db, $query);
      if(mysqli_num_rows($result) == 1)
      {
          $user=$_SESSION['users'];
      }
  }
  else
  {
      $item2=null;
  }
  $_SESSION['item2']=$item2;
  $quan3 =mysqli_real_escape_string($db, $_POST['qaunt3']);
  $quan3=intval($quan3);
  $_SESSION['quan3']=$quan3;
  $price3=$quan3 * 70;
  if($price3 > 0){
      $item3=mysqli_real_escape_string($db, $_POST['item3']);
      $que="SELECT quant FROM `items` WHERE item='$item3'";
      $res=mysqli_query($db,$que);
      $cou=$res->fetch_assoc();
      $count=$cou['quant'];
      $count=$count+$quan3;
      $que2="UPDATE `items` SET `quant`='$count' WHERE item='$item3'";
      mysqli_query($db,$que2);
      $query="SELECT item FROM items WHERE item='$item3'";
      $result= mysqli_query($db, $query);
      if(mysqli_num_rows($result) == 1)
      {
          $user=$_SESSION['users'];
      }
  }
  else
  {
      $item3=null;
  }
  $_SESSION['item3']=$item3;
  //used for entering the items purchased
  $str=" ";
  $coma=",";
  $nullsize=0;
  $items=array($item,$item1,$item2,$item3);
  for($x=0;$x<sizeof($items);$x++)
  {
    if($items[$x]==null)
    {
    $nullsize++;
    }
  }
  $size=sizeof($items)-$nullsize;
  for($x=0;$x<sizeof($items);$x++)
  {
    if($x==$size-1)
    {
      $coma="";
    }
    if($items[$x]!=null)
      {
      $str=$str.$items[$x].$coma;
      }
  }

  //used for entering the price of items purchased
  $pricearray=array($price,$price1,$price2,$price3);
  $totalprice=0;
  for($x=0;$x<sizeof($pricearray);$x++)
  {
    $totalprice=$totalprice+$pricearray[$x];
  }


  $quantity=" ";
  $mul="✕";
  $coma1=",";
  $nullsiz=0;
  $quant=array($quan,$quan1,$quan2,$quan3);
  for($x=0;$x<sizeof($quant);$x++)
  {
    if($quant[$x]==0)
    {
    $nullsiz++;
    }
  }
  $siz=sizeof($quant)-$nullsiz;
  for($x=0;$x<sizeof($quant);$x++)
  {
    if($x==$siz-1)
    {
      $coma1="";
    }
    if($quant[$x]!=0 && $items[$x]!=null)
    {
    $quantity=$quantity.$quant[$x].$mul.$items[$x].$coma1;
    }
  }
  $_SESSION['quantity']=$quantity;
  $_SESSION['totalprice']=$totalprice;
  $_SESSION['itemsn']=$str;
  date_default_timezone_set("Asia/Calcutta");
$date=date("Y-m-d");
$time=date("g:i a.", time());
$_SESSION['time']=$time;
if($totalprice!=0){
$query="INSERT INTO `order` VALUES('$user','$str','$quantity','$totalprice','$date','$time')";
  mysqli_query($db, $query);
}
echo "<script>window.open('oderconfirm.php','_blank')</script>";
}
?>