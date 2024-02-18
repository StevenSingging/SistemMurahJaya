@extends('template.master')
<title>Dashboard</title>
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

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-6 col-sm-6">
            @if($data['waktu'] != 'dilarang' && $data['waktu'] != 'tutup' && $data['waktu'] != 'cuti')
            <div class="alert alert-success alert-dismissible alert-alt fade show">
                <i class="fas fa-bell"></i>&nbsp; <strong>{{auth()->user()->employee->nama}}</strong>, Anda hari ini belum melakukan absen <b>{{ucfirst($data['waktu'])}}</b>.
            </div>
            @elseif($data['waktu'] == 'tutup')
            <div class="alert alert-danger alert-dismissible alert-alt fade show">
                <i class="fas fa-bell"></i>&nbsp; <strong>{{auth()->user()->employee->nama}}</strong>, Maaf hari ini absen telah ditutup.
            </div>
            @elseif($data['waktu'] == 'cuti')
            <div class="alert alert-danger alert-dismissible alert-alt fade show">
                <i class="fas fa-bell"></i>&nbsp; <strong>{{auth()->user()->employee->nama}}</strong>, Maaf hari ini anda cuti.
            </div>
            @else
            <div class="alert alert-primary alert-dismissible alert-alt fade show">
                <i class="fas fa-thumbs-up"></i>&nbsp; <strong>{{auth()->user()->employee->nama}}</strong>, Terimakasih Anda sudah melakukan absen Masuk dan Pulang.
            </div>
            @endif
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="card overflow-hidden">
                <form method="POST" action="{{route('absen')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="text-center">
                            <div class="profile-photo">
                                <img src="{{ asset('/fotopegawai/'.auth()->user()->employee->foto) }}" width="100" class="img-fluid rounded-circle" style="float: left;" alt="">
                            </div>
                            <h3 class="mt-3 mb-1">{{auth()->user()->employee->nama}}</h3>

                            <p class="text-muted">{{date('l')}}</p>
                            
                            <div id="MyClockDisplay" class="clock" style="font-size: 20px;" onload="showTime()"></div>

                            @if($data['waktu'] != 'dilarang' &&  $data['waktu'] != 'tutup' &&  $data['waktu'] != 'cuti')
                            <button class="btn btn-outline-primary btn-rounded mt-3 px-5">Absen {{ucfirst($data['waktu'])}}</button>
                            <input type="hidden" name="ket" id="ket" value="{{$data['waktu']}}">
                            <input type="hidden" name="by" id="by" value="{{date('Y-m-d')}}">
                            @endif
                        </div>
                    </div>

                    <!-- <div class="card-footer pt-0 pb-0 text-center">
                        <div class="row">
                            <div class="col-6 pt-3 pb-3 border-right">
                                <h3 class="mb-1">{{$countabsen}}</h3><span>Absen</span>
                            </div>
                            <div class="col-6 pt-3 pb-3 border-right">
                                <h3 class="mb-1">{{$countcuti}}</h3><span>Cuti</span>
                            </div>

                        </div>
                    </div> -->
            </div>
        </div>
        <div class="col-xl-8 col-xxl-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center mr-3">
                        <span class="p-sm-3 p-2 mr-sm-3 mr-2 rounded-circle bg-success">
                            <svg width="25" height="25" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip2)">
                                    <path d="M14.9993 7.49987C17.0704 7.49987 18.7493 5.82097 18.7493 3.74993C18.7493 1.6789 17.0704 0 14.9993 0C12.9283 0 11.2494 1.6789 11.2494 3.74993C11.2494 5.82097 12.9283 7.49987 14.9993 7.49987Z" fill="#fff" />
                                    <path d="M22.2878 27.2871L17.6697 29.0191L19.9663 29.8803C20.9546 30.2473 22.021 29.7388 22.3804 28.7826C22.5718 28.2725 22.5152 27.7381 22.2878 27.2871Z" fill="#fff" />
                                    <path d="M6.28312 20.7436C5.31545 20.3847 4.23328 20.8718 3.86895 21.8412C3.50549 22.8108 3.99715 23.891 4.96658 24.2554L6.98941 25.0139L12.3298 23.011L6.28312 20.7436Z" fill="#fff" />
                                    <path d="M26.1303 21.8413C25.7659 20.8717 24.6838 20.3847 23.7162 20.7436L8.71647 26.3685C7.74692 26.7329 7.25532 27.8132 7.61878 28.7827C7.97813 29.7386 9.0443 30.2474 10.033 29.8804L25.0326 24.2555C26.0022 23.8911 26.4938 22.8108 26.1303 21.8413Z" fill="#fff" />
                                    <path d="M28.1244 14.9997H23.6585L20.4268 8.53623C20.0909 7.86516 19.4077 7.48284 18.7036 7.49989L14.9993 7.49987L11.2954 7.49989C10.5914 7.48284 9.90912 7.86522 9.5725 8.53623L6.34077 14.9997H1.87494C0.83953 14.9997 0 15.8392 0 16.8746C0 17.9101 0.83953 18.7496 1.87494 18.7496H7.49981C8.21026 18.7496 8.85936 18.3486 9.177 17.7132L11.2497 13.5679V20.6038L14.9995 22.0099L18.7496 20.6034V13.5679L20.8222 17.7132C21.1399 18.3486 21.789 18.7496 22.4994 18.7496H28.1243C29.1597 18.7496 29.9992 17.9101 29.9992 16.8746C29.9992 15.8392 29.1598 14.9997 28.1244 14.9997Z" fill="#fff" />
                                </g>
                                <defs>
                                    <clipPath id="clip2">
                                        <rect width="30" height="30" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <h2 class="fs-20 text-black mb-0">Absensi Terkini</h2>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table shadow-hover">
                            <thead>
                                <tr>
                                    <th><span class="font-w600 text-black fs-16">Date</span></th>
                                    <th><span class="font-w600 text-black fs-16">Employee</span></th>
                                    <th><span class="font-w600 text-black fs-16">Distance</span></th>
                                    <th><span class="font-w600 text-black fs-16">Time</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absen1 as $row)
                                <tr>
                                    <td>
                                        <p class="text-black mb-1 font-w600">{{date('l', strtotime($row->waktu))}}</p>
                                        <span class="fs-14">{{date('F d, Y', strtotime($row->waktu))}}</span>
                                    </td>
                                    <td>
                                        <p class="text-black mb-1 font-w600">{{$row->user->employee->nama}}</p>
                                        <span class="fs-14">{{$row->user->employee->bagian->nama_jabatan}}</span>
                                    </td>
                                    <td>
                                        <p class="text-black mb-1 font-w600">
                                            @if($row->keterangan == 'masuk')
                                            <font color="green">Masuk</font>
                                            @else
                                            <font color="red">Keluar</font>
                                            @endif
                                        </p>
                                        <span class="fs-14">
                                            @if($row->keterangan == 'masuk')
                                            Absent In
                                            @else
                                            Absent Out
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-black mb-1 font-w600">{{date('H:i:s', strtotime($row->waktu))}}</p>
                                        <span class="fs-14">
                                            <i class="fas fa-check-circle"></i>&nbsp; Verified
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h;
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " ";
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
</script>
@endsection