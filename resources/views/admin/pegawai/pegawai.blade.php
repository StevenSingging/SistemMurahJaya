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
                    <li class="breadcrumb-item active">Pegawai</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="{{route('tambahpegawai')}}" class="btn btn-primary btn-sm" role="button"><span class="fa-solid fa-plus" aria-hidden="true"></span> Tambah Pegawai</a>
            <table id="pegawai" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Gender
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Telp
                        </th>
                        <th>
                            Bergabung
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($pegawai as $p)
                    <tr>
                        <td scope="row">{{ $no++ + ($pegawai->currentPage() - 1) * $pegawai->perPage() }}</td>
                        <td>{{$p->nama}}</td>
                        <td>{{$p->jenis_kelamin}}</td>
                        <td>{{$p->user->email}}</td>
                        <td>{{$p->no_hp}}</td>
                        <td>{{date('d M Y', strtotime($p->tgl_masuk))}}</td>
                        <td>
                            <a href="{{route('detailpegawai',$p->id)}}" class="btn btn-success btn-sm" role="button"><span class="fa-solid fa-user" aria-hidden="true"></span></a>
                            <a href="{{route('hapuspegawai',$p->id)}}" class="btn btn-danger btn-sm" role="button"><span class="fa-solid fa-trash" aria-hidden="true"></span></a>

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
        $('#pegawai').DataTable({
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