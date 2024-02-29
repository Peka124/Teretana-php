<!-- <?php

require_once "config.php";

$username="djordje";
$password="peka";

$hashed_password=password_hash($password, PASSWORD_DEFAULT);

$upit="INSERT INTO admins (username, password) VALUES(?, ?)";

$run=$konekcija->prepare($upit);
$run->bind_param("ss", $username, $hashed_password);
$run->execute();

?> -->