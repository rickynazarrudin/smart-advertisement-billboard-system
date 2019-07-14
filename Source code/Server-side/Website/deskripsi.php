<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protel";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$resulta = mysqli_query($conn, "SELECT * FROM tb_image");
while($rowa = mysqli_fetch_assoc($resulta))
{
    $parameter = $rowa['name'];
}
$result = mysqli_query($conn, "SELECT * FROM tb_directory WHERE name='$parameter'");
$row = mysqli_fetch_assoc($result);
$deskripsi = $row['description'];
echo $deskripsi;
?>
