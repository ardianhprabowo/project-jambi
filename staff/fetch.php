<?php

require "../fungsi/koneksi.php";

$parentKey = '0';
    $sql = "SELECT * FROM jenis_barang";
  
    $result = $mysqli->query($sql);
   
      if(mysqli_num_rows($result) > 0)
      {
          $data = membersTree($parentKey);
      }else{
          $data=["id_jenis"=>"0","jenis_brg"=>"No Members present in list","text"=>"No Members is present in list","nodes"=>[]];
      }
   
      function membersTree($parentKey)
      {
          require '../fungsi/koneksi.php';
  
          $sql = 'SELECT id_jenis, jenis_brg from jenis_barang WHERE parent_id="'.$parentKey.'"';
  
          $result = $mysqli->query($sql);
  
          while($value = mysqli_fetch_assoc($result)){
             $id = $value['id_jenis'];
             $row1[$id]['id_jenis'] = $value['id_jenis'];
             $row1[$id]['jenis_brg'] = $value['jenis_brg'];
             $row1[$id]['text'] = $value['jenis_brg'];
             $row1[$id]['nodes'] = array_values(membersTree($value['id']));
          }
  
          return $row1;
      }
  
      echo json_encode(array_values($data));
?>