<?php 
    session_start();
    $hasil = $_SESSION['total'] ?? "0";    
    unset($_SESSION['total']);
    $nama = $kelamin = $identitas = $tipeKamar = $tanggal = $durasi = $makan = "";
    $totalBayar = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kamar</title>
    <script>
        function setMinDate() {
            var today = new Date(); 
            var dd = String(today.getDate()).padStart(2, '0'); 
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear(); 

            var todayFormatted = yyyy + '-' + mm + '-' + dd;

            document.getElementById("tanggal_pesan").setAttribute("min", todayFormatted);
        }
        window.onload = setMinDate;

        // function cek(){            
        //     var total     = document.getElementById('total_bayar').value;

        //     if(total===""){
        //         // appendAlert('Total harga tidak boleh kosong', 'danger');
        //         alert('total harga tidak boleh kosong')
        //         return false;           
        //     }
        //     return true;                       
        // }

        function simpan() {
            var totalHarga = document.getElementById('total_bayar').value;

            let alertForm       = document.getElementById('alert_form');
            const appendAlert = (message, type) => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show'); // Add 'fade' and 'show' classes
                wrapper.innerHTML = `
                    <strong>${message}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                alertForm.appendChild(wrapper);

                setTimeout(() => {
                    wrapper.classList.remove('show');
                    setTimeout(() => {
                        wrapper.remove();
                    }, 2000);
                }, 2000);
            };

            if (totalHarga === "") {
                appendAlert('Total harga tidak boleh kosong', 'danger');
            return false;
        }
        return true;
        }

    </script>
</head>
<body>
    <?php 
        if(isset($_SESSION['msg'])){
            $msg = $_SESSION['msg'];
            echo "<div class='alert alert-{$msg['type']} fade show' role='alert'>";
            echo htmlspecialchars($msg['type']);
            echo "</div>";
            unset($_SESSION['msg']);
        }

        // if(isset($_SESSION['data'])){
        //     $data = isset($_SESSION['data']) ? $_SESSION['data'] : "";
        // }        
    ?>
    <!-- Menampilkan Alert -->
    <div id="alert_form" 
        style="
        width: 670px;
        position: fixed;
        top: 15%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;">
    </div>
    
    <div class="">
        <form action="./proses/proses.php" onsubmit="return simpan()" method="post">
            <div class="box">
                <div class="row g-3">
                    <h4 class="sub_title">Form Pemesanan </h4>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control" name="nama" id="nama" >
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Nomor Identitas</label>
                        <input type="number" class="form-control"name="no_identitas" id="identitas">
                    </div>
                    <div class="col-md-6 form-check form-check-inline ms-3">
                        <input class="form-check-input" type="radio" name="kelamin" id="kelamin" value="Laki-laki">
                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                    </div>
                    <div class="col-md-6 form-check form-check-inline ms-3">
                        <input class="form-check-input" type="radio" name="kelamin" id="kelamin" value="Perempuan">
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                    <select class="col-md-6 form-select ms-2 form-select-md" name="tipe_kamar" id="tipe_kamar" onchange="ubahData()">
                        <option value="Standar_500000" selected>Standar</option>
                        <option value="Deluxe_750000">Deluxe</option>
                        <option value="Exclusive_1000000">Exclusive</option>                        
                    </select>
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" value="Rp 500.000,00" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Tanggal Pesan</label>
                        <input type="date" class="form-control" name="tgl" id="tanggal_pesan" min="">
                    </div>                    
                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label">Durasi Menginap</label>
                        <input type="number" class="form-control"name="durasi" id="durasi">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Total Bayar</label>
                        <input type="text" class="form-control" name="total" id="total_bayar" value="">
                    </div>
                    <div class="col-md-6 mt-5 pt-2">
                        <div class="form-check">
                            <label class="form-check-label" for="gridCheck">
                                Termasuk Breakfast
                            </label>
                        <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast">
                        </div>
                    </div>
                    <div class="col-12 text-center position relative">                        
                        <button type="button" class="btn btn-primary" id="alertBtn" onclick="hitung()">Hitung Total Bayar</button>
                         <button type="submit" class="btn btn-success" onclick="simpan()">Simpan</button>
                        <button type="submit" class="btn btn-danger" name="cancel" onclick="window.location.href='./index.php?page=produk'">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function ubahData() {            
            let tipeKamar = document.getElementById('tipe_kamar').value;
            let hargaInput = document.getElementById('harga');
            
            let pisahHargaTipe = tipeKamar.split('_');
            let harga = pisahHargaTipe[1];

            const formattedCurrency = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR', // Kode mata uang untuk Rupiah
            }).format(harga);

            hargaInput.value = formattedCurrency;            
        }

        function formatUangKeInteger(formatUang) {                        
            const cleanedString = formatUang.replace(/Rp\s?|\.|,/g, '');            
            const numericValue = parseFloat(cleanedString) / 100;

            // Mengembalikan angka bulat jika tidak ada desimal, jika ada desimal kembalikan sebagai angka desimal
            return numericValue % 1 === 0 ? Math.floor(numericValue) : numericValue;
        }

        function isEmpty(value) {
            return value === null || value === undefined || value === '';
        }

        function hitung(){            
            let namaInput       = document.getElementById('nama').value;
            let genderInput     = document.querySelectorAll('input[name="kelamin"]');
            let identitasInput  = document.getElementById('identitas').value;
            let kamarInput      = document.getElementById('tipe_kamar').value;
            let harga           = document.getElementById('harga').value;
            let tanggal         = document.getElementById('tanggal_pesan').value;
            let durasi          = document.getElementById('durasi').value;
            let makan           = document.getElementById('breakfast').checked; 

            let alertForm       = document.getElementById('alert_form');
            const appendAlert = (message, type) => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show'); // Add 'fade' and 'show' classes
                wrapper.innerHTML = `
                    <strong>${message}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                alertForm.appendChild(wrapper);

                setTimeout(() => {
                    wrapper.classList.remove('show');
                    setTimeout(() => {
                        wrapper.remove();
                    }, 2000);
                }, 2000);
            };

            
            let field = [
                {name: 'nama', value: namaInput, type: 'text'},
                {name: 'kelamin', value: genderInput, type: 'radio'},
                {name: 'identitas', value: identitasInput, type: 'text'},
                {name: 'tipe_kamar', value: kamarInput, type: 'text'},
                {name: 'harga', value: harga, type: 'text'},
                {name: 'tanggal', value: tanggal, type: 'text'},
                {name: 'durasi', value: durasi, type: 'text'},
            ];                        
            // Cek Semua Field
            if(field[0].value === "" || field[1].value === "" || field[2].value === "" || 
            field[3].value === ""|| field[4].value === "" || field[5].value === "" || field[6].value === ""){
                const fieldNames = field.map(item => {
                    if (item.value==="") {
                        return item.name;
                    }
                });                
                
                const emptyFieldNames = fieldNames.filter(name => name !== undefined);
                const fieldNamesString = emptyFieldNames.length > 0 ? emptyFieldNames.join(', ') : '';
                
                let cek = true;
                if(fieldNamesString === null || fieldNamesString === undefined){
                    cek = false;
                }

                if(cek){
                    appendAlert(`${fieldNamesString} tidak boleh kosong`, 'danger');                                                                    
                    return;
                }
            }

            let tanggalInput    = new Date(field[5].value); 
            tanggalInput.setHours(0, 0, 0, 0);             
           
            var nomorIdentitas = document.getElementById('identitas').value;

            if (nomorIdentitas.length !== 16) {
                // alert("Nomor identitas harus 16 digit");
                appendAlert('Nomor identitas harus 16 digit', 'danger');
                return;
            }

            if(tanggalInput.getTime() < getToday()){
                appendAlert('Tanggal pesan yang Anda masukkan tidak valid. Tanggal pesan harus sama dengan atau setelah tanggal hari ini.', 'danger');
                return;
            }          

            let total_bayar = document.getElementById('total_bayar');

            harga = formatUangKeInteger(harga);
            let total = 0;

            if (durasi > 3) {
                total = (durasi * harga) * 0.9; // Diskon 10%
                if (makan) {
                    total += 80000;
                }
            } else {
                total = durasi * harga;
                if (makan) {
                    total += 80000;
                }
            }

            total_bayar.value = number_format(total);
        }

        function number_format(number) {
            // Format angka dengan pemisah ribuan dan dua desimal
            let formattedNumber = parseInt(number).toLocaleString('id-ID', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            return 'Rp ' + formattedNumber;
        }

        function getToday() {
            let tanggalSekarang = new Date();

            // Mengatur waktu ke 00:00:00 untuk perbandingan hanya tanggal
            tanggalSekarang.setHours(0, 0, 0, 0);

            // Mengembalikan nilai timestamp
            return tanggalSekarang.getTime();
        }
    </script>
</body>
</html>
