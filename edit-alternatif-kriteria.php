<?php
session_start();
include("koneksi.php");
require("header_login.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {
  mysqli_query($db, "UPDATE alternatif_kriteria SET id_alternatif='$_POST[id_alternatif]', id_kriteria='$_POST[id_kriteria]', nilai='$_POST[nilai]' WHERE id_alternatif_kriteria = '$_POST[id_alternatif_kriteria]'");
  header("location:alternatif-kriteria.php");
}

$queryalternatifkriteria = mysqli_query($db, "SELECT * FROM alternatif_kriteria WHERE id_alternatif_kriteria = '$_GET[id_alternatif_kriteria]'");
$dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria);
?>
<div class="justify-content-center">
  <form id="form1" name="form1" method="post" action="">

    <div class="col">
      <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-sm-5 mt-3">
          <label for="">

            ID Alternatif Kriteria
          </label>
          <input type="text" class="form-control" name="id_alternatif_kriteria" id="id_alternatif_kriteria" readonly value="<?php echo $dataalternatifkriteria['id_alternatif_kriteria']; ?>" />
          <label for="">
            Alternatif

          </label>
          <select class="custom-select mb-2" name="id_alternatif" id="id_alternatif">
            <option value=""></option>
            <?php
            $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
            while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
              ?>
              <option value="<?php echo $dataalternatif['id_alternatif']; ?>" <?php if ($dataalternatifkriteria['id_alternatif'] == $dataalternatif['id_alternatif']) {
                                                                                  echo " selected";
                                                                                } ?>><?php echo $dataalternatif['nama_alternatif']; ?></option>
            <?php
            }
            ?>
          </select>
          <label for="">

            Kriteria
          </label>
          <select class="custom-select mb-2" name="id_kriteria" id="id_kriteria">
            <option value=""></option>
            <?php
            $querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
            while ($datakriteria = mysqli_fetch_array($querykriteria)) {
              ?>
              <option value="<?php echo $datakriteria['id_kriteria']; ?>" <?php if ($dataalternatifkriteria['id_kriteria'] == $datakriteria['id_kriteria']) {
                                                                              echo " selected";
                                                                            } ?>><?php echo $datakriteria['nama_kriteria']; ?></option>
            <?php
            }
            ?>
          </select>

          Nilai
          <input type="text" class="form-control" name="nilai" id="nilai" value="<?php echo $dataalternatifkriteria['nilai']; ?>" />

          &nbsp;
          <input type="submit" class="btn btn-primary mt-4" name="button" id="button" value="Simpan" />

        </div>
      </div>
    </div>
  </form><?php require("footer.php") ?>
</div>