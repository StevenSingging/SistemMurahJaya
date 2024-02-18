@extends('template.master')
<title>Laporan Absensi</title>
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
                    <li class="breadcrumb-item active">Laporan Absensi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Laporan Absensi
        </div>
        <div class="card-body">

            <!-- <a class="btn btn-sm btn-primary mb-2" href="" target="_blank"><i class="fas fa-print"></i> Cetak laporan </a> -->

            <form action="{{route('laporanabsen')}}" method="get">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col">
                        <input type="date" class="form-control" name="awal" placeholder="First name" value="{{ old('awal') }}">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="akhir" placeholder="Last name" value="{{ old('akhir') }}">
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
                            Date
                        </th>
                        <th>
                            Employee
                        </th>
                        <th>
                            Distance
                        </th>
                        <th>
                            Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absent as $a)
                    <tr>
                        <td>
                            {{date('l',strtotime($a->waktu))}}
                            <br>
                            <small>{{date('F d, Y',strtotime($a->waktu))}}</small>
                        </td>
                        <td>
                            {{$a->user->employee->nama}}
                            <br>
                            <small>{{$a->user->employee->bagian->nama_jabatan}}</small>
                        </td>
                        <td>
                            @if($a->keterangan == 'masuk')
                            <font color="green">Masuk</font>
                            @else
                            <font color="red">Keluar</font>
                            @endif
                            <br>
                            <small>
                                @if($a->keterangan == 'masuk')
                                Absent In
                                @else
                                Absent Out
                                @endif
                            </small>
                        </td>
                        <td>
                            {{date('H:i:s', strtotime($a->waktu))}}
                            <br>
                            <small>Target 480 mins</small>
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