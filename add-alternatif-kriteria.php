<?php
session_start();
include("koneksi.php");
require("header_login.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {

  mysqli_query($db, "INSERT INTO alternatif_kriteria(id_alternatif, id_kriteria, nilai) VALUES('$_POST[id_alternatif]', '1' , '$_POST[Populasi]')");
  mysqli_query($db, "INSERT INTO alternatif_kriteria(id_alternatif, id_kriteria, nilai) VALUES('$_POST[id_alternatif]', '2' , '$_POST[Umur]')");
  mysqli_query($db, "INSERT INTO alternatif_kriteria(id_alternatif, id_kriteria, nilai) VALUES('$_POST[id_alternatif]', '3' , '$_POST[Berat]')");
  mysqli_query($db, "INSERT INTO alternatif_kriteria(id_alternatif, id_kriteria, nilai) VALUES('$_POST[id_alternatif]', '4' , '$_POST[Kesehatan]')");

  header("location:alternatif-kriteria.php");
}
?>

<div class="justify-content-center">
  <form id="form1" name="form1" method="post" action="">

    <div class="col">
      <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-sm-5 mt-3">
          <label> Alternatif</label>
          <select class="custom-select mb-2" name="id_alternatif" id="id_alternatif">
            <option value=""></option>
            <?php
            $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
            while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
              ?>
              <option value="<?php echo $dataalternatif['id_alternatif']; ?>"><?php echo $dataalternatif['nama_alternatif']; ?></option>
            <?php
            }
            ?>
          </select>
          <div>
            <label for="">Populasi</label>
            <input type="text" class="form-control" id="name" name="Populasi" placeholder="Populasi">
          </div>
          <div>
            <label for="">Umur</label>
            <input type="text" class="form-control" id="name" name="Umur" placeholder="Umur">
          </div>
          <div>
            <label for="">Berat</label>
            <input type="text" class="form-control" id="name" name="Berat" placeholder="Berat">
          </div>
          <div>
            <label for="">Kesehatan</label>
            <input type="text" class="form-control" id="name" name="Kesehatan" placeholder="Kesehatan">
          </div>
          <div>
            <input type="submit" class="btn btn-primary mt-4" name="button" id="button" value="Simpan" />
          </div>
        </div>
      </div>

    </div>

  </form>
</div>