@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Pasien</h1>
                    <form action="{{ route('pasien.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nama">Nama Pasien</label>
                                <input required type="text" name="nama" class="form-control" id="nama"
                                    placeholder="Nama Pasien">
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
                                <label for="no_ktp">No KTP</label>
                                <input required type="text" name="no_ktp" class="form-control" id="no_ktp"
                                    placeholder="No KTP">
                                @error('no_ktp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input required type="text" name="no_hp" class="form-control" id="no_hp"
                                    placeholder="No HP">
                                @error('no_hp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_rm">No RM</label>
                                <input required type="text" name="no_rm" class="form-control"
                                    value="{{ $no_rm }}" id="no_rm" placeholder="No RM">
                                @error('no_rm')
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
                            <h3 class="card-title">Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. KTP</th>
                                        <th>No. HP</th>
                                        <th>No. RM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasiens as $pasien)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pasien->nama }}</td>
                                            <td>{{ $pasien->alamat }}</td>
                                            <td>{{ $pasien->no_ktp }}</td>
                                            <td>{{ $pasien->no_hp }}</td>
                                            <td>{{ $pasien->no_rm }}</td>
                                            <td>
                                                <button data-toggle="modal" data-target="#editModal{{ $pasien->id }}"
                                                    class="btn btn-success">Ubah</button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusModal{{ $pasien->id }}">
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
    @foreach ($pasiens as $pasien)
        <div class="modal fade" id="editModal{{ $pasien->id }}" tabindex="-1" role="dialog"
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
                        <form id="editForm" method="POST" action="{{ route('pasien.update', ['id' => $pasien->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Pasien</label>
                                <input required type="text" name="nama" value="{{ $pasien->nama }}"
                                    class="form-control" id="nama" placeholder="Nama Pasien">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input required type="text" name="alamat" value="{{ $pasien->alamat }}"
                                    class="form-control" id="alamat" placeholder="Alamat">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input required type="text" name="no_ktp" value="{{ $pasien->no_ktp }}"
                                    class="form-control" id="no_ktp" placeholder="No KTP">
                                @error('no_ktp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input required type="text" name="no_hp" value="{{ $pasien->no_hp }}"
                                    class="form-control" id="no_hp" placeholder="No HP">
                                @error('no_hp')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_rm">No RM</label>
                                <input required type="text" name="no_rm" value="{{ $pasien->no_rm }}"
                                    class="form-control" value="{{ $pasien->no_rm }}" id="no_rm"
                                    placeholder="No RM">
                                @error('no_rm')
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
        <div class="modal fade" id="hapusModal{{ $pasien->id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('pasien.destroy', ['id' => $pasien->id]) }}" method="POST">
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
