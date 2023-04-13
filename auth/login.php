<?php
require '../lib/header.php';
$config = require '../lib/config.php';

$error = '';
if (isset($_POST['username'])) {
  if (validate($_POST, [
    'username' => 'required',
    'password' => 'required',
  ])) {
    $user = DB::queryFirstRow("SELECT * FROM user WHERE UserName = %s AND Password = %s", $_POST['username'], sha1($_POST['password']));

    if ($user) {
      $_SESSION['user'] = $user;
      log_message("{$_SESSION['user']['UserName']} has logged in.");
      if (isset($_GET['r']) && $_GET['r']) {
        header('location: ' . $_GET['r']);
      } else {
        header('location: /');
      }
      exit;
    } else {
      $_SESSION['error'] = 'Invalid username and/or password.';
    }
  }
}
?>
<style>
  .bg-image {
    /* The image used */
    background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url("https://source.unsplash.com/random?computer") no-repeat;

    /* Add the blur effect */
    filter: blur(3px);
    -webkit-filter: blur(3px);

    /* Full height */
    height: 100%;
    width: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: absolute;
    top: 0;
    left: 0;
  }
  .error > .container {
    padding: 0;
  }
</style>
<div class="bg-image"></div>
<div class="h-100">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col col-md-6 offset-md-3">
        <div class="error">
          <?php display_message(); ?>
        </div>
        <div class="card mb-4">
          <h5 class="card-header">
            <?= $config['name'] ?>
          </h5>
          <div class="card-body">
            <h1 class="display-5 text-center mb-3">Login</h1>
            <form method="POST">
              <div class="mb-3 form-floating">
                <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?= $_POST['username'] ?>">
                <label for="floatingInput">Username</label>
              </div>
              <div class="mb-3 form-floating">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>

              <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="return validateUserNameandPassWord()">Sign in</button>
            </form>
          </div>
        </div>
        <p class="text-center text-muted">&copy; <?= date('Y') ?> <?= $config['company'] ?></p>
      </div>
    </div>
  </div>
</div>
<?php require '../lib/footer.php'; ?>