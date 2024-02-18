@extends('template.master')
<title>Laporan Cuti</title>
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
                    <li class="breadcrumb-item active">Laporan Cuti</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Laporan Cuti
        </div>
        <div class="card-body">

            <!-- <a class="btn btn-sm btn-primary mb-2" href="" target="_blank"><i class="fas fa-print"></i> Cetak laporan </a> -->

            <form action="{{route('laporancuti')}}" method="get">
            {{ csrf_field() }}
                <div class="form-row">
                    <div class="col">
                        <input type="date" class="form-control" name="awal" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="akhir" placeholder="Last name">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </div>
            </form>


            <table id="laporan" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            Submission Date
                        </th>
                        <th>
                            Employee
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Estimated
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuti as $c)
                    <tr>
                        <td>
                            {{date('l', strtotime($c->waktu_pengajuan))}} - {{date('l', strtotime($c->waktu_selesai))}}
                            <br>
                            <small>{{date('F d, Y', strtotime($c->waktu_pengajuan))}} s/d {{date('F d, Y', strtotime($c->waktu_selesai))}}</small>
                        </td>
                        <td>
                            {{$c->user->employee->nama}}
                            <br>
                            <small>{{$c->user->employee->bagian->nama_jabatan}}</small>
                        </td>
                        <td>
                            {{$c->jenis_cuti}} {{$c->alasan}}
                            <br>
                            <small><a target="_blank" href="{{ asset('/fotocuti/'.$c->foto) }}"><i class="flaticon-381-link"></i>&nbsp;Attachment file</a></small>
                        </td>
                        @php
                        $tgl1 = new DateTime($c->waktu_pengajuan);
                        $tgl2 = new DateTime($c->waktu_selesai);
                        $selisih = $tgl2->diff($tgl1);
                        @endphp
                        <td>
                            {{$selisih->days}} hari
                            <br>
                            <small>Perkiraan waktu cuti</small>
                        </td>
                        <td>
                            @if($c->status == '0')
                            <font color="orange">”Menunggu persetujuan”</font>
                            @elseif($c->status == '1')
                            <font color="green">”Approved”</font>
                            @else
                            <font color="red">”Rejected”</font>
                            @endif
                            <br>
                            @if($c->status == '0')
                            <small>Waiting for approval</small>
                            @elseif($c->status == '1')
                            <small>You have agreed to the submission</small>
                            @else
                            <small>You have rejected the submission</small>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#laporan').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 6,
        });
    });
</script>
@endsection