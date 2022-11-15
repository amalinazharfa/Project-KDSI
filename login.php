<?php
    session_start();

    require "functions.php";

    if(isset($_SESSION["login"]) && !isset($_SESSION["alulogin"]) || !isset($_SESSION["login"]) && isset($_SESSION["alulogin"])) {
        header("Location: index.php");
        exit;
    }

    // cek cookie
    if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];

        // ambil username berdasarkan id
        $resultAdmin = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $resultAlumni = mysqli_query($conn, "SELECT alunim FROM alu WHERE id = $id");
        
        if (isset($resultAdmin)) {
            $row = mysqli_fetch_assoc($resultAdmin);
            // cek cookie username
            if($key === hash('sha256', $row['username'])) {
                $_SESSION["login"] = true;
            }
        }

        elseif (isset($resultAlumni)) {
            $row = mysqli_fetch_assoc($resultAlumni);
            // cek cookie alunim
            if($key === hash('sha256', $row['alunim'])) {
                $_SESSION["alulogin"] = true;
            }
        }
    }

    // cek apa tombol submit sudah ditekan atau belum
    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // cek username apa ada di databse

        $rAdmin = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        $rAlumni = mysqli_query($conn, "SELECT alunim FROM alu WHERE alunim = '$username'");

        $resultAdmin = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $resultAlumni = mysqli_query($conn, "SELECT * FROM alu WHERE alunim = '$username'");    
        
        if (mysqli_fetch_assoc($rAdmin)) {
             // cek apa username ada
            if(mysqli_num_rows($resultAdmin) === 1) {
                // check password
                $row = mysqli_fetch_assoc($resultAdmin);
                if (password_verify($password, $row["password"])) {
                    // set session
                    $_SESSION["login"] = true;
                    foreach($resultAdmin as $assa) {
                        $_SESSION["username"] = $assa['username'];
                    }
                    // remember me
                    if (isset($_POST["remember"])) {
                        // buat cookie
                        setcookie("id", $row['id'], time() + 60);
                        // mengacak username menggunakan hash
                        // algoritma + string
                        setcookie("key", hash('sha256', $row['username']), time() + 60);
                    }
                    header("Location: index.php");
                    exit;
                }
            }
        }

        elseif (mysqli_fetch_assoc($rAlumni)) {
            // cek apa alunim ada
            if(mysqli_num_rows($resultAlumni) === 1) {
                // check password
                $row = mysqli_fetch_assoc($resultAlumni);
                if (password_verify($password, $row["alupassword"])) {
                     // set session
                    $_SESSION["alulogin"] = true;
                    foreach($resultAlumni as $assa) {
                        $_SESSION["alunim"] = $assa['alunim'];
                    }
                    // remember me
                    if (isset($_POST["remember"])) {
                        // buat cookie
                        setcookie("id", $row['id'], time() + 60);
                        // mengacak alunim menggunakan hash
                        // algoritma + string
                        setcookie("key", hash('sha256', $row['alunim']), time() + 60);
                    }
                    header("Location: ganti.php");
                    exit;
                }
            }
        }
        $error = true;
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
    <?php if(isset($error)) : ?>
      <?php $message = "Terdapat Kesalahan Pengisian Username atau Password";?>
      <?php echo "<script type='text/javascript'>alert('$message');</script>"?>
      <?php endif;?>
    <section class="login d-flex">
      <div class="login-left">
        <nav class="navbar">
          <h2 class="nama">Sistem Informasi Alumni</h2>
          <a class="cta" href="signup.php"><button>Sign Up</button></a>
        </nav>

        <div class="judul">
          <h1>LOGIN</h1>
        </div>
        
        <div class="login-form" >
          <form action="" method="POST">
            <label for="username" class="form-label"></label>
            <input
              type="text"
              class="form-control"
              id="username"
              placeholder="Username"
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

            <div class="mt-4">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <a class="login" href=""><button type="submit" name="login">Login</button></a>
          </form>
          
        </div>
      </div>
      <div class="login-right">
        <img src="img/undraw_authentication_re_svpt (1).svg" alt="" />
      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>

    </script>
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
