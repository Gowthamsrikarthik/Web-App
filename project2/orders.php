<?php include('backend.php')?>
<?php 
   if (!isset($_SESSION['users'])) {
    header('location: login.php');
}
?>
<html>
    <head>
        <title>
            ORDERS
</title>
<link href="pr.css" type="text/css" rel="stylesheet">
</head>
<body>
<form class="for" method="POST">
<button  id="bu1" name="home" class="home">HOME</button>
<button  id="bu1" name="account" class="account">ACCOUNT</button>
<button id="bu1" name="orders" class="orders">ORDERS</button>
<button id="bu1" name="logout" class="logout">lOG OUT</button>
</form>
<?php
$user=$_SESSION['users'];
$query="SELECT * FROM `order` WHERE user='$user' ORDER BY date";
$query2="SELECT date FROM `order` WHERE user='$user' GROUP BY date";
$result=mysqli_query($db,$query);
$result2=mysqli_query($db,$query2);
$dates=[];
$times=[];
$items=[];
           $quantity=[];
           $price=[];
           $date=[];
          
                while($rows=$result->fetch_assoc()) 
                { 
                    array_push($items,$rows['items']);
                    array_push($quantity,$rows['quantity']);
                    array_push($price,$rows['price']);
                    array_push($date,$rows['date']);
                    array_push($times,$rows['time']);

                }
                while($rows2=$result2->fetch_assoc())
                {
                    array_push($dates,$rows2['date']);
                }
               
?>  
    <?php for($x=0;$x<sizeof($dates);$x++)
    {
    ?>
    <h1 style="background-color:cornsilk;" id="headi">
        <?php echo $dates[$x]; ?>
    </h1>
        <table id="tab"> 
        <tr>
        <th>time</th>
        <th>Items</th>
    <th>Quantity</th>
    <th>Price</th>
        </tr>
        <?php for($y=0;$y<sizeof($date);$y++)
        { 
        ?>
        <?php if($date[$y]==$dates[$x])
        {      
        ?>
        <tr>
            <td> <?php echo $times[$y]; ?></td>
            <td> <?php echo $items[$y]; ?> </td>
            <td> <?php echo $quantity[$y]; ?> </td>
            <td> <?php echo $price[$y]; ?> </td>
        </tr>
<?php
        }
?>
    <?php
    }
        ?>
         </table>
        <?php
    }
    ?>

<script>
    var home=document.getElementsByClassName("home");
     home[0].classList.replace("home","homealt");
     var orders=document.getElementsByClassName("orders");
     orders[0].classList.replace("orders","ordersalt");
     if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>
</body>
    </html>
