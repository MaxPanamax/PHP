<?php
function VerifyUser($login, $pass): string|bool
{
    
    if (!file_exists("./data/users.dat"))
    {
        return false;
    }
    $file=file_get_contents("./data/users.dat");
    $users=explode("\n",$file);
  for ($i=0; $i < count($users); $i++) { 
    
    $user=explode(" ",$users[$i]);
    if ($user[0]==$login){
        break;
    }
    }
    if($i==count($users)){
        file_put_contents("./config/current.dat","false");
        return "Пользователь не найден";
    }
    
    if ($login == $user[0]&&$pass==$user[1]){
        file_put_contents("./config/current.dat","true");
        return true;
    }
    file_put_contents("./config/current.dat","false");
    return false;
}

function CurrentUser():bool{
    return file_get_contents("./config/current.dat")=="false"?FALSE:TRUE;
}
function RegisterUser($login,$pass): string|bool
{

    if (!file_exists("./data/users.dat"))
    {
        return false;
    }
    $file=file_get_contents("./data/users.dat");
    $users=explode("\n",$file);
  for ($i=0; $i < count($users); $i++) { 
    
    $user=explode(" ",$users[$i]);
    if ($user[0]==$login){
        return "Ты уже есть";
    }
}
    file_put_contents("./data/users.dat",$file."\n".$login." ".$pass);
  return true;
}
?>