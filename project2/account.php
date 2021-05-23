<?php include('backend.php') ?>
<?php
   if (!isset($_SESSION['users'])) {
    header('location: login.php');
}
$usera=$_SESSION['users'];
$query="SELECT phone,email FROM `users` WHERE users='$usera'";
$result=mysqli_query($db,$query);
$row=$result->fetch_assoc();
  if(isset($_POST['su'])){
    $var=mysqli_real_escape_string($db,$_POST['usern']);
    $var2=mysqli_real_escape_string($db,$_POST['ph']);
$query="SELECT users,phone FROM `users` WHERE users<> '$usera'";
$result=mysqli_query($db,$query);

    $names=[];
    $numbers=[];
    while($re=$result->fetch_assoc())
    {
        array_push($names,$re['users']);
        array_push($numbers,$re['phone']);
    }
    $temp=0;
    $temp1=0;
    for($x=0;$x<sizeof($names);$x++)
    {
        if($names[$x]!=$var)
        {
            $temp++;
        }
           if($numbers[$x]!=$var2)
        {
            $temp1++;
        }
    }
    if(sizeof($names)==$temp)
    {
        $query="UPDATE `users` SET `users`='$var' WHERE users='$usera'";
        $_SESSION['users']=$var;
        mysqli_query($db,$query);

    }
    else
    {
        echo "<script>alert('username is already in use')</script>";
    }
    if(sizeof($numbers)==$temp1)
    {
        $query="UPDATE `users` SET `phone`='$var2' WHERE users='$usera'";
        $row['phone']=$var2;
        mysqli_query($db,$query);

    }
    else
    {
        echo "<script>alert('phone number already exist')</script>";
    }
  }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            ACCOUNT INFO
        </title>
    <link href="pr.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        
    <form class="for" method="POST">
<button  id="bu1" name="home" class="home">HOME</button>
<button  id="bu1" name="account" class="account">ACCOUNT</button>
<button id="bu1" name="orders" class="orders">ORDERS</button>
<button id="bu1" name="logout" class="logout">lOG OUT</button>
</form>
<div id="acc">
    <h1 id="accheading"><?php echo $_SESSION['users'] ?>   Account Info</h1>
<form method="POST">
<label>username</label>
<input type="text" name="usern" id="u" value=<?php echo $_SESSION['users']?>>
<br>
<br>
<label>Phone</label>
<input  type="text" name="ph" id ="p" value=<?php echo $row['phone']?>>
<br>
<br>
<button type="button" id="ch" onclick="pop()">Change</button>
<button type="button" id="can" onclick="disp()">Cancel</button>
<button type="submit" name="su" id="done">DONE</button>
</form>
<br>
<form method="POST">
<label>Email</label>
<input type="email" name="em" id="e" value=<?php echo $row['email'] ?>>
<br>
<br>
<button type="button" id="ch2" onclick="op()">Change</button>
<button type="button" id="can2" onclick="disp2()">Cancel</button>
<button type="submit" id="otp" name="otp">Send OTP</button>
</form>
<br>
    <form method="POST">
        <label>Password</label>
        <br />
        <br />
        <button type="button" id="ch3" onclick="hid()">Change</button>
        <button type="button" id="can3" onclick="hidmo()">cancel</button>
        <button type="submit" id="otp2" name="otp2">Confirm change</button>
        <?php
    if(isset($_POST['otp2']))
{
    echo "<script type=\"text/javascript\">
        window.open('changep.php','_blank')
    </script>";
}
        ?>
    </form>
</div>
<script type="text/javascript">
var name=document.getElementById("u").value;
var phone=document.getElementById("p").value;
    var email = document.getElementById("e").value;
    document.getElementById("can3").style.visibility = "hidden";
    document.getElementById("otp2").style.visibility = "hidden";
    function hid() {
        document.getElementById("ch3").style.visibility = "hidden";
            document.getElementById("can3").style.visibility = "visible";
    document.getElementById("otp2").style.visibility = "visible";
    }
    function hidmo() {
                    document.getElementById("ch3").style.visibility = "visible";
            document.getElementById("can3").style.visibility = "hidden";
    document.getElementById("otp2").style.visibility = "hidden";
    }
    document.getElementById("u").readOnly=true;document.getElementById("p").readOnly=true;
    document.getElementById("e").readOnly=true;document.getElementById("can").style.visibility="hidden";
    document.getElementById("done").style.visibility="hidden";document.getElementById("otp").style.visibility="hidden";
    document.getElementById("can2").style.visibility="hidden";
    function op()
    {
        document.getElementById("otp").style.visibility="visible";
        document.getElementById("ch2").style.visibility="hidden";
        document.getElementById("can2").style.visibility="visible";
    }
    function pop()
    {
        document.getElementById("done").style.visibility="visible";
        document.getElementById("u").readOnly=false;
        document.getElementById("p").readOnly=false;
        document.getElementById("ch").style.visibility="hidden";
        document.getElementById("can").style.visibility="visible";
    }
    function disp()
    {
        document.getElementById("u").readOnly=true;document.getElementById("p").readOnly=true;
        document.getElementById("u").value=name;
        document.getElementById("p").value=phone;
        document.getElementById("can").style.visibility="hidden";
        document.getElementById("ch").style.visibility="visible";
        document.getElementById("done").style.visibility="hidden";
    }
    function disp2()
    {
        document.getElementById("can2").style.visibility="hidden";
        document.getElementById("ch2").style.visibility="visible";
        document.getElementById("otp").style.visibility="hidden";
    }
        var account=document.getElementsByClassName("account");
     account[0].classList.replace("account","accountalt");
    
     var home=document.getElementsByClassName("home");
     home[0].classList.replace("home","homealt");
     if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
    }
    </script>
    </body>
</html>
