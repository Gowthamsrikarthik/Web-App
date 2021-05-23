<?php include('backend.php') ?>
<?php
   if (!isset($_SESSION['users'])) {
    header('location: login.php');}

    $query="SELECT quant,item FROM `items`";
    $res=mysqli_query($db,$query);
    $arr=[];
    $items=[];
    while($rows=$res->fetch_assoc())
    {
        array_push($items,$rows['item']);
        array_push($arr,$rows['quant']);
    }
    function quick_sort($my_array,$item_array)
    {
        $loe = $gt = array();
        $loei=$gti=array();
        if(count($my_array) < 2 && count($item_array) <2)
        {

            return array_merge($my_array,$item_array);
        }
        $pivot_key = key($my_array);
        $pivot_keyi=key($item_array);
        $pivot = array_shift($my_array);
        $pivoti=array_shift($item_array);
        for($x=0;$x<sizeof($my_array);$x++)
        {
            if($my_array[$x] >= $pivot)
            {
                $loe[$x] = $my_array[$x];
                $loei[$x]=$item_array[$x];
            }elseif ($my_array[$x] < $pivot)
            {
                $gt[$x] = $my_array[$x];
                $gti[$x]=$item_array[$x];
            }
        }
        $arra= array_merge(quick_sort($loe,$loei),array($pivot_key=>$pivot ,$pivot_keyi=>$pivoti),quick_sort($gt,$gti));
        return $arra;
    }
    function quick_sort2($my_array)
    {
        $loe = $gt = array();
        if(count($my_array) < 2)
        {
            return $my_array;
        }
        $pivot_key = key($my_array);
        $pivot = array_shift($my_array);
        foreach($my_array as $val)
        {
            if($val >= $pivot)
            {
                $loe[] = $val;
            }elseif ($val < $pivot)
            {
                $gt[] = $val;
            }
        }
        return array_merge(quick_sort2($loe),array($pivot_key=>$pivot),quick_sort2($gt));
    }
    $arrr=quick_Sort($arr,$items);
    $arrr1=quick_sort2($arr);
    echo "<table id='pop'>";
    echo "<tr><th>popularity</th></tr>";
    for($x=0;$x<sizeof($arrr);$x++)
    {
        if(strlen($arrr[$x])>3)
        {
            echo "<tr><td> $arrr[$x] </td></tr>";
        }
       
    }
    echo "</table>";
        echo "<table id='pop2'>";
    echo "<tr><th>Items sold</th></tr>";
    for($x=0;$x<sizeof($arrr1);$x++)
    {

            echo "<tr> <td> $arrr1[$x] </td></tr>";

    }
    echo "</table>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>INDEX</title>
<link href="pr.css" type="text/css" rel="stylesheet">
</head>
<body>
    <form class="for" method="POST">

    <button  id="bu1" name="home" class="home">HOME</button>
    <button  id="bu1" name="account" class="account">ACCOUNT</button>
    <button id="bu1" name="orders" class="orders">ORDERS</button>
    <button id="bu1" name="logout" class="logout">lOG OUT</button>
</form>
<form method="POST">
<div class="in1">
    <img src="https://www.daysoftheyear.com/cdn-cgi/image/fit=cover%2Cf=auto%2Conerror=redirect%2Cwidth=1734%2Cheight=976/wp-content/uploads/sandwich-day-1.jpg"
        width="150" height="100" alt="sandwich" style="padding-left:20px;padding-top:20px;border-radius:20px;" />
<p style="position: relative; left: 10px;"> Sandwich: 120&#8377 </p>
<button type="button" class="sandwich" id="b1" onclick="hide.value=add()">+</button>
<button type="button" class="sandwich" id="b11" onclick="hide.value=sub()">-</button>
<p id="gem"></p>
</div>
<div class="in2">
    <img src="https://www.daysoftheyear.com/cdn-cgi/image/fit=cover%2Cf=auto%2Conerror=redirect%2Cwidth=952%2Cheight=430/wp-content/uploads/burger-day1.jpg"
        width="150" height="100" alt="sandwich" style="padding-left:20px;padding-top:20px;border-radius:20px;" />
<p style="position: relative; left: 10px;"> Burger: 130&#8377 </p>
<button type="button" class="burger" id="b2" onclick="hide2.value=add2()">+</button>
<button type="button" class="burger" id="b21" onclick="hide2.value=sub2()">-</button>
<p id="gem2"></p>
</div>
<div class="in3">
    <img src="https://www.daysoftheyear.com/cdn-cgi/image/fit=cover%2Cf=auto%2Conerror=redirect%2Cwidth=952%2Cheight=430/wp-content/uploads/doughnut-day2-scaled.jpg"
        width="150" height="100" alt="donut" style="padding-left:20px;padding-top:20px;border-radius:20px;" />
<p style="position: relative; left: 10px;"> Donut: 50&#8377 </p>
<button type="button" class="donut" id="b3" onclick="hide3.value=add3()">+</button>
<button type="button" class="donut" id="b31" onclick="hide3.value=sub3()">-</button>
<p id="gem3"></p>
</div>
<div class="in4">
    <img src="https://www.daysoftheyear.com/cdn-cgi/image/fit=cover%2Cf=auto%2Conerror=redirect%2Cwidth=952%2Cheight=430/wp-content/uploads/chocolate-milkshake-day.jpg"
        width="150" height="100" alt="milkshake" style="padding-left:20px;padding-top:20px;border-radius:20px;" />
