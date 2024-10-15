<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Scan QR Code</h1>

        <div id="qr-reader" style="width: 500px"></div>
        <div id="qr-reader-results"></div>

        <a href="{{ route('antrian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Hasil QR Code yang berhasil di-scan
            document.getElementById('qr-reader-results').innerText = `Hasil: ${decodedText}`;

            // Redirect ke halaman detail antrian
            window.location.href = decodedText;
        }

        function onScanFailure(error) {
            console.warn(`Gagal memindai kode: ${error}`);
        }

        // Inisialisasi QR Code scanner
        const html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start({
                facingMode: "environment"
            }, {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanFailure
        );
    </script>
</body>

</html>