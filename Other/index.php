<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a=5;
        $name="alice";
        echo "Привет!!".$a." ".$name."</br>";
        $a=$name;
        echo $a;
        $b=&$name;
        echo $b. "<br/>";
        $bool=true;
        echo var_dump($name);
        $bo1=true;
        $bo2=false;
        $bo3 = 5/2;
        //$res=$bo2 or $bo1;
        /*echo var_dump($bo1);
        echo var_dump($bo2);
        $res=$bo1||$bo2;
        echo var_dump($res);*/
        $a=0;



        if($bo1===$a)
        {
            ?>"AAAAA!!";<?php
        }
        else{
            ?>"BBBBB!!";<?php
        }

        switch ($variable) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        

    
        echo $bo2." ".$a;
        echo var_dump($bo3);
    ?>
</body>
</html>