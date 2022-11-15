<?php
    session_start();

    require "functions.php";

    if(!isset($_SESSION["login"]) && !isset($_SESSION["alulogin"])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_SESSION["login"])) {
        $id = $_GET['id'];
        $alumni = query("SELECT * FROM alumni WHERE id = $id");
        foreach($alumni as $tabel) {
            $nim = $tabel['nim'];
            $nama = $tabel['nama'];
            $prodi = $tabel['prodi'];
			$judul_skripsi = $tabel['judul_skripsi'];
			$thmasuk = $tabel['thmasuk'];
            $thlulus = $tabel['thlulus'];
        }
    }

    elseif ($_SESSION["alulogin"]) {
        if (empty(isset($_GET["nim"]))) {
            $alunim = $_SESSION["alunim"];
        }
        else {
            $alunim = $_GET["nim"];  
        }
        
        $alumni = query("SELECT * FROM alumni WHERE nim = $alunim");
        
        if ($alumni == false) {
            echo "<script>alert('Daftarkan data terlebih dahulu')</script>";
            echo "<script>window.location.href = 'inputdata.php'</script>";
            exit;
        }

        foreach ($alumni as $tabel) {
            $id = $tabel['id'];
            $nim = $tabel['nim'];
            $nama = $tabel['nama'];
            $prodi = $tabel['prodi'];
			$judul_skripsi = $tabel['judul_skripsi'];
			$thmasuk = $tabel['thmasuk'];
            $thlulus = $tabel['thlulus'];
        }
    }

    if(isset($_POST["ubah"])) {
        // check apakah data berhasil ditambahkan atau tidak
        if(ubah($_POST) > 0 ) {
            echo "<script>alert('Selamat data berhasil diperbarui')</script>";
            echo "<script>window.location.href = 'pencarian.php'</script>";
        }
        else if ($tabel) {
            echo "<script>alert('Selamat data berhasil diperbarui')</script>";
            echo "<script>window.location.href = 'pencarian.php'</script>";
        }
        else {
            echo "<script>alert('Data gagal diperbarui, cek inputan kembali')</script>";
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
    <section class="input__data">
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
          <h2>Ubah Data Alumni</h2>
        </div>

        <div class="login-form">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="nim" value="<?= $nim ?>">

            <label for="shownim" class="form-label">NIM</label>
            <input
              type="text"
              class="form-control"
              id="shownim"
              placeholder=""
              name="shownim"
              minlength= 11
              maxlength= 11
              pattern="[0-9]+"
              value="<?= $nim; ?>"
              disabled
              required
            />

            <label for="nama" class="form-label">Nama</label>
            <input
              type="text"
              class="form-control"
              id="nama"
              placeholder=""
              name="nama"
              maxlength="100"
              pattern="[A-z\s]+"
              value="<?= $nama; ?>"
              required
            />

            <label for="prodi" class="form-label">Program Studi</label>
            <input
              type="text"
              class="form-control"
              id="prodi"
              placeholder=""
              name="prodi"
              maxlength="30"
              pattern="[A-z\s]+"
              value="<?= $prodi; ?>"
              required
            />
			
			<label for="judul_skripsi" class="form-label">Judul Skripsi</label>
            <input
              type="text"
              class="form-control"
              id="judul_skripsi"
              placeholder=""
              name="judul_skripsi"
              maxlength="200"
              pattern="[A-z\s]+"
              value="<?= $judul_skripsi; ?>"
              required
            />
			
			<label for="thmasuk" class="form-label">Tahun Masuk</label>
            <input
              type="text"
              class="form-control"
              id="thmasuk"
              placeholder=""
              name="thmasuk"
              minlength=4
              maxlength=4
              pattern="[0-9]+"
              value="<?= $thmasuk; ?>"
              required
            />

            <label for="thlulus" class="form-label">Tahun Lulus</label>
            <input
              type="text"
              class="form-control"
              id="thlulus"
              placeholder=""
              name="thlulus"
              minlength=4
              maxlength=4
              pattern="[0-9]+"
              value="<?= $thlulus; ?>"
              required
            />
            <br>
            <button class="btn btn-primary" type="submit" name="ubah">Submit</button>
            <button class="btn btn-danger" type="button" name="hapus"><a class="submit" href="hapus.php?nim=<?= $tabel['nim']; ?>" onclick="return confirm('Konfirmasi hapus')" style="text-decoration:none; color:white">Hapus</a></button>
          </form>
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

    <script>
      var fieldNim = document.querySelector("input[name=nim]");
      var fieldNama = document.querySelector("input[name=nama]");
      var fieldProdi = document.querySelector("input[name=prodi]");
	  var fieldJudul = document.querySelector("input[name=judul_skripsi]");
	  var fieldTahunM  = document.querySelector("input[name=thmasuk]");
      var fieldTahunL  = document.querySelector("input[name=thlulus]");

      fieldNim.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format angka (11 digit)');  
        }
      });
      fieldNama.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format huruf');  
        }
      });
      fieldProdi.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format huruf');  
        }
      });
	  fieldJudul.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format huruf');  
        }
      });
	  fieldTahunM.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format angka (4 digit)');  
        }
      });
      fieldTahunL.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Inputan salah, silahkan ganti dengan format angka (4 digit)');  
        }
      });
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>