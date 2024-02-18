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
                    <li class="breadcrumb-item active">Detail Pegawai</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body px-3 pt-3 pb-0">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('/fotopegawai/'.$peg->foto) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$peg->nama}}</a>
                        </span>
                        <span class="description">FrontLiner</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">

                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Informasi Pribadi</h4>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Nama <span class="float-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$peg->nama}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">NIK KTP <span class="float-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$peg->nik}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Tempat,Tanggal Lahir <span class="float-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$peg->tempat_lahir}},{{date('d M Y', strtotime($peg->tgl_lahir))}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Gender <span class="float-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$peg->jenis_kelamin}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Agama <span class="float-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7">{{$peg->agama}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Email <span class="float-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7">{{$peg->user->email}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Ketersediaan <span class="float-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$peg->status_pegawai}}</span>
                                            </div>
                                        </div>
                                        <?php
                                        $dateOfBirth = new DateTime(date('Y-m-d', strtotime($peg->tgl_lahir)));
                                        $currentDate = new DateTime(date('Y-m-d'));
                                        $interval = $dateOfBirth->diff($currentDate);
                                        $age = $interval->y;
                                        ?>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Umur <span class="float-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$age}} tahun</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Alamat <span class="float-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7">
                                                <span>{{$peg->alamat}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="replyModal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Post Reply</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <textarea class="form-control" rows="4">Message</textarea>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Rincian Pembayaran Terbaru</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table shadow-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Payment No.</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Type of payment</th>
                                    <th scope="col">Payment date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection