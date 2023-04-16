<?php 
if (isset($_GET["id"])) {

    $id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$port = 3307;

//Create connection since we changed the port num had to add it here
$connection = new mysqli($servername, $username, $password, $database, $port);

$sql = "DELETE FROM clients WHERE id=$id";
$connection->query($sql);

header("location: /myshop/index.php");
exit;
}
?>