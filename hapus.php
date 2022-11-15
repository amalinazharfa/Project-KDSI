<?php
    session_start();

    require "functions.php";

    if(!isset($_SESSION["login"]) && !isset ($_SESSION["alulogin"])){
        header("Location: login.php");
        exit;
    }

    $nim = $_GET['nim'];
    $delete = "DELETE FROM alumni WHERE nim = $nim";
    $delete2 = "DELETE FROM alu WHERE alunim = $nim";

    $hps = hapus($delete);
    $hps2 = hapus($delete2);
    
    if (isset($_SESSION["alulogin"])) {
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie("id", "", time() - 3600);
        setcookie("key", "", time() - 3600);
    }

    if($hps && $hps2 > 0 ) {
        echo "<script>alert('Data berhasil dihapus')</script>";
        echo "<script>document.location.href = 'index.php'</script>";
    }
    else {
        echo "<script>alert('Data gagal dihapus')</script>";
    }   
?>