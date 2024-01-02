@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Dokter</h1>
                    <form action="{{ route('dokter.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nama">Nama Dokter</label>
                                <input required type="text" name="nama" class="form-control" id="nama"
                                    placeholder="Nama Dokter">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input required type="text" name="alamat" class="form-control" id="alamat"
                                    placeholder="Alamat">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">No HP</label>
                                <input required type="text" name="no_hp" class="form-control" id="nama"
                                    placeholder="No HP">
                                @error('no_hp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Poli</label>
                                <select name="id_poli" class="form-control">
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_poli')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>Poli</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dokters as $dokter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dokter->nama }}</td>
                                            <td>{{ $dokter->alamat }}</td>
                                            <td>{{ $dokter->no_hp }}</td>
                                            <td>{{ $dokter->poli->nama_poli }}</td>
                                            <td>
                                                <button data-toggle="modal" data-target="#editModal{{ $dokter->id }}"
                                                    class="btn btn-success">Ubah</button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusModal{{ $dokter->id }}">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Modal Edit -->
    @foreach ($dokters as $dokter)
        <div class="modal fade" id="editModal{{ $dokter->id }}" tabindex="-1" role="dialog"
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
                        <form id="editForm" method="POST" action="{{ route('dokter.update', ['id' => $dokter->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Dokter</label>
                                <input required type="text" name="nama" value="{{ $dokter->nama }}"
                                    class="form-control" id="nama" placeholder="Nama Dokter">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input required type="text" name="alamat" value="{{ $dokter->alamat }}"
                                    class="form-control" id="alamat" placeholder="Alamat">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">No HP</label>
                                <input required type="text" name="no_hp" value="{{ $dokter->no_hp }}"
                                    class="form-control" id="nama" placeholder="No HP">
                                @error('no_hp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Poli</label>
                                <select name="id_poli" class="form-control">
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ $dokter->poli->id == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_poli')
                                    {{ $message }}
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan
                            Perubahan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Hapus -->
        <div class="modal fade" id="hapusModal{{ $dokter->id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('dokter.destroy', ['id' => $dokter->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
