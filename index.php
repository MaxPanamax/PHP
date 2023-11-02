<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <?php 
        include("./header.php");
    ?>
    <title>Document</title>
</head>
<body>
    <?php 

    define("BR","<br/>");
   $a=5;


   function MyFunc(){
    global $a;
    $b=2;
    $a=6;
    echo"привет".$a.BR;
    foreach($GLOBALS as $k=>$v)
    {
        echo "".$k."".$v.BR;
    }
   }

   function MyFunc2(){
    echo"111111".BR;
    function MyFunc3(){
        echo "22222222".BR;
   }}
   $NmaeFunc="MyFunc";
   MyFunc2();
   MyFunc3();
   MyFunc();
   echo "привет".$a.BR;
    ?>
</body>
</html>