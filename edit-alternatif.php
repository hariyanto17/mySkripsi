<?php
session_start();
include("koneksi.php");
require("header_login.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {
  mysqli_query($db, "UPDATE alternatif SET nama_alternatif = '$_POST[nama_alternatif]', deskripsi = '$_POST[deskripsi]'  WHERE id_alternatif = '$_GET[id_alternatif]'");
  header("location:alternatif.php");
}
$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif WHERE id_alternatif = '$_GET[id_alternatif]'");
$dataalternatif = mysqli_fetch_array($queryalternatif);
?>
<br><br>
<h2 class="text-center" >Edit data Alternatif</h2><br><br>
<div class="row justify-content-center">

  <div class="col-lg-7">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Alternatif</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama_alternatif" id="nama_alternatif" value="<?php echo $dataalternatif['nama_alternatif']; ?>" />
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="deskripsi" cols="30" rows="4" id="deskripsi"><?php echo $dataalternatif['deskripsi']; ?></textarea>
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