<?php
	session_start();
  include("koneksi.php");
  require("header_login.php");
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
?>
<br><br>
<h2 class= "text-center">Data Kriteria</h2>
<br><br>
<table class="table table-hover">
        <tr>
          <td>No</td>
          <td >Nama Kriteria</td>
          <td >Bobot</td>
          <td ><p>Aktion</p></td>
        </tr>
        <?php
			$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
			while ($datakriteria = mysqli_fetch_array($querykriteria))
			{
		?>
        <tr>
          <td><?php echo $datakriteria['id_kriteria']; ?></td>
          <td><?php echo $datakriteria['nama_kriteria']; ?></td>
          <td><?php echo $datakriteria['bobot']; ?></td>
          <td><a class="badge badge-pill badge-success" href="edit-kriteria.php?id_kriteria=<?php echo $datakriteria['id_kriteria']; ?>">Edit</a> <a class="badge badge-pill badge-danger" href="del-kriteria.php?id_kriteria=<?php echo $datakriteria['id_kriteria']; ?>">Del</a></td>
        </tr>
        <?php
			}
		?>
      </table>
<?php
require("footer.php");
?>