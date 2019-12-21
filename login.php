<?php
include("koneksi.php");
require('header.php');
if (isset($_POST['button'])) {
  $querylogin = mysqli_query($db, "SELECT * FROM login WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
  if ($datalogin = mysqli_fetch_array($querylogin)) {
    session_start();
    $_SESSION['userlogin'] = $datalogin['username'];
    header("location:admin.php");
  } else {
    header("location:login.php?pesan=Login Gagal");
  }
}
?>




<!-- Outer Row -->
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
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" name="button" id="button" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>



<?php
require('footer.php')
?>