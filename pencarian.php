<?php
    session_start();

    // menghubungkan ke function
    require "functions.php";

    if(!isset($_SESSION["login"]) && !isset($_SESSION["alulogin"])) {
        header("Location: login.php");
        exit;
    }

    if(isset($_SESSION["alulogin"])) {
        $alunim = $_SESSION["alunim"];  
        $alul = query("SELECT * FROM alumni WHERE nim = $alunim");
        if($alul == false) {
            header("Location: local.php");
        }
    }

    $alumni = query("SELECT * FROM alumni ORDER BY nim ASC");

    if(isset($_POST["cari"])) {
        $alumni = cari($_POST["keyword"]);
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
    <section class="pencarian_data">
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
        <div class="judul">
          <h2>Pencarian Alumni</h2>
        </div>

        <div class="search-container">
          <form action="" class="search-form" method="POST">
            <input
              type="text"
              name="keyword"
              placeholder="Masukkan Keyword"
              class="search-field"
              autofocus
              autocomplete="off"

            />
            <button class="search-btn" type="submit" id="toggleBtn" name="cari">
              <img src="img/Search_light.svg" alt="" />
            </button>
          </form>
        </div>

        <div class="search-results" id="search-results">
          <div class="search-results-judul">DATA ALUMNI</div>
          <div class="search-results-container">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">NIM</th>
                  <th scope="col">Program Studi</th>
				  <th scope="col">Judul Skripsi</th>
				  <th scope="col">Tahun Masuk</th>
                  <th scope="col">Tahun Lulus</th>
                </tr>
              </thead>
              <tbody>
              <?php $no = 1; ?>
                <?php foreach($alumni as $tabel) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $tabel["nama"]; ?></td>
                    <td><a href="ganti.php?id=<?= $tabel['id']; ?>"><?php echo $tabel["nim"]; ?></a></td>
                    <td><?php echo $tabel["prodi"]; ?></td>
					<td><?php echo $tabel["judul_skripsi"]; ?></td>
                    <td><?php echo $tabel["thmasuk"]; ?></td>
                    <td><?php echo $tabel["thlulus"]; ?></td>
                   </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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

    <!-- <script>
      const toggleBtn = document.querySelector("#toggleBtn");
      const divList = document.querySelector(".search-results");

      toggleBtn.addEventListener("click", () => {
        if (divList.style.display === "none") {
          divList.style.display = "block";
        } else {
          divList.style.display = "none";
        }
      });
    </script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
