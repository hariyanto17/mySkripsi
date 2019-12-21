<?php
session_start();
include("koneksi.php");
require("header_login.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
?>
<br><br>
<h2 class= "text-center">Data Alternatif</h2>
<br><br>
<table class="table table-hover">
  <tr>
    <td scope="col">No</td>
    <td scope="col">Nama Alternatif Produk</td>
    <td scope="col">Deskripsi</td>
    <td scope="col"><a class="badge badge-pill badge-primary" href="add-alternatif.php">Add</a></td>
  </tr>
  <?php
  $i = 1;
  $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
  while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
    ?>
    <tr>
      <th scope="row"><?php echo $i++; ?></th>
      <th><?php echo $dataalternatif['nama_alternatif']; ?></th>
      <th><?php echo $dataalternatif['deskripsi']; ?></th>
      <th><a class="badge badge-pill badge-success" href="edit-alternatif.php?id_alternatif=<?php echo $dataalternatif['id_alternatif']; ?>">Edit</a> <a class="badge badge-pill badge-danger" href="del-alternatif.php?id_alternatif=<?php echo $dataalternatif['id_alternatif']; ?>">Del</a></th>
    </tr>
  <?php
  }
  ?>
</table>
</div>
<?php require("footer.php");
?>