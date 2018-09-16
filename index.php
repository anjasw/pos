<?php include 'koneksi/konek.php'; 
session_start();
if (!isset($_SESSION['nama'])) {
  header('location:login.php');
} 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Point Of Sales</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <style media="screen">
      body {
        font-size: .875rem;
      }

      .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
      }

      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      }

      .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
      }

      @supports ((position: -webkit-sticky) or (position: sticky)) {
        .sidebar-sticky {
          position: -webkit-sticky;
          position: sticky;
        }
      }

      .sidebar .nav-link {
        font-weight: 500;
        color: #333;
      }

      .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #999;
      }

      .sidebar .nav-link.active {
        color: #007bff;
      }

      .sidebar .nav-link:hover .feather,
      .sidebar .nav-link.active .feather {
        color: inherit;
      }

      .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
      }

      [role="main"] {
        padding-top: 48px; /* Space for fixed navbar */
      }

      .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
      }

      .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
      }

      .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
      }

      .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Point Of Sales</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=barang">
                  <span data-feather="shopping-cart"></span>
                  Barang
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=detail+penjualan">
                  <span data-feather="file-text"></span>
                  Detail Penjualan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=penjualan">
                  <span data-feather="file"></span>
                  Penjualan
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <?php
          $page = (isset($_GET['page']))? $_GET['page'] : "barang";
          switch($page){
            case "penjualan" : include 'penjualan/index.php'; break;
            case "detail penjualan" : include 'detail/index.php'; break;
            case "barang" : include 'barang/index.php'; break;
          }
          ?>
        </main>
      </div>
    </div>
  </body>
</html>
