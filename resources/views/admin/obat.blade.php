@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Obat</h1>
                    <form action="{{ route('obat.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nama">Nama Obat</label>
                                <input required type="text" name="nama_obat" class="form-control" id="nama"
                                    placeholder="Nama Obat">
                                @error('nama_obat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kemasan">Kemasan</label>
                                <input required type="text" name="kemasan" class="form-control" id="kemasan"
                                    placeholder="Kemasan">
                                @error('kemasan')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input required type="text" oninput="numberOnly(this.id);" name="harga"
                                    class="form-control" id="harga" placeholder="Harga" maxlength="10">
                                @error('harga')
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
                            <h3 class="card-title">Obat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obats as $obat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $obat->nama_obat }}</td>
                                            <td>{{ $obat->kemasan }}</td>
                                            <td>{{ $obat->harga }}</td>
                                            <td>
                                                <button data-toggle="modal" data-target="#editModal{{ $obat->id }}"
                                                    class="btn btn-success">Ubah</button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusModal{{ $obat->id }}">
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
    @foreach ($obats as $obat)
        <div class="modal fade" id="editModal{{ $obat->id }}" tabindex="-1" role="dialog"
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
                        <form id="editForm" method="POST" action="{{ route('obat.update', ['id' => $obat->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Obat</label>
                                <input required type="text" name="nama_obat" value="{{ $obat->nama_obat }}"
                                    class="form-control" id="nama" placeholder="Nama Obat">
                                @error('nama_obat')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kemasan">Kemasan</label>
                                <input required type="text" name="kemasan" value="{{ $obat->kemasan }}"
                                    class="form-control" id="kemasan" placeholder="Kemasan">
                                @error('kemasan')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input required type="text" oninput="numberOnly(this.id);" name="harga"
                                    value="{{ $obat->harga }}" class="form-control" id="harga" placeholder="Harga"
                                    maxlength="10">
                                @error('harga')
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
        <div class="modal fade" id="hapusModal{{ $obat->id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('obat.destroy', ['id' => $obat->id]) }}" method="POST">
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
