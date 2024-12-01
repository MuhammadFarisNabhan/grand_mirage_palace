<?php 
    require '../koneksi.php';
    
    // $message = "";

    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $identitas = $_POST['no_identitas'];
    $tipe = $_POST['tipe_kamar'];
    $tanggal = $_POST['tgl'];
    $durasi = $_POST['durasi'];
    $totalBayar = $_POST['total'];                       
    
    list($tipe,$harga) = explode('_',$tipe);

    $disc = 0;
    if($durasi > 3){
        $disc = "10%";
    } else{
        $disc = "0%";
    }

    $sql = " INSERT INTO customer 
        (nama, jenis_kelamin,no_identitas, tipe_kamar, tanggal_pesan, durasi, total_bayar, discount)
        VALUES (?,?,?,?,?,?,?,?)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $nama,$kelamin,$identitas,$tipe,$tanggal,$durasi,$totalBayar,$disc);

    if($stmt->execute()){
        $_SESSION['msg'] = [
            'type'      => "success",
            'message'   => "data gagal tersimpan."
        ];
        header('Location: ../index.php?page=data');
        exit;
    } else {
        $_SESSION['msg'] = [
            'type'      => "error",
            'message'   => "data gagal tersimpan."
        ];
        header('Location: ../index.php?page=pesan_kamar');
        exit;
    }

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     if(isset($_POST['simpan'])){
    //         if(isset($conn)){
    //             simpan($conn);
    //         } else {
    //             $_SESSION['msg'] = [
    //                 'tipe'  => 'error',
    //                 'pesan' => 'Koneksi ke database gagal'
    //             ];
    //             header('Location: ../index.php?page=pesan_kamar');
    //             exit;
    //         }                    
            

    //     }
    //     if (isset($_POST['total'])){
    //         $makan = isset($_POST['breakfast']) ? $_POST['breakfast'] : null;
    //         if(isset($makan) && $makan != null){                
    //             total($makan);
    //         }
    //         header("Location: ../index.php?page=pesan_kamar");
    //     }
    //     if (isset($_POST['cancel'])){
    //         header('Location: ../index.php');
    //     }
    // }
    
    function sanitizeInput($data){
        return htmlspecialchars(strip_tags(trim($data)));
    }

    function appendAlert($message, $type) {
        echo "<div class='$type'>$message</div>";
    }

    function simpan($conn){
        $errors = [];        
        $nama = $kelamin = $identitas = $tipe = $tanggal = $durasi = "";

        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['nama'])){
                $errors[] = 'Nama tidak boleh kosong';
            } else{
                $nama = sanitizeInput($_POST['nama']);
            }
        }
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['kelamin'])){
                $errors[] = 'Kelamin tidak boleh kosong';
            } else{
                $nama = sanitizeInput($_POST['kelamin']);
            }
        }
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['tipe_kamar'])){
                $errors[] = 'Tipe kamar tidak boleh kosong';
            } else{
                $nama = sanitizeInput($_POST['tipe_kamar']);
            }
        }
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['tgl'])){
                $errors[] = 'Tanggal pesan tidak boleh kosong';
            } else{
                $nama = sanitizeInput($_POST['tgl']);
            }
        }
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(empty($_POST['durasi'])){
                $errors[] = 'Tanggal pesan tidak boleh kosong';
            } else{
                $nama = sanitizeInput($_POST['durasi']);
            }
        }

        if(empty($errors)){
            $nama = $_POST['nama'];
            $kelamin = $_POST['kelamin'];
            $identitas = $_POST['no_identitas'];
            $tipe = $_POST['tipe_kamar'];
            $tanggal = $_POST['tgl'];
            $durasi = $_POST['durasi'];
            $totalBayar = $_POST['total'];                       
            
            list($tipe,$harga) = explode('_',$tipe);

            $disc = 0;
            if($durasi > 3){
                $disc = "10%";
            } else{
                $disc = "0%";
            }

            $sql = " INSERT INTO customer 
                (nama, jenis_kelamin,no_identitas, tipe_kamar, tanggal_pesan, durasi, total_bayar, discount)
                VALUES (?,?,?,?,?,?,?,?)
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssss', $nama,$kelamin,$identitas,$tipe,$tanggal,$durasi,$totalBayar,$disc);
    
            if($stmt->execute()){
                $_SESSION['msg'] = [
                    'type'      => "success",
                    'message'   => "data gagal tersimpan."
                ];
                header('Location: ../index.php?page=data');
                exit;
            } else {
                $_SESSION['msg'] = [
                    'type'      => "error",
                    'message'   => "data gagal tersimpan."
                ];
                header('Location: ../index.php?page=pesan_kamar');
                exit;
            }
        }


    }

    function total($makan = 0){        
        $nama = $kelamin = $identitas = $tipeKamar = $tanggal = $durasi = $makan = "";
        $totalBayar = 0;

        $nama = $_POST['nama'];
        $kelamin = $_POST['kelamin'];
        $identitas = $_POST['no_identitas'];
        $tipeKamar = $_POST['tipe_kamar'];
        $tanggal = $_POST['tgl'];
        $durasi = $_POST['durasi'];
        $makan = $_POST['breakfast'];

        $durasi = htmlspecialchars($_POST['durasi']);
        $tipe = htmlspecialchars($_POST['tipe_kamar']);
        list($tipe_kamar, $harga) = explode('_',$tipe);

        $harga = floatval($harga); 
        $mkn = (isset($makan)) ? 80000 : 0;            

        $hasil = 0;
        if ((int)$durasi > 3) {
            $hasil = (($harga * (int)$durasi) * 0.1) + $mkn;
        } else {
            $hasil = ($harga * (int)$durasi) + $mkn;
        }

        $_SESSION['data'] = [
            'nama' => $nama,
            'kelamin' => $kelamin,
            'identitas' => $identitas,
            'tipeKamar' => $tipeKamar,
            'tanggal' => $tanggal,
            'durasi' => $durasi,
            'makan' => $makan,
            'totalBayar' => $hasil
        ];        
        header('Location: ../index.php?page=pesan_kamar');            
        exit;
    }

    function cancel(){

    }

?>