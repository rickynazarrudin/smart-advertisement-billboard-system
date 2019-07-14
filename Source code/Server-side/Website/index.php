<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT * FROM tb_image");
while($row = mysqli_fetch_assoc($result))
{
    $parameter = $row['name'];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Protel - SABS</title>
    <style>
        .image {
          opacity: 1;
          border-radius: 5px;
          width: 100%;
          height: 545px;
          background-position: center;
          object-fit: cover;
          background-size: cover;
          transition: .5s ease;
          backface-visibility: hidden;
        }
        .running{
          font: normal 1.4em verdana, arial, tahoma, sans-serif;
        }
        .container:hover .image {
          opacity: 0.1;
        }
        .container:hover .middle {
          opacity: 1;
        }
        h1 {
          margin: 0 0 6px 0;
          font: normal 1.4em verdana, arial, tahoma, sans-serif;
          text-transform: uppercase;
          color:#efc539;
        }
        </style>
  </head>
  <body style="background:#1b2630;">
    <div id="currentAds"></div>
    <marquee width="100%" bgcolor="#FFF" height="30px;" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" style="border-radius: 5px; padding-top:13px;">
    <div id="deskripsi"></div>
    </marquee>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript">
    function tampil(){
      $('#currentAds').load('autoimage.php');
    }
    var load = setInterval(tampil, 100);
    function desc(){
      $('#deskripsi').load('deskripsi.php');
    }
    var load = setInterval(desc, 100);
    </script>
  </body>
</html>
