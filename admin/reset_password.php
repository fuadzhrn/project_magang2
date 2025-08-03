<!-- reset_password.php -->
 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="post" action="proses_reset.php">
  <div class="text-center mb-4">
    <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
    <p>Masukkan username, password lama, dan password baru</p>
  </div>

  <div class="form-label-group">
    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="username">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="old_password" class="form-control" placeholder="Password Lama" required>
    <label for="old_password">Password Lama</label>
  </div>

  <div class="form-label-group">
  <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Password Baru" required>
<label for="new_password">Password Baru</label>

    <label for="new_password">Password Baru</label>
  </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2025 | Fuad | UNM</p>
    </form>
  </body>
</html>
