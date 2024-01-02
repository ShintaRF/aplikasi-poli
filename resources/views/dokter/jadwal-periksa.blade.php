@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Periksa</h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal Periksa</h3>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jadwal->dokter->nama }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $jadwal->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#hapusModal{{ $jadwal->id }}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal Tambah -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                        aria-labelledby="tambahModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jadwalperiksa.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama">Nama Dokter</label>
                                            <select class="form-control" id="nama" name="id_dokter" required>
                                                @foreach ($dokters as $dokter)
                                                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="hari">Hari</label>
                                            <select class="form-control" id="hari" name="hari" required>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Rabu">Kamis</option>
                                                <option value="Rabu">Jumat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                                required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach ($jadwals as $jadwal)
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $jadwal->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm"
                                            action="{{ route('jadwalperiksa.update', ['id' => $jadwal->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama">Nama Dokter</label>
                                                <select class="form-control" id="nama" name="id_dokter" required>
                                                    @foreach ($dokters as $dokter)
                                                        <option value="{{ $dokter->id }}"
                                                            {{ $jadwal->dokter->id == $dokter->id ? 'selected' : '' }}>
                                                            {{ $dokter->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="hari">Hari</label>
                                                <select class="form-control" id="hari" name="hari" required>
                                                    <option value="Senin"
                                                        {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                    <option value="Selasa"
                                                        {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                    <option value="Rabu"
                                                        {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                    <option value="Kamis"
                                                        {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                    <option value="Jumat"
                                                        {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jam_mulai">Jam Mulai</label>
                                                <input type="time" class="form-control" id="jam_mulai"
                                                    name="jam_mulai" value="{{ $jadwal->jam_mulai }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jam_selesai">Jam Selesai</label>
                                                <input type="time" class="form-control" id="jam_selesai"
                                                    name="jam_selesai" value="{{ $jadwal->jam_selesai }}" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan
                                            Perubahan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusModal{{ $jadwal->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin akan menghapus data ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('jadwalperiksa.destroy', ['id' => $jadwal->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
