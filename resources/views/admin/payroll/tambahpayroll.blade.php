@extends('template.master')
<title>Tambah Payroll</title>
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
                    <li class="breadcrumb-item active">Tambah Payroll</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-7 order-md-1">
                            <h4 class="mb-3">Perhitungan gaji</h4>
                            <hr>
                            <br>
                            <form action="{{route('simpanpayroll')}}" method="post" class="needs-validation" novalidate="">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">Payment date</label>
                                        <input type="hidden" class="form-control" name="kode_payroll" value="TR<?= mt_rand(100000000000, 999999999999) ?>" maxlength="30">
                                        <input type="date" class="form-control" name="tgl_payroll" value="<?php echo date("Y-m-d"); ?>" required="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">Payment time</label>
                                        <input type="time" class="form-control" name="waktu_payroll" placeholder="" value="<?php echo date("H:i"); ?>" required="">
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="username">Employees</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <select name="id_pegawai" id="id_pegawai" class="form-control">
                                            <option selected value="">Pilih Pegawai</option>
                                            @foreach($pegawai as $p)
                                            <option value="{{$p->id}}">{{$p->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_bagian">Position</label>
                                    <input type="text" name="nama_jabatan" id="id_bagian" class="form-control" readonly>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label for="country">Salary</label>
                                        <input type="hidden" name="gaji" class="form-control" readonly>
                                        <input type="text" name="gaji_pokok" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label for="state">Allowance</label>
                                        <input type="hidden" name="amount" class="form-control" readonly>
                                        <input type="text" name="tunjangan" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" name="is_active" for="customSwitch1">Allowance</label>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to
                                    checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    $(document).ready(function() {

        $('#id_pegawai').change(function() {
            var id_pegawai = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('autocomplete')}}",
                dataType: "JSON",
                data: {
                    id_pegawai: id_pegawai
                },
                cache: false,
                success: function(data) {
                    if ('id_bagian' in data) {
                        $('#id_bagian').val(data.id_bagian);
                        $('[name="gaji_pokok"]').val(data.gaji_pokok);
                        $('[name="tunjangan"]').val(data.tunjangan);
                    } else {
                        $('[name="id_bagian"]').val('');
                    }
                }
            });
            return false;
        });
    });
</script>
@endsection