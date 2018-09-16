<?php
session_start();
if (isset($_SESSION['nama'])) {
  header('location:index.php');
} 
$konek = mysqli_connect('localhost','anjasw','anjasganteng','db_point_of_sales');
if (isset($_POST['pencet'])) {
  //echo $_POST['inputUsername'];
  //echo $_POST['inputPassword'];
  $cek = mysqli_query($konek,"SELECT * FROM authentikasi WHERE email = '".$_POST['email']."' AND password = '".md5($_POST['password'])."'");
  foreach ($cek as $data) {
    if(count($data) > 0){
      session_start();
      $_SESSION['nama'] = $data['nama'];
      header('location:index.php');
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style media="screen">
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #ffffff;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-3">
          <form class="form-signin" action="" method="post">
            <!--<img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            --><h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>

            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="pencet">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
          </form>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
