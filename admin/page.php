 
<?php 
  
    $page = isset($_GET['p']) ? $_GET['p'] : "";

    if ($page == 'formpesan') {
        include_once "formpesan.php";
    } else if ($page=="") {
        include_once "main.php";
    } else if ($page=="datapesanan") {
        include_once "datapesanan.php";
    }  else if ($page=="barang") {
        include_once "barang.php";
    } else if ($page=="tambahbarang") {
        include_once "tambahbarang.php";
    } else if ($page=="user") {
        include_once "user.php";
    }  else if ($page=="edit") {
        include_once "editbarang.php";
    } else if ($page=="hapus") {
        include_once "hapusbarang.php";
    } else if ($page=="hapususer") {
        include_once "hapususer.php";
    } else if ($page=="edituser") {
        include_once "edituser.php";
    } else if ($page=="tambahuser") {
        include_once "tambahuser.php";
    } else if ($page=="cetakstok") {
        include_once "halcetak.php";
    } else if($page == "detil"){
        include_once "detilpesan.php";
    }else if ($page=="tidaksetuju") {
        include_once "tidaksetuju.php";
    } else if ($page=="disetujui") {
        include_once "disetujui.php";
    } else if($page == "detil"){
        include_once "detilpesan.php";
    } else if ($page=="editpesan") {
        include_once "editpesan.php";
    } else if ($page=="history"){
        include_once "history.php";
    }else if ($page=="detilhistory"){
        include_once "detilhistory.php";
    }
 ?>
 
