<?php
require("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SPK ELECTRE</title>

	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php">Fuzzy Electre</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>


			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="konsultasi-electre-php-mysql.php">Hasil Keputusan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.php">Login</a>
					</li>
			</div>
		</nav>
		<h4 class="text-center">Analisa Menggunakan SPK Metode Fuzzy Electre</h4><br />
		<br />
		<?php
		if (!isset($_POST['bottom'])) {
			?>
			<div class="container">
				<form name="form1" method="post" action=""><br>
					<table class="table table-hover">
						<div class="form-group">
							<div class="row">

								<tr>
									<td id="ignore" colspan="2">
										<div class="text-center">
											<strong>
												<font face="Arial, Helvetica, sans-serif">
													<font>BOBOT KRITERIA</font>
												</font>
											</strong>
										</div>

									</td>
								</tr>
								<?php
									$q = mysqli_query($db, "select * from kriteria ORDER BY id_kriteria");
									while ($r = mysqli_fetch_array($q)) {
										?>
									<tr>
										<td>
											<?php echo $r['nama_kriteria']; ?>
										</td>
										<td>
											<input class="form-control" id="bobot<?php echo $r['id_kriteria']; ?>" name="bobot<?php echo $r['id_kriteria']; ?>" type="text" value="<?php echo $r['bobot']; ?>">
										</td>
									</tr>
							</div>
						</div>
					<?php } ?>
					</table>
					<br />
					<table class="table table-hover">
						<tr>
							<td id="ignore" colspan="2">
								<div class=text-center><strong>
										<font face="Arial, Helvetica, sans-serif">
											<font>PILIH ALTERNATIF</font>
										</font>
									</strong></div>
							</td>
							<?php
								$q = mysqli_query($db, "select * from alternatif ORDER BY id_alternatif");
								while ($r = mysqli_fetch_array($q)) {
									?>
						<tr>
							<td>
								<div class="form-check">
									<input class="form-check-input" id="alternatif<?php echo $r['id_alternatif']; ?>" name="alternatif<?php echo $r['id_alternatif']; ?>" type="checkbox" value="true" checked>
								</div>
							</td>
							<td>
								<?php echo $r['nama_alternatif']; ?>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2">

							<form method='post'>
								<select class="custom-select mb-2 " name="harga">
									<option value="naik">Naik</option>
									<option value="turun">Turun</option>
								</select>

								<input class="btn btn-primary btn-lg btn-block" type="submit" name="bottom" value="Proses">
						</td>
					</tr>
					</table>
					<br>
				</form>

			</div>
		<?php
		} else {
			?>
			<div id="perhitungan">
				<?php
					function tampiltabel($arr)
					{
						echo '<div class="container-fluid">';
						echo '<table class="table table-hover table-bordered" >';
						for ($i = 0; $i < count($arr); $i++) {
							echo '<tr>';
							for ($j = 0; $j < count($arr[$i]); $j++) {
								echo '<td>' . $arr[$i][$j] . '</td>';
							}
							echo '</tr>';
						}
						echo '</table>';
						echo '</div>';
					}

					function tampilbaris($arr)
					{
						echo '<table class="table table-hover table-bordered" >';
						echo '<tr>';
						for ($i = 0; $i < count($arr); $i++) {
							echo '<td>' . $arr[$i] . '</td>';
						}
						echo "</tr>";
						echo '</table>';
					}

					function tampilkolom($arr)
					{
						echo '<table class="table table-hover table-bordered" >';
						for ($i = 0; $i < count($arr); $i++) {
							echo '<tr>';
							echo '<td>' . $arr[$i] . '</td>';
							echo "</tr>";
						}
						echo '</table>';
					}

					$alternatif = array();

					$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
					$i = 0;
					while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
						if (@$_POST['alternatif' . $dataalternatif['id_alternatif']] == "true") {
							$alternatif[$i] = $dataalternatif['nama_alternatif'];
							$i++;
						}
					}

					$kriteria = array();
					$bobot = array();

					$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
					$i = 0;
					while ($datakriteria = mysqli_fetch_array($querykriteria)) {
						$kriteria[$i] = $datakriteria['nama_kriteria'];
						$bobot[$i] = @$_POST['bobot' . $datakriteria['id_kriteria']]; //$datakriteria['bobot'];
						$i++;
					}

					$alternatifkriteria = array();
					$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
					$i = 0;
					while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
						if (@$_POST['alternatif' . $dataalternatif['id_alternatif']] == "true") {
							$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
							$j = 0;
							while ($datakriteria = mysqli_fetch_array($querykriteria)) {
								$queryalternatifkriteria = mysqli_query($db, "SELECT * FROM alternatif_kriteria WHERE id_alternatif = '$dataalternatif[id_alternatif]' AND id_kriteria = '$datakriteria[id_kriteria]'");
								$dataalternatifkriteria = mysqli_fetch_array($queryalternatifkriteria);

								$alternatifkriteria[$i][$j] = $dataalternatifkriteria['nilai'];
								$j++;
							}
							$i++;
						}
					}



					$fnaik = array();
					$fturun = array();
					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = 0; $j < count($kriteria); $j++) {
							if ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][0]) {
								$y = 4000;
								$a = 2000;
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][1]) {
								$y = 40;
								$a = 32;
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][2]) {
								$y = 2.7;
								$a = 1.0;
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][3]) {
								$y = 1;
								$a = 0;
							} else {
								$y = "ERROR";
							}

							$b = ($a + $y) / 2;

							if ($alternatifkriteria[$i][$j] <= $a) {
								$fnaik[$i][$j] = 0;
							} elseif ($alternatifkriteria[$i][$j] > $a && $alternatifkriteria[$i][$j] <= $b) {
								$fnaik[$i][$j] = round(2 * pow(($alternatifkriteria[$i][$j] - $a) / ($y - $a), 2), 3);
							} elseif ($alternatifkriteria[$i][$j] >= $b && $alternatifkriteria[$i][$j] < $y) {
								$fnaik[$i][$j] = round(1 - (2 * pow(($y - $alternatifkriteria[$i][$j]) / ($y - $a), 2)), 3);
							} elseif ($alternatifkriteria[$i][$j] >= $y) {
								$fnaik[$i][$j] = 1;
							} else {
								$fnaik[$i][$j] = "ERROR";
							}

							if ($alternatifkriteria[$i][$j] <= $a) {
								$fturun[$i][$j] = 1;
							} elseif ($alternatifkriteria[$i][$j] > $a && $alternatifkriteria[$i][$j] <= $b) {
								$fturun[$i][$j] = round(1 - (2 * pow(($alternatifkriteria[$i][$j] - $a) / ($y - $a), 2)), 3);
							} elseif ($alternatifkriteria[$i][$j] >= $b && $alternatifkriteria[$i][$j] < $y) {
								$fturun[$i][$j] = round(2 * pow(($y - $alternatifkriteria[$i][$j]) / ($y - $a), 2), 3);
							} elseif ($alternatifkriteria[$i][$j] >= $y) {
								$fturun[$i][$j] = 0;
							} else {
								$fturun[$i][$j] = "ERROR";
							}
						}
					}

					$fuzzyfikasi = array();
					$harga = $_POST['harga'];
					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = 0; $j < count($kriteria); $j++) {
							if ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][0]) {
								if ($harga == "naik") {
									$fuzzyfikasi[$i][$j] = $fnaik[$i][$j];
								} else {
									$fuzzyfikasi[$i][$j] = $fnaik[$i][$j];
								}
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][1]) {
								if ($harga == "naik") {
									$fuzzyfikasi[$i][$j] = $fturun[$i][$j];
								} else {
									$fuzzyfikasi[$i][$j] = $fnaik[$i][$j];
								}
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][2]) {
								if ($harga == "naik") {
									$fuzzyfikasi[$i][$j] = $fturun[$i][$j];
								} else {
									$fuzzyfikasi[$i][$j] = $fnaik[$i][$j];
								}
							} elseif ($alternatifkriteria[$i][$j] == $alternatifkriteria[$i][3]) {
								if ($harga == "naik") {
									$fuzzyfikasi[$i][$j] = $fturun[$i][$j];
								} else {
									$fuzzyfikasi[$i][$j] = $fnaik[$i][$j];
								}
							}
						}
					}


					$pembagi = array();
					for ($i = 0; $i < count($kriteria); $i++) {
						$pembagi[$i] = 0;
						for ($j = 0; $j < count($alternatif); $j++) {
							$pembagi[$i] = $pembagi[$i] + ($fuzzyfikasi[$j][$i] * $fuzzyfikasi[$j][$i]);
						}
						$pembagi[$i] = round(sqrt($pembagi[$i]), 3);
					}

					$normalisasi = array();

					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = 0; $j < count($kriteria); $j++) {
							$normalisasi[$i][$j] = round($fuzzyfikasi[$i][$j] / $pembagi[$j], 3);
						}
					}

					$V = array();

					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = 0; $j < count($kriteria); $j++) {
							$V[$i][$j] = round($normalisasi[$i][$j] * $bobot[$j], 3);
						}
					}

					$concordance = array();
					$disordance = array();

					$matriks_concordance = array();
					$matriks_disordance = array();
					$maks_disordance = array();
					$maks_pembagi_disordance = array();

					$treshold_matriks_concordance = 0;
					$treshold_matriks_disordance = 0;

					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = 0; $j < count($alternatif); $j++) {
							$concordance[$i][$j] = "";
							$disordance[$i][$j] = "";

							$matriks_concordance[$i][$j] = "";
							$matriks_disordance[$i][$j] = "";
							$maks_disordance[$i][$j] = 0;
							$maks_pembagi_disordance[$i][$j] = 0;

							if ($i != $j) {
								$matriks_concordance[$i][$j] = 0;
								$matriks_disordance[$i][$j] = 0;

								for ($k = 0; $k < count($kriteria); $k++) {
									if ($V[$i][$k] >= $V[$j][$k]) {
										if ($concordance[$i][$j] == "") {
											$concordance[$i][$j] = $concordance[$i][$j] . ($k + 1);
										} else {
											$concordance[$i][$j] = $concordance[$i][$j] . "," . ($k + 1);
										}
										$matriks_concordance[$i][$j] = $matriks_concordance[$i][$j] + $bobot[$k];
									}
									if ($V[$i][$k] < $V[$j][$k]) {
										if ($disordance[$i][$j] == "") {
											$disordance[$i][$j] = $disordance[$i][$j] . ($k + 1);
										} else {
											$disordance[$i][$j] = $disordance[$i][$j] . "," . ($k + 1);
										}
										$maks_disordance[$i][$j] = max($maks_disordance[$i][$j], abs($V[$i][$k] - $V[$j][$k]));
									}
									$maks_pembagi_disordance[$i][$j] = max($maks_pembagi_disordance[$i][$j], abs($V[$i][$k] - $V[$j][$k]));
								}
								$matriks_disordance[$i][$j] = round($maks_disordance[$i][$j] / $maks_pembagi_disordance[$i][$j], 3);

								$treshold_matriks_concordance = $treshold_matriks_concordance + $matriks_concordance[$i][$j];
								$treshold_matriks_disordance = $treshold_matriks_disordance + $matriks_disordance[$i][$j];
							}
						}
					}

					$treshold_matriks_concordance = round($treshold_matriks_concordance / (count($alternatif) * (count($alternatif) - 1)), 3);
					$treshold_matriks_disordance = round($treshold_matriks_disordance / (count($alternatif) * (count($alternatif) - 1)), 3);

					$matriks_dominan_concordance = array();
					$matriks_dominan_disordance = array();
					$agregate_dominance_matrix = array();

					$jml_nilai_1 = array();

					for ($i = 0; $i < count($alternatif); $i++) {
						$jml_nilai_1[$i] = 0;

						for ($j = 0; $j < count($alternatif); $j++) {
							$matriks_dominan_concordance[$i][$j] = "";
							$matriks_dominan_disordance[$i][$j] = "";
							$agregate_dominance_matrix[$i][$j] = "";
							if ($i != $j) {
								$matriks_dominan_concordance[$i][$j] = 0;
								$matriks_dominan_disordance[$i][$j] = 0;
								$agregate_dominance_matrix[$i][$j] = 0;

								if ($matriks_concordance[$i][$j] >= $treshold_matriks_concordance) {
									$matriks_dominan_concordance[$i][$j] = 1;
								}
								if ($matriks_disordance[$i][$j] >= $treshold_matriks_disordance) {
									$matriks_dominan_disordance[$i][$j] = 1;
								}

								$agregate_dominance_matrix[$i][$j] = $matriks_dominan_concordance[$i][$j] * $matriks_dominan_disordance[$i][$j];

								if ($agregate_dominance_matrix[$i][$j] >= 1) {
									$jml_nilai_1[$i] = $jml_nilai_1[$i] + 1;
								}
							}
						}
					}

					for ($i = 0; $i < count($alternatif); $i++) {
						$jml_nilai_1_rangking[$i] = $jml_nilai_1[$i];
						$alternatif_rangking[$i] = $alternatif[$i];
					}

					for ($i = 0; $i < count($alternatif); $i++) {
						for ($j = $i; $j < count($alternatif); $j++) {
							if ($jml_nilai_1_rangking[$i] < $jml_nilai_1_rangking[$j]) {
								$tmp_jml_nilai_1_rangking = $jml_nilai_1_rangking[$i];
								$tmp_alternatif = $alternatif_rangking[$i];
								$jml_nilai_1_rangking[$i] = $jml_nilai_1_rangking[$j];
								$alternatif_rangking[$i] = $alternatif_rangking[$j];
								$jml_nilai_1_rangking[$j] = $tmp_jml_nilai_1_rangking;
								$alternatif_rangking[$j] = $tmp_alternatif;
							}
						}
					}
					?>
				<br />
				<div class="text-center">
					alternatif =
					<?php tampilbaris($alternatif); ?>
					<br />
					kriteria =
					<?php tampilbaris($kriteria); ?>
					<br />
					bobot (w) =
					<?php tampilbaris($bobot); ?>
					<br />
					data nilai alternatifkriteria (x) =
					<?php tampiltabel($alternatifkriteria); ?>
					<br />
					data nilai fuzzyfikasi =
					<?php tampiltabel($fuzzyfikasi); ?>
					<br />
					pembagi =
					<?php tampilbaris($pembagi); ?>
					<br />
					matriks normalisasi (R)=
					<?php tampiltabel($normalisasi); ?>
					<br />
					matriks V =
					<?php tampiltabel($V); ?>
					<br />
					concordance =
					<div class=" table-responsive">
						<?php tampiltabel($concordance); ?>
					</div>
					<br />
					matriks concordance =
					<div class=" table-responsive">
						<?php tampiltabel($matriks_concordance); ?>
					</div>
					<br />
					disordance =
					<div class=" table-responsive">
						<?php tampiltabel($disordance); ?>
					</div>
					<br />
					matriks disordance =
					<div class=" table-responsive">
						<?php tampiltabel($matriks_disordance); ?>
					</div>
					<br />
					treshold matriks concordance =
					<?php echo $treshold_matriks_concordance; ?>
					<br />
					treshold matriks disordance =
					<?php echo $treshold_matriks_disordance; ?>
					<br />
					<br />
					matriks dominan concordance (F) =
					<?php tampiltabel($matriks_dominan_concordance); ?>
					<br />
					matriks dominan disordance (G) =
					<?php tampiltabel($matriks_dominan_disordance); ?>
					<br />
					agregate dominance matrix E
					<?php tampiltabel($agregate_dominance_matrix); ?>
				</div>
				<?php
					echo "<br/>";
					echo '<table  class="table table-hover">';
					echo "<tr>";
					echo "<td>Alternatif</td>";
					echo "<td>Jumlah Nilai 1</td>";
					echo "</tr>";
					for ($i = 0; $i < count($alternatif); $i++) {
						echo "<tr>";
						echo "<td>" . $alternatif[$i] . "</td>";
						echo "<td>" . $jml_nilai_1[$i] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					?>
			</div>
			<br />
			<input class="btn btn-primary btn-lg btn-block" type="button" value="Perhitungan" />
			<br />
			<br />
			<table class="table table-hover">
				<tr>
					<td>Ranking</td>
					<td>Alternatif</td>
					<td>Nilai</td>
				</tr>
				<?php
					for ($i = 0; $i < count($alternatif_rangking); $i++) {
						?>
					<tr>
						<td><?php echo ($i + 1); ?></td>
						<td><?php echo $alternatif_rangking[$i]; ?></td>
						<td><?php echo $jml_nilai_1_rangking[$i]; ?></td>
					</tr>
				<?php
					}
					?>
			</table>
			<br />
			<br />
			<h2 class="text-center">
				Alternatif Produk Terbaik saat harga <?= $harga ?> = <?php echo $alternatif_rangking[0]; ?> dengan Jumlah Nilai 1 Terbanyak = <?php echo $jml_nilai_1_rangking[0]; ?>
			</h2>
			<br />
		<?php
		}
		?>
		<br />
		</td>
	</div>
	<tr>
		<div class="text-center">
			<p>&copy; hariyanto</p>
			<a href="https://www.facebook.com/wancacell">Kontak</a>
		</div>
	</tr>
	</table>
</body>

</html>