<p style="position: relative; left: 10px;"> Milkshake: 70&#8377 </p>
<button type="button" class="shake" id="b4" onclick="hide4.value=add4()">+</button>
<button type="button" class="shake" id="b41" onclick="hide4.value=sub4()">-</button>
<p id="gem4"></p>
</div>


        <input type="hidden" name="qaunt" id="hide" />
        <input type="hidden" name="item" value="sandwich" />
        <input type="hidden" name="qaunt1" id="hide2" />
        <input type="hidden" name="item1" value="burger" />
        <input type="hidden" name="qaunt2" id="hide3" />
        <input type="hidden" name="item2" value="donut" />
        <input type="hidden" name="qaunt3" id="hide4" />
        <input type="hidden" name="item3" value="shake" />
        <button type="submit" id="order" name="cart">ORDER</button>
</form>
    <script>
        document.getElementById("pop").style.position = "absolute";
        document.getElementById("pop").style.left = "70%";
        document.getElementById("pop").style.bottom = "60%";
                document.getElementById("pop2").style.position = "absolute";
        document.getElementById("pop2").style.left = "78%";
        document.getElementById("pop2").style.bottom = "60%";
   document.getElementById("order").style.visibility="hidden";
  document.getElementById("gem").style.visibility="hidden";
  var count = 0;
function add(){count =count+1;
  document.getElementById("gem").style.visibility="visible";
  if(count==0 && count2==0 && count3 ==0 && count4 ==0){document.getElementById("order").style.visibility="hidden";}
if(count>0 || count2>0 || count3>0 || count4 >0){document.getElementById("order").style.visibility="visible";}
  document.getElementById("gem").innerHTML=count;return count;
}
function sub(){if(count>0){count -= 1;}
document.getElementById("gem").innerHTML=count;
if(count==0)
{
  document.getElementById("gem").style.visibility="hidden"; 
}
if(count==0 && count2==0 && count3 ==0 && count4 ==0){document.getElementById("order").style.visibility="hidden";}
if(count>0 || count2>0 || count3>0 || count4 >0){document.getElementById("order").style.visibility="visible";}
return count;}

document.getElementById("gem2").style.visibility="hidden";
var count2 = 0;
function add2(){count2 =count2+1;
  document.getElementById("gem2").style.visibility="visible";
  if(count==0 && count2==0 && count3 ==0 && count4 ==0){document.getElementById("order").style.visibility="hidden";}
if(count>0 || count2>0 || count3>0 || count4 >0){document.getElementById("order").style.visibility="visible";}
  document.getElementById("gem2").innerHTML=count2; return count2;}
function sub2(){if(count2>0){count2 -= 1;}
document.getElementById("gem2").innerHTML=count2;
if(count2==0)
{
  document.getElementById("gem2").style.visibility="hidden";  
}
if(count==0 && count2==0 && count3 ==0 && count4 ==0){document.getElementById("order").style.visibility="hidden";}
if(count>0 || count2>0 || count3>0 || count4 >0){document.getElementById("order").style.visibility="visible";}
return count2;}

document.getElementById("gem3").style.visibility="hidden";
var count3 = 0;
function add3(){count3 =count3+1;
    document.getElementById("gem3").style.visibility = "visible";
    if (count == 0 && count2 == 0 && count3 == 0 && count4 ==0) { document.getElementById("order").style.visibility = "hidden"; }
    if (count > 0 || count2 > 0 || count3>0 || count4 >0) { document.getElementById("order").style.visibility = "visible"; }
  document.getElementById("gem3").innerHTML=count3; return count3;}
function sub3(){if(count3>0){count3 -= 1;}
document.getElementById("gem3").innerHTML=count3;
if(count3==0)
{
  document.getElementById("gem3").style.visibility="hidden";
    }
    if (count == 0 && count2 == 0 && count3 ==0 && count4 ==0) { document.getElementById("order").style.visibility = "hidden"; }
if(count>0 || count2>0 || count3>0 || count4 >0){document.getElementById("order").style.visibility="visible";}
return count3;}

    document.getElementById("gem4").style.visibility="hidden";
var count4 = 0;
function add4(){count4 =count4+1;
    document.getElementById("gem4").style.visibility = "visible";
    if (count == 0 && count2 == 0 && count3 == 0 && count4 ==0) { document.getElementById("order").style.visibility = "hidden"; }
    if (count > 0 || count2 > 0 || count3>0 || count4 >0) { document.getElementById("order").style.visibility = "visible"; }
  document.getElementById("gem4").innerHTML=count4; return count4;}
function sub4(){if(count4>0){count4 -= 1;}
document.getElementById("gem4").innerHTML=count4;
if(count4==0)
{
  document.getElementById("gem4").style.visibility="hidden";
    }
    if (count == 0 && count2 == 0 && count3 == 0 && count4 ==0) { document.getElementById("order").style.visibility = "hidden"; }
    if (count > 0 || count2 > 0 || count3 > 0 || count4 >0) { document.getElementById("order").style.visibility = "visible"; }
return count4;}
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
    }

    </script>
<?php
$query="SELECT item,quant FROM `items`";
$ro=mysqli_query($db,$query);
$ress=$ro->fetch_assoc();

 ?>
</body>
</html>