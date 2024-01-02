@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pasien</h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No. KTP</th>
                                <th>No. Telepon</th>
                                <th>No. RM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailPeriksas->groupBy('id_periksa') as $idPeriksa => $groupedDetailPeriksas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->nama }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->alamat }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_ktp }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_hp }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_rm }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $idPeriksa }}">
                                            <i class="fas fa-eye"></i> Detail Riwayat Periksa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($detailPeriksas->groupBy('id_periksa') as $idPeriksa => $groupedDetailPeriksas)
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $idPeriksa }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Detail Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm">
                                            <div class="form-group">
                                                <label>Tanggal Periksa</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->created_at }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pasien</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Dokter</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->jadwal->dokter->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Keluhan</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->keluhan }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <textarea class="form-control" readonly required>{{ $groupedDetailPeriksas[0]->periksa->catatan }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Obat</label>
                                                <div id="selectedObats" class="border overflow-auto p-2"
                                                    style="height: 100px;">
                                                    @foreach ($groupedDetailPeriksas as $detailPeriksa)
                                                        {{ $detailPeriksa->obat->nama_obat }}
                                                        ({{ $detailPeriksa->obat->kemasan }})
                                                        - Rp. {{ $detailPeriksa->obat->harga }}
                                                        @if (!$loop->last)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jasa</label>
                                                <input type="text" class="form-control" readonly required value="150000">
                                            </div>
                                            <div class="form-group">
                                                <label>Total Biaya (Jasa + Obat)</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="Rp {{ $groupedDetailPeriksas[0]->periksa->biaya }}">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    @endforeach
                </div>
            </div><!-- /.container-fluid -->
        </div>
    @endsection
