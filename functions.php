<?php
    // koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "sistem_alumni");

    // menerima query sql

    function query($query) {
        global $conn;
        // ambil data
        $result = mysqli_query($conn, $query);
        $rows = [];
        // masukkan ke array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function tambah($data) {
        // ambil data dari tiap emenen dalam form
        global $conn;
        
        $nim = test_input($data["nim"]);
        $nama = test_input($data["nama"]);
        $prodi = test_input($data["prodi"]);
		$judul_skripsi = test_input($data["judul_skripsi"]);
		$thmasuk = test_input($data["thmasuk"]);
        $thlulus = test_input($data["thlulus"]);
		

        $query = "INSERT INTO alumni VALUES ('', '$nim', '$nama', '$prodi', '$judul_skripsi', '$thmasuk','$thlulus')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus($data) {
        global $conn;

        mysqli_query($conn, $data);

        return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;

        $id = $data["id"];
        $nim = test_input($data["nim"]);
        $nama = test_input($data["nama"]);
        $prodi = test_input($data["prodi"]);
		$judul_skripsi = test_input($data["judul_skripsi"]);
		$thmasuk = test_input($data["thmasuk"]);
        $thlulus = test_input($data["thlulus"]);

        $ubah = "UPDATE alumni SET nama = '$nama', nim = '$nim', prodi = '$prodi', judul_skripsi = '$judul_skripsi', thmasuk = '$thmasuk', thlulus = '$thlulus' WHERE id = $id";

        mysqli_query($conn, $ubah);
        
        return mysqli_affected_rows($conn);
    }

    function ubah2($data) {
        global $conn;

        $id = $data["id"];
        $nim = test_input($data["nim"]);
        $nama = test_input($data["nama"]);
        $prodi = test_input($data["prodi"]);
		$judul_skripsi = test_input($data["judul_skripsi"]);
		$thmasuk = test_input($data["thmasuk"]);
        $thlulus = test_input($data["thlulus"]);

        $ubah = "UPDATE alumni SET id = '$id', nama = '$nama', nim = '$nim', prodi = '$prodi', judul_skripsi = '$judul_skripsi', thmasuk = '$thmasuk', thlulus = '$thlulus' WHERE nim = $nim";

        mysqli_query($conn, $ubah);
        
        return mysqli_affected_rows($conn);
    }

    function cari($data) {

        $search = "SELECT * FROM alumni WHERE
                nim LIKE '%$data%' OR
                nama LIKE '%$data%' OR
                prodi LIKE '%$data%' OR
				judul_skripsi LIKE '%$data%'OR
				thmasuk LIKE '%$data%'OR
                thlulus LIKE '%$data%' ORDER BY nim ASC";
                
        return query($search);
    }

    function regristasi($data) {
        // menerima data dari post

        global $conn;

        $username = test_input(strtolower($data["username"]));
        // memungkinkan tanda "" dalam database
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $konpassword = mysqli_real_escape_string($conn, $data["konpassword"]);

        // cek username
        $res = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        $res2 = mysqli_query($conn, "SELECT alunim FROM alu WHERE alunim = '$username'");

        if (mysqli_fetch_assoc($res) || mysqli_fetch_assoc($res2)) {
            echo "<script>alert('sudah ada')</script>";
            echo "<script>window.location.href = 'login.php'</script>";
            return false;
        }
        
        // cek konfirmasi password
        if ($password !== $konpassword) {
            echo "<script>alert('konfirmasi salah')</script>";
            return false;
        }

        // enkripsi password
        // password_hash, mengacak menggunakan algoritma default
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambah user baru
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }

    function aluregristasi($data) {
        // menerima data dari post

        global $conn;

        $username = test_input(strtolower($data["username"]));
        // memungkinkan tanda "" dalam database
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $konpassword = mysqli_real_escape_string($conn, $data["konpassword"]);

        // cek username
        $res = mysqli_query($conn, "SELECT alunim FROM alu WHERE alunim = '$username'");
        $res2 = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($res) || mysqli_fetch_assoc($res2)) {
            echo "<script>alert('sudah ada')</script>";
            echo "<script>window.location.href = 'login.php'</script>";
            return false;
        }
        
        // cek konfirmasi password
        if ($password !== $konpassword) {
            echo "<script>alert('konfirmasi salah')</script>";
            return false;
        }

        // enkripsi password
        // password_hash, mengacak menggunakan algoritma default
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambah user baru
        mysqli_query($conn, "INSERT INTO alu VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }