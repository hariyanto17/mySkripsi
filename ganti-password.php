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
		$querylogin = mysqli_query($db, "SELECT * FROM login WHERE username = '$_POST[username]' AND password = '$_POST[lama]'");
		if ($datalogin = mysqli_fetch_array($querylogin))
		{
			if ($_POST['baru'] == $_POST['konfirmasi'])
			{
				mysqli_query($db, "UPDATE login SET password = '$_POST[baru]' WHERE username = '$_POST[username]'");
				header("location:admin.php");	
			}
			else
			{
				header("location:ganti-password.php?pesan=Password Baru Tidak Sama");
			}
		}
		else
		{
			header("location:ganti-password.php?pesan=Password Lama Salah");
		}
	}
?>


<div class="row justify-content-center">

  <div class="col-lg-7">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group">
                <input type="text" class="form-control form-control-user"  name="username" id="username" value="<?php echo $_SESSION['userlogin']; ?>" readonly />
                </div>
                <div class="form-group">
                <input type="password" class="form-control form-control-user" name="lama" id="lama"   placeholder="Password Lama"/>
                </div>
                <div class="form-group">
                <input type="password" class="form-control form-control-user" name="baru" id="baru"  placeholder="Password Baru" />
                </div>
                <div class="form-group">
                <input type="password" class="form-control form-control-user" name="konfirmasi" id="konfirmasi"  placeholder="Konfirmasi Password" />
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