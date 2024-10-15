<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Antrian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manajemen Antrian</h1>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Statistik Antrian --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Antrian</h5>
                        <p>{{ $totalAntrian }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Menunggu</h5>
                        <p>{{ $menunggu }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Dilayani</h5>
                        <p>{{ $dilayani }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Selesai</h5>
                        <p>{{ $selesai }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Tambah Antrian --}}
        <a href="{{ route('antrian.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>
        <a href="{{ route('antrian.daftarAntrian') }}" class="btn btn-primary mb-3">Daftar Antrian</a>

        {{-- Tabel Daftar Antrian --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nomor Antrian</th>
                    <th>Status</th>
                    <th>QR Code</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($antrians as $antrian)
                <tr>
                    <td>{{ $antrian->id }}</td>
                    <td>{{ $antrian->nama }}</td>
                    <td>{{ $antrian->nomor_antrian }}</td>
                    <td>
                        @if($antrian->status === 'Menunggu')
                        <span class="badge bg-warning">{{ $antrian->status }}</span>
                        @elseif($antrian->status === 'Dilayani')
                        <span class="badge bg-info">{{ $antrian->status }}</span>
                        @else
                        <span class="badge bg-success">{{ $antrian->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('antrian.generate-qr', $antrian->id) }}" class="btn btn-secondary">Generate QR</a>
                    </td>
                    <td>
                        {{-- Tombol Ubah Status --}}
                        <a href="{{ route('antrian.update-status', ['id' => $antrian->id, 'status' => 'Dilayani']) }}" class="btn btn-info">Dilayani</a>
                        <a href="{{ route('antrian.update-status', ['id' => $antrian->id, 'status' => 'Selesai']) }}" class="btn btn-success">Selesai</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('antrian.destroy', $antrian->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus antrian ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('antrian.show', $antrian->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $antrians->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>