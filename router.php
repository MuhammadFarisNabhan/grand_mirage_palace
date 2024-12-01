<?php 
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    switch ($page){        
        case 'daftar_harga':
            $content = './views/daftar_harga.php';
            $title = "Daftar Harga";
            break;
        case 'tentang_kami':
            $content = './views/tentang_kami.php';
            $title = "Tentang Kami";
            break;
        case 'pesan_kamar':
            $content = './views/pesan_kamar.php';
            $title = "Pesan Kamar";
            break;
        case 'produk':
            $content = './views/produk.php';
            $title = "Produk Kami";
            break;
        case 'data':
            $content = './views/data.php';
            $title = "Data Pemesan";
            break;
        default:
            $content = './views/produk.php';
            $title = "Grand Mirage Palace";
            break;
    }
?>