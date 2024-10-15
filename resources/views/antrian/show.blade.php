<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Antrian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Antrian #{{ $antrian->nomor_antrian }}</h1>

        <p><strong>Nama:</strong> {{ $antrian->nama }}</p>
        <p><strong>Status:</strong> {{ $antrian->status }}</p>

        <h3>Scan QR Code:</h3>
        <div>
            {!! $qrcode !!}
        </div>

        <a href="{{ route('antrian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>