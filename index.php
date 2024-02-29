<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["password"];

    $upit="SELECT admin_id, password FROM admins WHERE username=?";

    $run=$konekcija->prepare($upit);
    $run->bind_param("s", $username);
    $run->execute();

    $results=$run->get_result();
    
    if($results->num_rows==1)
    {
        $admin=$results->fetch_assoc();
        
        if(password_verify($password, $admin["password"]))
        {
            $_SESSION["admin_id"]=$admin["admin_id"];

            $konekcija->close();
            header("location: admin_dashboard.php");
        }
        else
        {
            $_SESSION["error"]="Netacna lozinka";

            $konekcija->close();
            header("location: index.php");
            exit();
        }
    }
    else{
        $_SESSION["error"]="Netacno korisnicko ime";

        $konekcija->close();
        header("location: index.php");
        exit();
    }

}


?>

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
    
    if(isset($_SESSION["error"]))
    {
        echo $_SESSION["error"] . "<br>";
        unset($_SESSION["error"]);
    }

    ?>
    <form action="" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>