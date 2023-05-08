<?php
$login_error = 25;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST["email"], $_POST["password"])) {
	
		include("classes/Database.php");
        $d = new Database();
		
		$d->query("SELECT id, password FROM user WHERE email = :email");
		$d->bind(":email", $_POST["email"]);
		if ($account = $d->single()) {
            //echo password_hash($_POST["password"] . $_POST["e-mail"], PASSWORD_ARGON2ID);

			if (password_verify($_POST["password"] . $_POST["email"], $account["password"])) {
				$id = $account["id"];

					$token = hash("sha256", $id . time());
					$ip_bin = inet_pton($_SERVER["REMOTE_ADDR"]);

					$d->query("DELETE FROM user_cookie WHERE user = :id");
                    $d->bind(":id", $id);
                    $d->execute();


					$d->query("INSERT INTO user_cookie (user, token, ip) VALUES (:a, :token, :ip)");
					$d->bind(":a", $id);
					$d->bind(":token", $token);
					$d->bind(":ip", $ip_bin);
					$d->execute();
					
					$d->query("UPDATE user SET ip = :ip WHERE id = :id");
					$d->bind(":ip", $ip_bin);
					$d->bind(":id", $id);
					$d->execute();
                    $login_error = 0;
					//echo "<script> setCookie('Account', '$token', '/nocvedcu/admin/'); </script>";
                    setcookie("Account", $token);
                    header("Location: /nocvedcu/admin");
				
			} else {
				$login_error = 2;
			}
		} else {
			$login_error = 1;
		}
        $login_error = 8;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Přihlášení</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control"  name="password" placeholder="Heslo">
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Přihlásit">
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>