<?php include('backend.php')?>
<!DOCTYPE html>
<html>
    <head>
    <title>
        LOGIN
    </title>
    <link href="pr.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h1 id="heading">BAKE</h1>
    <form method="POST" class="f1">
    <?php include('errors.php'); ?>
<label>
    Username:
</label>
<input type="text" name="username" required>
<br>
<br>
<label>
    Phone number:
</label>
<input type="number" name="number" required>
<br>
<br>
<label>
    Email:
</label>
<input type="email" name=" email" required id="email">
<br>
<br>
<label>
    Password:
</label>
<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" required> 
        <br />
        <br />
<button type="submit" name="req_user" id="reg">
    submit
</button>
        <a href="login.php" class="ab">Account exist</a>
    </form>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
    </html>

