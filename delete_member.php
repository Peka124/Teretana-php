<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $member_id=$_POST["member_id"];
    
    $upit="DELETE FROM members WHERE member_id=?";
    $run=$konekcija->prepare($upit);
    $run->bind_param("i", $member_id);
    $message="";

    if($run->execute())
    {
        $message="Clan je obrisan";
    }
    else
    {
        $mesage="Clan nije obrisan";
    }

    $_SESSION["success_message"]=$message;
    header("location: admin_dashboard.php");
    exit();
}

?>