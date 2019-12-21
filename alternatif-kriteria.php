<?php
session_start();
include("koneksi.php");
require("header_login.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
?>

<table class="table table-hover">
  <tr>
    <td scope="col">No</td>
    <td scope="col">Nama Alternatif</td>
    <td scope="col">Nama Kriteria</td>
    <td scope="col">Nilai</td>
    <td scope="col"><a class="badge badge-pill badge-primary" href="add-alternatif-kriteria.php">Add</a></td>
  </tr>
  <?php
  $i = 1;
  $queryalternatifkriteria = mysqli_query($db, "SELECT * FROM alternatif_kriteria ORDER BY id_alternatif, id_kriteria");
  while ($dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria)) {
    $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif WHERE id_alternatif = '$dataalternatifkriteria[id_alternatif]'");
    $dataalternatif = mysqli_fetch_array($queryalternatif);
    $querykriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE id_kriteria = '$dataalternatifkriteria[id_kriteria]'");
    $datakriteria = mysqli_fetch_array($querykriteria);
    ?>
    <tr scope="row">
      <td><?php echo $i++; ?></td>
      <td><?php echo $dataalternatif['nama_alternatif']; ?></td>
      <td><?php echo $datakriteria['nama_kriteria']; ?></td>
      <td><?php echo $dataalternatifkriteria['nilai']; ?></td>
      <td><a class="badge badge-pill badge-success" href="edit-alternatif-kriteria.php?id_alternatif_kriteria=<?php echo $dataalternatifkriteria['id_alternatif_kriteria']; ?>">Edit</a> <a class="badge badge-pill badge-danger" href="del-alternatif-kriteria.php?id_alternatif_kriteria=<?php echo $dataalternatifkriteria['id_alternatif_kriteria']; ?>">Del</a></td>
    </tr>
  <?php
  }
  ?>
</table>







<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col" rowspan="2">No</th>
      <th scope="col" rowspan="2">Nama Alternatif</th>
      <?php
      $querykriteria = mysqli_query($db, "SELECT * FROM kriteria order by id_kriteria"); ?>
      <th scope="col" colspan=" mysqli_num_rows $querykriteria">Kriteria</th>
    <tr>
      <?php
      while ($datakriteria = mysqli_fetch_array($querykriteria)) {

        ?>
        <th scope="col"><?= $datakriteria['nama_kriteria'] ?></th>
      <?php } ?>
    </tr>
    </tr>
  </thead>
  <tr scope="row">
    <?php

    $i = 1;
    $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
    while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {

      $populasi = mysqli_query($db, "SELECT * FROM alternatif_kriteria  
      WHERE id_kriteria = 1  ");

      ?>


      <td><?php echo $i++; ?></td>
      <td><?php echo $dataalternatif['nama_alternatif']; ?></td>
  </tr>
<?php }  ?>


</table>

<?php require("footer.php"); ?>