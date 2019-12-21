<?php
	session_start();
  include("koneksi.php");
  require('header_login.php');
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
	if (isset($_POST['button']))
	{
		mysqli_query($db, "INSERT INTO kriteria(nama_kriteria, bobot) VALUES('$_POST[nama_kriteria]', '$_POST[bobot]')");
		header("location:kriteria.php");
	}
?>

<br><br>
<h2 class="text-center">Tambah Data Kriteria</h2>
<br><br>
<div class="row justify-content-center">

<div class="col-lg-7">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Tambah Kriteria</h1>
            </div>
            <form class="user" method="post">
              <div class="form-group">
              <input type="text" class="form-control form-control-user" name="nama_kriteria" id="nama_kriteria"  placeholder="Nama Kriteiria"/>
              </div>
              <div class="form-group">
              <input type="text" class="form-control form-control-user" name="bobot" id="bobot" placeholder="Bobot" />
              </div>
              <input type="submit" class="btn btn-primary btn-user btn-block" name="button" id="button" value="Simpan">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>

      <?php require("footer.php");?>