<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Antrian</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('antrian.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>
        <a href="{{ route('antrian.scan') }}" class="btn btn-secondary mb-3">Scan QR Code</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Antrian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($antrians as $antrian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $antrian->nama }}</td>
                    <td>{{ $antrian->nomor_antrian }}</td>
                    <td>{{ $antrian->status }}</td>
                    <td>
                        <a href="{{ route('antrian.show', $antrian->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>