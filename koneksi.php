<?php
    $koneksi = mysqli_connect("127.0.0.1:3307", "root", "", "ukkweb");

    if(mysqli_connect_error($koneksi))
    {
        echo "Koneksi Gagal". mysqli_connect_error();  
    }

?>