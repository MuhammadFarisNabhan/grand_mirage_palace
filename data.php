<?php 
    require './proses/data_pemesan.php';
    $data = getData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <style>
        .box_datar{
            background-color: white;
            width: 1000px;
            height: 500px;
            border-radius: 15px;
            padding: 35px 25px;
        }
    </style>
</head>
<body>
    <div class="container-sm mt-5">
        <div class="box_datar" style="background-color: rgb(241, 227, 215);">
            <a href="?page=pesan_kamar">kembali</a>
            <h4 style="font-weight:700;text-align:center;margin:7px auto 35px">Data Pemesan</h4>
            <table class="table table-stripped table-info table-hover">                
                <thead>
                    <tr class="head_column">
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">No</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Nomor Identitas</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Jenis Kelamin</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Tipe Kamar</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Durasi Penginapan</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Discount</td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);">Total Bayar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach($data as $d){
                    ?>
                    <tr>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $no; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['no_id']; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['gender']; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['tipe_kamar']; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['durasi'] . " Hari"; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['disc']; ?></td>
                        <td class="text-center" style="background-color: rgb(241, 227, 215);"><?= $d['total_bayar']; ?></td>                        
                    </tr>  
                    <?php 
                        $no++;
                        } ?>                                 
                </tbody>
            </table>    
        </div>
    </div>
</body>
</html>