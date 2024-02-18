@extends('template.master')
<title>Pegawai</title>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Pegawai</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Pegawai</h3>
        </div>
        <!-- /<div class="card-body p-0">
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#pribadi">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pribadi" id="pribadi-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">Data Pribadi</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#pegawai-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pegawai-part" id="pegawai-part-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Kepegawaian</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#payroll-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="payroll-part" id="payroll-paart-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">Payroll</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#akun-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="akun-part" id="akun-part-trigger">
                            <span class="bs-stepper-circle">4</span>
                            <span class="bs-stepper-label">Akun</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form action="{{route('simpanpegawai')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div id="pribadi" class="content" role="tabpanel" aria-labelledby="pribadi-trigger">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>NIK KTP <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nik" placeholder="Masukkan nomor KTP">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama lengkap <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tempat lahir <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal lahir <small class="text-danger">*</small></label>
                                        <input type="date" name="tgl_lahir" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Jenis kelamin <small class="text-danger">*</small></label>
                                        <select class="form-control" name="jenis_kelamin">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Agama <small class="text-danger">*</small></label>
                                        <select class="form-control" name="agama">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Alamat <small class="text-danger">*</small></label>
                                        <textarea name="alamat" class="form-control"></textarea>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <div id="pegawai-part" class="content" role="tabpanel" aria-labelledby="pegawai-part-trigger">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nomor kepegawaian <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nip" placeholder="Masukkan nip pegawai">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Profile photo <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status <small class="text-danger">*</small></label>
                                        <select class="form-control" name="status_pegawai">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="permanent employee">permanent employee</option>
                                            <option value="contract employee">contract employee</option>
                                            <option value="probationary employee">probationary employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal bergabung <small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d'); ?>" placeholder="Masukkan tempat lahir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Bagian <small class="text-danger">*</small></label>
                                        <select class="form-control" name="id_bagian">
                                            <option hidden>Silahkan pilih</option>
                                            @foreach($jabatan as $j)
                                            <option value="{{$j->id}}">{{$j->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="email" placeholder="Masukkan email aktif">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nomor telp <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="no_hp" placeholder="Masukkan nomor telp">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <div id="payroll-part" class="content" role="tabpanel" aria-labelledby="payroll-part-trigger">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nomor Rekening <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="email" placeholder="Masukkan nomor rekening">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama Akun Rekening <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="no_hp" placeholder="Masukkan nama akun rekening">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <div id="akun-part" class="content" role="tabpanel" aria-labelledby="akun-part-trigger">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Username <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="username" placeholder="Masukkan username">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Password <small class="text-danger">*</small></label>
                                    <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirm password <small class="text-danger">*</small></label>
                                    <input type="password" class="form-control" name="confpassword" placeholder="Ulangi password">
                                </div>
                            </div>
                            <p class="text-danger"><small class="text-danger">*</small><small>Catatan : digunakan untuk kebutuhan login pegawai agar dapat masuk ke halaman dashboard.</small>
                            </p>
                            <br>
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>-->
        <div class="card-body">
            <div class="default-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home"><i class="la la-user mr-2"></i> Data Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile"><i class="la la-briefcase mr-2"></i> Kepegawaian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#payroll"><i class="la la-key mr-2"></i> Payroll</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#message"><i class="la la-key mr-2"></i> Akun</a>
                    </li>
                </ul>
                <form action="{{route('simpanpegawai')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>NIK KTP <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nik" placeholder="Masukkan nomor KTP">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama lengkap <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tempat lahir <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal lahir <small class="text-danger">*</small></label>
                                        <input type="date" name="tgl_lahir" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Jenis kelamin <small class="text-danger">*</small></label>
                                        <select class="form-control" name="jenis_kelamin">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Agama <small class="text-danger">*</small></label>
                                        <select class="form-control" name="agama">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Alamat <small class="text-danger">*</small></label>
                                        <textarea name="alamat" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nomor kepegawaian <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nip" placeholder="Masukkan nip pegawai">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Profile photo <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status <small class="text-danger">*</small></label>
                                        <select class="form-control" name="status_pegawai">
                                            <option hidden>Silahkan pilih</option>
                                            <option value="permanent employee">permanent employee</option>
                                            <option value="contract employee">contract employee</option>
                                            <option value="probationary employee">probationary employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal bergabung <small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d'); ?>" placeholder="Masukkan tempat lahir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Bagian <small class="text-danger">*</small></label>
                                        <select class="form-control" name="id_bagian">
                                            <option hidden>Silahkan pilih</option>
                                            @foreach($jabatan as $j)
                                            <option value="{{$j->id}}">{{$j->nama_jabatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="email" placeholder="Masukkan email aktif">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nomor telp <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="no_hp" placeholder="Masukkan nomor telp">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payroll">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nomor Rekening <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="norek" placeholder="Masukkan nomor rekening">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama Akun Rekening <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="nama_rek" placeholder="Masukkan nama akun rekening">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="message">
                            <div class="pt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Username <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="username" placeholder="Masukkan username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password <small class="text-danger">*</small></label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                                    </div>
                                </div>
                                <p class="text-danger"><small class="text-danger">*</small><small>Catatan : digunakan untuk kebutuhan login pegawai agar dapat masuk ke halaman dashboard.</small>
                                </p>
                                <br>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
</script>
@endsection