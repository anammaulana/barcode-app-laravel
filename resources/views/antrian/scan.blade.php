<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Scan QR Code</h1>


        <div id="qr-reader" style="width: 300px;"></div>
        <div id="qr-reader-results"></div>

        <!-- Tombol untuk memulai pemindaian QR Code -->
        <button id="start-scan">Mulai Pemindaian</button>
        <button id="stop-scan" style="display:none;">Berhenti Pemindaian</button>

        <a href="{{ route('antrian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>



    <script>
        // Fungsi untuk menangani sukses pemindaian
        function onScanSuccess(decodedText, decodedResult) {
            // Hasil QR Code yang berhasil di-scan
            document.getElementById('qr-reader-results').innerText = `Hasil: ${decodedText}`;

            // Redirect ke halaman detail antrian
            window.location.href = decodedText;
        }

        // Fungsi untuk menangani kegagalan pemindaian
        function onScanFailure(error) {
            console.warn(`Gagal memindai kode: ${error}`);
        }

        // Inisialisasi QR Code scanner
        const html5QrCode = new Html5Qrcode("qr-reader");

        // Tombol untuk memulai pemindaian
        document.getElementById('start-scan').addEventListener('click', function() {
            // Mulai pemindaian QR code ketika tombol diklik
            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                }, onScanSuccess, onScanFailure)
                .then(() => {
                    // Sembunyikan tombol mulai dan tampilkan tombol berhenti
                    document.getElementById('start-scan').style.display = 'none';
                    document.getElementById('stop-scan').style.display = 'block';
                })
                .catch(err => {
                    console.error(`Gagal memulai pemindaian: ${err}`);
                });
        });

        // Tombol untuk menghentikan pemindaian
        document.getElementById('stop-scan').addEventListener('click', function() {
            // Berhenti memindai QR code
            html5QrCode.stop().then(() => {
                // Sembunyikan tombol berhenti dan tampilkan tombol mulai
                document.getElementById('stop-scan').style.display = 'none';
                document.getElementById('start-scan').style.display = 'block';
            }).catch(err => {
                console.error(`Gagal menghentikan pemindaian: ${err}`);
            });
        });
    </script>

</body>

</html>