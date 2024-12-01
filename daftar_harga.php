<?php 
    include 'router.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php include $title ?></title>
</head>
<body>
    <?php 
        $harga = [
            'standar'   => 500000,
            'deluxe'    => 750000,
            'excecutif' => 1000000,
            'breakfast' => 80000,
        ]
    ?>
    <div class="container-sm">
        <div class="box box_style">
            <h4 style="font-weight:700;text-align:center;margin:7px auto 35px">DAFTAR HARGA</h4>
            <table class="table table-stripped table-info table-hover">
                <thead>
                    <tr class="head_column">
                        <td style="background-color: rgb(241, 227, 215);">No</td>
                        <td style="background-color: rgb(241, 227, 215);">Tipe Kamar</td>
                        <td style="background-color: rgb(241, 227, 215);">Harga</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: rgb(241, 227, 215);">1</td>
                        <td style="background-color: rgb(241, 227, 215);">Standar</td>
                        <td style="background-color: rgb(241, 227, 215);"><?= "Rp " . number_format($harga['standar'], 0,',','.'); ?></td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(241, 227, 215);">2</td>
                        <td style="background-color: rgb(241, 227, 215);">Deluxe</td>
                        <td style="background-color: rgb(241, 227, 215);"><?= "Rp " . number_format($harga['deluxe'], 0,',','.'); ?></td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(241, 227, 215);">3</td>
                        <td style="background-color: rgb(241, 227, 215);">Exclusive</td>
                        <td style="background-color: rgb(241, 227, 215);"><?= "Rp " . number_format($harga['excecutif'], 0,',','.'); ?></td>
                    </tr>                    
                    <tr>
                        <td style="background-color: rgb(241, 227, 215);">4</td>
                        <td style="background-color: rgb(241, 227, 215);">Breakfast</td>
                        <td style="background-color: rgb(241, 227, 215);"><?= "Rp " . number_format($harga['breakfast'], 0,',','.'); ?></td>
                    </tr>                    
                </tbody>
            </table>    
        </div>
    </div>  
</body>
</html>