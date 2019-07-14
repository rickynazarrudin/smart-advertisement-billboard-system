<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protel";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>SABS Admin</title>
    <style type="text/css">
      #imagepil {
        width: 100%;
        height: 450px;
        background-position: center;
        object-fit: cover;
        background-size: cover;
        transition: .5s ease;
        backface-visibility: hidden;
      }
    </style>
  </head>
  <body>
    <!-- Modal -->
    <div class="modal fade" id="inputUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Pengguna</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="">
                  <div class="form-group">
                      <label for="nrp">NRP</label>
                      <input type="number" class="form-control" name="nrp" aria-describedby="nrp" placeholder="">
                      <small id="nrp" class="form-text text-muted">Masukan harus dalam bentuk angka.</small>
                  </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="">
                        <small id="name" class="form-text text-muted">Masukkan nama orang yang sudah dikenali.</small>
                    </div>
                    <div class="form-group">
                        <label for="ip">IP</label>
                        <input type="text" class="form-control" name="ip" aria-describedby="ip" placeholder="">
                        <small id="ip" class="form-text text-muted">Masukan harus dalam bentuk angka.</small>
                    </div>
                    <input type="submit" name="add" value="Submit" class="btn btn-outline-primary"/>
                    <input style="margin-left:5px" type="reset" name="batal" value="Batal" class="btn btn-outline-danger" data-dismiss="modal"/>
              </form>
              <?php
          	      if(isset($_POST['add'])&&!empty($_POST['ip'])&&!empty($_POST['name'])&&!empty($_POST['nrp']))//when button 'insert' is clicked
          				{
                    $name = $_POST['name']; //take data from form by using POST Method
                    $nrp = $_POST['nrp']; //take data from form by using POST Method
          					$ip = $_POST['ip'];
          					mysqli_query($conn, "INSERT INTO tb_user(ID, Name, IP) VALUES ('$nrp', '$name', '$ip')");
                    ?><script type="text/javascript">alert("DATA BERHASIL DITAMBAHKAN")</script><?php
          				}
        	    ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="inputIklan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>TAMBAH IKLAN</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
                  <div class="form-group">
                      <label for="nameiklan">Name</label>
                      <input type="text" class="form-control" name="nameiklan" aria-describedby="nameiklan" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="imgdir">Image direktori</label>
                      <input type="text" class="form-control" name="imgdir" aria-describedby="imgdir" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" aria-label="deskripsi"></textarea>
                  </div>
                  <input type="submit" name="addiklan" value="Submit" class="btn btn-outline-primary"/>
                  <input style="margin-left:5px" type="reset" name="batal" value="Batal" class="btn btn-outline-danger" data-dismiss="modal"/>
            </form>
              <?php
                  if(isset($_POST['addiklan'])&&!empty($_POST['nameiklan'])&&!empty($_POST['imgdir'])&&!empty($_POST['deskripsi']))//when button 'insert' is clicked
                  {
                    $nameiklan = $_POST['nameiklan']; //take data from form by using POST Method
                    $imgdir = $_POST['imgdir']; //take data from form by using POST Method
                    $deskripsi = $_POST['deskripsi'];
                    mysqli_query($conn, "INSERT INTO tb_directory(name, imgdir, description) VALUES ('$nameiklan', '$imgdir', '$deskripsi')");
                    ?><script type="text/javascript">alert("DATA BERHASIL DITAMBAHKAN")</script><?php
                  }
              ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <h3 style="margin-top:10px;"><b>IKLAN YANG SEDANG TAMPIL</b></h3>
      <div id="currentAds">
      </div>
      <!-- <img src="../direktoriiklan/ikea.jpg" id="imagepil" class="img-fluid rounded" alt="Responsive image"> -->
        <div style="margin:20px;"></div>
        <div class="row">
            <div class="col">
              <div class="row">
                  <div class="col-8">
                      <h3><b>Informasi Pengguna SABS</b></h3>
                  </div>
                  <div class="col-4">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#inputUser">Input user baru</button>
                  </div>
              </div>
              <table class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">NRP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">IP</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $querya = mysqli_query($conn, "SELECT * FROM tb_user");
                    while($row = mysqli_fetch_array($querya))
                    {
                      ?>
                      <tr>
                        <th scope="row"><?php echo $row['ID'];?></th>
                        <td><?php echo $row['Name'];?></td>
                        <td><?php echo $row['IP'];?></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-secondary">Edit</button>
                              <button type="button" class="btn btn-danger">Hapus</button>
                          </div>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
              </table>
            </div>

            <div class="col">
              <div class="row">
                  <div class="col-9">
                      <h3><b>List Iklan SABS</b></h3>
                  </div>
                  <div class="col-3">
                      <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#inputIklan">Input iklan</button>
                  </div>
              </div>
              <table class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama iklan</th>
                      <th scope="col">Direktori</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $querya = mysqli_query($conn, "SELECT * FROM tb_directory");
                        while($row = mysqli_fetch_array($querya))
                        {
                          ?>
                          <tr>
                            <th scope="row"><?php echo $row['id'];?></th>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['imgdir'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                  <button type="button" class="btn btn-secondary">Edit</button>
                                  <button type="button" class="btn btn-danger">Hapus</button>
                              </div>
                            </td>
                          </tr>
                          <?php
                        }
                    ?>
                  </tbody>
              </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript">
    function tampil(){
      $('#currentAds').load('../autoimageadmin.php');
    }
    var load = setInterval(tampil, 100);
    </script>
  </body>
</html>
