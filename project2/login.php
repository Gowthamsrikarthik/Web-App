<?php include('backend.php') ?>
<html>
    <head>
    <title>
        LOGIN
    </title>
    <link href="pr.css" type="text/css" rel="stylesheet">
    
</head>
<body >
    <h1 id="heading">BAKE</h1>
    <form method="POST" class="f2" >
    <?php include('errors.php'); ?>
    <label>
    username:
</label style="background-color:cornsilk;" >
<input type="text" name="username" required>
<br>
<br>
<label>
    password:
</label>
<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" required id="pass"> 
        <br />
        <br />
<button type="submit" name="submit" id="login">
    Log in
</button>
<a href="register.php" id="link">Not Registered?</a>
        <br />
        <a id="fp" onclick="pop()">Forgot Passsword</a>
        </form>

    <form method="post" id="fpa">

        <label id="lable">
            Enter Email
        </label>
        <input type="email" name="fmail" id="fmail" required />
        <button type="button" id="cancelbutton" onclick="out()">Cancel</button>
        <button type="submit" name="fotp" id="fop">Send OTP</button>
    </form>
    <script>
        document.getElementById("lable").style.visibility ="hidden";
        document.getElementById("fmail").style.visibility = "hidden";
                 document.getElementById("cancelbutton").style.visibility ="hidden";
        document.getElementById("fop").style.visibility ="hidden";
        function pop() {
                                 document.getElementById("lable").style.visibility ="visible";
            document.getElementById("fmail").style.visibility ="visible";
                     document.getElementById("cancelbutton").style.visibility ="visible";
            document.getElementById("fop").style.visibility = "visible";
                    document.getElementById("fp").style.visibility ="hidden";
        }
        function out() {
                   
                    document.getElementById("cancelbutton").style.visibility ="hidden";
                   document.getElementById("lable").style.visibility ="hidden";
            document.getElementById("fmail").style.visibility = "hidden";
            document.getElementById("fop").style.visibility = "hidden";
                    document.getElementById("fp").style.visibility ="visible";
        }
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
    </html>
