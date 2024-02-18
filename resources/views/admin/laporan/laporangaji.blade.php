@extends('template.master')
<title>Laporan Gaji</title>
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
                    <li class="breadcrumb-item active">Laporan Gaji</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Laporan Gaji
        </div>
        <div class="card-body">

            <!-- <a class="btn btn-sm btn-primary mb-2" href="" target="_blank"><i class="fas fa-print"></i> Cetak laporan </a> -->

            <form action="{{route('laporangaji')}}" method="get">
            {{ csrf_field() }}
                <div class="form-row">
                    <div class="col">
                        <input type="date" class="form-control" name="awal" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control"  name="akhir" placeholder="Last name">
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
                            Transaction ID
                        </th>
                        <th>
                            Employee
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gaji as $g)
                    <tr>
                        <td>
                            {{date('l', strtotime($g->tgl_payroll))}}
                            <br>
                            <small>{{date('F d, Y', strtotime($g->tgl_payroll))}}</small>
                        </td>
                        <td>
                            #PAY ID
                            <br>
                            <small>{{ucfirst($g->kode_payroll)}}</small>
                        </td>
                        <td>
                            {{ucfirst($g->pegawai->nama)}}
                            <br>
                            <small>{{ucfirst($g->nama_jabatan)}}</small>
                        </td>
                        <td>
                            Rp. {{number_format($g->gaji_total, 0, ',', '.')}}
                            <br>
                            <small><i class="fas fa-check-circle"></i>&nbsp; termasuk potongan</small>
                        </td>
                        <td>
                            {{date('H:i:s', strtotime($g->waktu_payroll))}}
                            <br>
                            <small>
                                <i class="fas fa-check-circle"></i>&nbsp; transaksi berhasil
                            </small>
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