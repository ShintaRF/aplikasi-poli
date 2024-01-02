<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sistem Temu Janji Pasien</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('OnePage/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('OnePage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('OnePage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('OnePage/assets/css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <main id="main">
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="mb-5 col-xl-7 col-lg-9 text-center">
                        <h1>Pendaftaran Poliklinik</h1>
                        <h2>Sistem Temu Janji Pasien - Dokter</h2>
                    </div>

                    <div class="card p-0">
                        <div class="card-header bg-secondary text-white">
                            <h3 class="card-title text-bold">
                                Daftar Poli
                            </h3>
                        </div>
                        <form action="{{ route('pasien.daftarpoli.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_rm">Nomor Rekam Medis</label>
                                    <input required type="text" name="no_rm" class="form-control" id="no_rm"
                                        placeholder="Nomor Rekam Medis" value="{{ $pasien->no_rm }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="id_poli">Pilih Poli</label>
                                    <select required name="id_poli" id="id_poli" class="form-control">
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach ($polis as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_poli')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_jadwal">Pilih Jadwal</label>
                                    <select required name="id_jadwal" id="id_jadwal" class="form-control" disabled>
                                        <option value="">-- Pilih Jadwal --</option>
                                    </select>
                                    @error('id_jadwal')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keluhan">Keluhan</label>
                                    <textarea class="form-control" name="keluhan" id="keluhan" cols="30" rows="10"
                                        placeholder="Mohon tuliskan keluhan anda disini"></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                                <a href="/pasien/logout">
                                    <button class="logout-style btn btn-danger" data-toggle="tooltip"
                                        data-placement="top" title="Logout" type="button">
                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Keluar
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
        </section><!-- End Hero -->
    </main><!-- End #main -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script>
        $('#id_poli').on('change', function() {
            var poliID = $(this).val();

            $('#id_jadwal').prop('disabled', true);

            $.get('/getJadwals', {
                id_poli: poliID
            }, function(data) {

                $('#id_jadwal').empty();

                $('#id_jadwal').prop('disabled', data.length === 0);

                if (data.length === 0) {
                    $('#id_jadwal').append('<option value="">-- Pilih Jadwal --</option>');
                }

                $.each(data, function(index, jadwal) {
                    $('#id_jadwal').append('<option value="' + jadwal.id + '">' + jadwal.dokter
                        .nama +
                        ' - ' +
                        jadwal.hari + ' (' + jadwal.jam_mulai + '-' + jadwal.jam_selesai + ')' +
                        '</option>');
                });
            });

        });
    </script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('OnePage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('OnePage/assets/js/main.js') }}"></script>

</body>

</html>
