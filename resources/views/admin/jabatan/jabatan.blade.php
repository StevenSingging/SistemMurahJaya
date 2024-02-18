@extends('template.master')
<title>Jabatan</title>
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
                    <li class="breadcrumb-item active">Jabatan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><span class="fa-solid fa-plus" aria-hidden="true"></span>
                Tambah Jabatan
            </button>
            <table id="pegawai" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Jabatan
                        </th>
                        <th>
                            Gaji Pokok (Rp)
                        </th>
                        <th>
                            Tunjangan (Rp)
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($jbt as $jb)
                    <tr>
                        <td scope="row">{{ $no++ + ($jbt->currentPage() - 1) * $jbt->perPage() }}</td>
                        <td>{{$jb->nama_jabatan}}</td>
                        <td>{{number_format($jb->gaji_pokok, 0, ',', '.')}}</td>
                        <td>{{number_format($jb->tunjangan, 0, ',', '.')}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$jb->id}}"><span class="fa-solid fa-edit" aria-hidden="true"></span></button>
                            <a href="{{route('hapus.jabatan',$jb->id)}}" class="btn btn-danger btn-sm" role="button"><span class="fa-solid fa-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit{{$jb->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('update.jabatan',$jb->id)}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Nama jabatan</label>
                                                <input type="text" class="form-control" name="nama_jabatan" value="{{$jb->nama_jabatan}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Gaji pokok (Rp)</label>
                                                <input type="number" class="form-control" name="gaji_pokok" value="{{$jb->gaji_pokok}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Tunjangan (Rp)</label>
                                                <input type="number" class="form-control" name="tunjangan" value="{{$jb->tunjangan}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('simpanjabatan')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Nama jabatan</label>
                                    <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gaji pokok (Rp)</label>
                                    <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tunjangan (Rp)</label>
                                    <input type="number" class="form-control" name="tunjangan" id="tunjangan">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
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