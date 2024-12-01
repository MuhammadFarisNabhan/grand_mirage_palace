<?php 

    function getData(){
        require 'koneksi.php';
    
        $sql = "SELECT * FROM customer";
    
        $get_data = mysqli_query($conn,$sql);
        $datas = [];
        while ($row = mysqli_fetch_assoc($get_data)){
            $datas[] = [
                'id'            => $row['id'],
                'cust'          => $row['nama'],
                'gender'        => $row['jenis_kelamin'],
                'tipe_kamar'    => $row['tipe_kamar'],
                'tgl'           => $row['tanggal_pesan'],
                'durasi'        => $row['durasi'],
                'disc'          => $row['discount'],
                'no_id'         => $row['no_identitas'],
                'total_bayar'   => $row['total_bayar'],                
            ];
        }
        return $datas;

    }

?>