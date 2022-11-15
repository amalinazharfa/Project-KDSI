<?php
    session_start();
    require "functions.php";

    if (!isset($_SESSION["login"]) && !isset($_SESSION["alulogin"])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_SESSION["login"])) {
        $user = $_SESSION["username"];
    }

    elseif (isset($_SESSION["alulogin"])) {
        $user = $_SESSION["alunim"];
    }

    if(isset($_POST["gantipass"])) {
        $userSet = $_POST["username"];
        $password = $_POST["password"];
        $passwordBaru = $_POST["passwordBaru"]; 
        $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

        if (isset($_SESSION["login"])) {
            $admin = mysqli_query($conn, "SELECT * FROM user WHERE username = '$userSet'");
            $fetch = mysqli_fetch_assoc($admin);
            $fetch = test_input($fetch["password"]);

            if (password_verify($password, $fetch)) {
                $setPassBaru = mysqli_query($conn, "UPDATE user SET password = '$passwordBaru' WHERE username = '$userSet'");
                echo "<script>alert('Password berhasil diubah')</script>";
            }
            else {
                $error = true;
            }
        }

        elseif (isset($_SESSION["alulogin"])) {
            $alumni = mysqli_query($conn, "SELECT * FROM alu WHERE alunim = '$userSet'");
            $fetch = mysqli_fetch_assoc($alumni);
            $fetch = test_input($fetch["alupassword"]);

            if (password_verify($password, $fetch)) {
                $setPassBaru = mysqli_query($conn, "UPDATE alu SET alupassword = '$passwordBaru' WHERE alunim = '$userSet'");
                echo "<script>alert('Password berhasil diubah')</script>";
            }
            else {
                $error = true;
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
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap"
      rel="stylesheet"
    />

    <title>Sistem Informasi Alumni</title>
  </head>
  <body>
    <?php if (isset($error)) {
            echo "<script>alert('Password salah')</script>";
            }
        ?>
    <section class="pengaturan-akun">
      <div class="header">
        <h2 class="nama">Sistem Informasi Alumni</h2>
        <div class="navbar">
          <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="inputdata.php">Input Data</a></li>
            <li><a href="pencarian.php">Cari Alumni</a></li>
          </ul>
        </div>
        <div class="action">
          <div class="profile" onclick="menuToggle();">
            <img src="img/User_cicrle_light.svg" alt="" />
          </div>
          <div class="menu">
            <ul>
              <li>
                <a href="pengaturanakun.php">Pengaturan Akun</a>
              </li>
              <li class="last-list">
                <a href="local.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <script>
          function menuToggle() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
          }
        </script>
      </div>

      <div class="mid">
        <div class="akun-sidebar">
          <ul class="menu-list">
            <li class="menu-item"><a href="pengaturanakun.php">Informasi Akun</a></li>
            <li class="menu-item"><a href="gantipass.php">Ubah Password</a></li>
          </ul>
        </div>

        <div class="akun-info" id="">
          <div class="akun-info-judul">UBAH PASSWORD</div>
          <div class="akun-info-container">
            <form action="" method="post">
                <input type="hidden" name="username" value="<?= $user ?>">
                <div class="form-group">
                    <label class="form-label" for="showUsername">Username</label>
                    <input class="form-control" type="text" name="showUsername" value="<?= $user ?>" disabled required>
                </div>
                <br>
                <div class="form-group">        
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <br>
                <div class="form-group">        
                    <label class="form-label" for="passwordBaru">Password Baru</label>
                    <input class="form-control" type="password" name="passwordBaru">
                </div>
                <br>
                <button type="submit" class="btn btn-secondary" name="gantipass">Ganti Password</button>
            </form>
            </div>
          </div>
        </div>
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
    
