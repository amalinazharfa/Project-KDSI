<?php 
    session_start();

    require "functions.php";

    if(isset($_SESSION["alulogin"])) {
        header("Location: index.php");
        exit;
    }

    // jika ditekan jalankan regristasi
    if (isset($_POST["register"])) {
        if ($_POST["regtype"] == "regAdmin") {
            if (regristasi($_POST) > 0) {
                echo "<script>alert('Selamat data berhasil ditambahkan')</script>";
                echo "<script>window.location.href = 'login.php'</script>";
            }
            else {
                echo "<script>alert('Data gagal ditambahkan, cek inputan kembali')</script>";
            }
        }
        else if ($_POST["regtype"] == "regAlumni") {
            if (aluregristasi($_POST) > 0) {
                echo "<script>alert('Selamat data berhasil ditambahkan')</script>";
                echo "<script>window.location.href = 'login.php'</script>";
            }
            else {
                echo "<script>alert('Data gagal ditambahkan, cek inputan kembali')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="style.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap"
      rel="stylesheet"
    />

    <title>Sistem Informasi Alumni</title>
  </head>
  <body>
    <section class="signup d-flex">
      <div class="signup-left">
        <nav class="navbar">
          <h2 class="nama">Sistem Informasi Alumni</h2>
          <a class="cta" href="index.php""><button>Login</button></a>
        </nav>

        <div class="judul">
          <h1>Registrasi</h1>
        </div>

        <div class="signup-form">
          <form action="" method="post" autocomplete="off">
            <label for="username" class="form-label"></label>
            <input
              type="text"
              class="form-control"
              id="username"
              placeholder="Username (Gunakan NIM jika mendaftar sebagai alumni/user)"
              name="username"
            />

            <label for="password" class="form-label"></label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Password"
              name="password"
            />
            <!-- <span>
              <i class="eye-slash" id="togglePassword">
                <img src="img/View_hide_light.svg" alt="" />
              </i>
            </span> -->

            <label for="confirm-password" class="form-label"></label>
            <input
              type="password"
              class="form-control"
              id="confirm-password"
              placeholder="Konfirmasi Password"
              name="konpassword"
            />
            <!-- <span>
              <i class="eye-slash" id="togglePassword">
                <img src="img/View_hide_light.svg" alt="" />
              </i>
            </span> -->
            <div class="mt-4">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="regtype" value="regAdmin" checked>
                <label class="form-check-label" for="regAdmin">Admin</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="regtype" value="regAlumni">
                <label class="form-check-label" for="regAlumni">Alumni</label>
              </div>
            </div>
            <a class="signup" href="#"><button type="submit" name="register">Sign Up</button></a>
        </form>
          
        </div>
      </div>
      <div class="signup-right">
        <img src="img/undraw_personal_info_re_ur1n.svg" alt="">
      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
