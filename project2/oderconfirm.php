<?php include('backend.php');
 $quan=$_SESSION['quan'];
 $quan1=$_SESSION['quan1'];
 $quan2=$_SESSION['quan2'];
 $quan3=$_SESSION['quan3'];
 $timee=$_SESSION['time'];
if(isset($_POST['cancel']))
{
    $query="DELETE FROM `order` WHERE time='$timee'";
    mysqli_query($db, $query);
    $query2="SELECT item,quant FROM `items`";
    $res=mysqli_query($db, $query2);
    $oquant=array($quan1,$quan2,$quan,$quan3);
    $quant=[];
    $items=[];
    while($rows=$res->fetch_assoc())
    {
        array_push($quant,$rows['quant']);
        array_push($items,$rows['item']);
    }
    for( $x=0;$x<sizeof($oquant);$x++)
    {
        $quant[$x]=$quant[$x]-$oquant[$x];
    }
    for($x=0;$x<sizeof($items);$x++)
    {
        $q=$quant[$x];
        $i=$items[$x];
        $query="UPDATE `items` SET `quant`='$q' WHERE item='$i' ";
        mysqli_query($db, $query);
    }
    $message=" Your Order has canceled successfully";
    echo "<script>alert('$message');</script>";
    echo "<script>window.close();</script>";
}
?>
<html>
<head>
    <title>
        Order Confirm
    </title>
    <link href="pr.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div>
    <h1>ORDER DETAILS</h1>
    <p>
        <b>ITEMS ORDERED:</b><?php echo $_SESSION['itemsn'] ?>
    </p>
    <p>
        <b>QUANTITY:</b><?php echo $_SESSION['quantity'] ?>
    </p>
    <p>
        <b>TOTAL PRICE:</b><?php echo $_SESSION['totalprice']?>
    </p>
    <p>
        <b>TIME:</b><?php echo $_SESSION['time']?>
    </p>
    <p id="cou"></p>
    <p>You can close the tab if you dont want to cancel your order</p>
    <p>
        To cancel order please press
        <b>Cancel</b>
    </p>
    <form method="post">
        <button type="submit" name="cancel" id="cancel">Cancel</button>
    </form>
</div>
    <script>
            const starttime=1.00;
            let time=starttime * 60;
            const countdownel=document.getElementById("cou");
            var ti=setInterval(update,1000);
            function update()
            {
                const minutes=Math.floor(time/60);
                const seconds=time % 60;
                countdownel.innerHTML="You can cancel your Order in "+ `${minutes}:${seconds}`+" minutes";
                time--;
                if(minutes==0 && seconds==0)
            {
                    clearInterval(ti);
                    window.close();
            }
        }
                    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>