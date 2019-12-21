<?php
	session_start();
  include("koneksi.php");
  require("header_login.php");
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
	if (isset($_POST['button']))
	{
		mysqli_query($db, "UPDATE kriteria SET nama_kriteria='$_POST[nama_kriteria]', bobot='$_POST[bobot]' WHERE id_kriteria='$_GET[id_kriteria]'");
		header("location:kriteria.php");
	}

			$querykriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE id_kriteria = '$_GET[id_kriteria]'");
			$datakriteria = mysqli_fetch_array($querykriteria);
    ?>
    
    <br><br>
<h2 class="text-center" >Edit data Kriteria</h2><br><br>
<div class="row justify-content-center">

  <div class="col-lg-7">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Kriteria</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group">
                <input type="text"  class="form-control form-control-user" name="nama_kriteria" id="nama_kriteria" value="<?php echo $datakriteria['nama_kriteria']; ?>" />
                </div>
                <div class="form-group">
                <input type="text"  class="form-control form-control-user" name="bobot" id="bobot" value="<?php echo $datakriteria['bobot']; ?>" />
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



      <?php require("footer.php")?>