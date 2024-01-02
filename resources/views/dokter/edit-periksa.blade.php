@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periksa Pasien</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Periksa Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ route('editperiksa.update', ['id' => $daftarPoli->id]) }}" method="POST">
                        @csrf

                        <!-- Nama Pasien -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $daftarPoli->pasien->nama }}" required disabled>
                            <input type="hidden" class="form-control" id="id" name="id_daftar_poli"
                                value="{{ $daftarPoli->id }}">
                        </div>

                        <!-- Tanggal Periksa -->
                        <div class="mb-3">
                            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                            <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" required>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" required>
                        </div>

                        <!-- Obat -->
                        <input type="hidden" name="obat_ids" id="hiddenObatIds" value="">
                        <input type="hidden" name="biaya" id="biaya" value="">
                        <div class="mt-3">
                            <label for="obat" class="form-label">Obat</label>
                            <div id="selectedObats" class="border overflow-auto p-2" style="height: 100px;"></div>
                            <hr>
                            <h5>Total Harga: <span id="totalHarga">0</span></h5>
                        </div>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#obatModal">
                            Tambah Obat
                        </button>

                        <!-- Tombol Submit -->
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                    <!-- End Form -->
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- Partial: obat-modal.blade.php -->

    <div class="modal fade" id="obatModal" tabindex="-1" aria-labelledby="obatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="obatModalLabel">Add Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="obatSelect" class="form-label">Select Obat</label>
                            <select class="form-control" id="obatSelect" required>
                                <option value="" disabled selected>Select Obat</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input min="1" value="1" type="number" class="form-control" id="quantity"
                                required>
                        </div>

                        <button type="button" data-dismiss="modal" class="btn btn-primary"
                            onclick="addObatToList()">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedObats = [];

        function addObatToList() {
            const obatId = $('#obatSelect').val();
            const obatName = $('#obatSelect option:selected').text();
            const quantity = $('#quantity').val();
            const harga = $('#obatSelect option:selected').data('harga');
            const totalHarga = harga * quantity;

            const obat = {
                id: obatId,
                name: obatName,
                harga: harga,
                quantity: quantity
            };

            selectedObats.push(obat);

            updateHiddenInput();

            displaySelectedObats();

            $('#obatSelect').val('');
            $('#quantity').val('');
        }

        function displaySelectedObats() {
            $('#selectedObats').empty();

            selectedObats.forEach(obat => {
                $('#selectedObats').append(
                    `<div>${obat.name} - Jumlah: ${obat.quantity} - Total Harga: ${obat.harga * obat.quantity}</div>`
                );
            });

            updateTotalHarga();
        }

        function updateHiddenInput() {
            const obatIds = selectedObats.map(obat => obat.id);
            $('#hiddenObatIds').val(JSON.stringify(obatIds));
        }

        function updateTotalHarga() {
            let totalHarga = 0;
            selectedObats.forEach(obat => {
                totalHarga += obat.harga * obat.quantity;
            });

            $('#biaya').val(totalHarga);
            $('#totalHarga').text(totalHarga);
        }
    </script>
@endsection
