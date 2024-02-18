@extends('template.master')
<title>Payroll</title>
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
                    <li class="breadcrumb-item active">Payroll</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-shop"></i> Toko Murah Jaya
                            <small class="float-right">Date: {{$payroll->tgl_payroll}}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Toko Murah Jaya</strong><br>
                            Jl. Menteri Supeno No.114, Pandeyan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55161
                            <br>
                            Phone: 0851-5694-0559<br>
                            Email: murahjayayogyakarta@gmail.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{$payroll->pegawai->nama}}</strong><br>
                            {{$payroll->pegawai->alamat}}<br>
                            Phone: {{$payroll->pegawai->no_hp}}<br>
                            Email: {{$payroll->pegawai->user->email}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Payment Number #{{$payroll->kode_payroll}}</b><br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-6 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3" style="background-color:crimson; text-align:center; color:white">ALLOWANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width:50%">Gaji Pokok x 6 hari</th>
                                    <td>Rp. {{number_format($payroll->pegawai->bagian->gaji_pokok * 6, 0, ',', '.') }} </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Tunjangan</th>
                                    @if($payroll->tunjangan == null)
                                    <td> 0 </td>
                                    @else
                                    <td>Rp. {{number_format($payroll->tunjangan, 0, ',', '.') }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td>Rp. {{number_format(($payroll->pegawai->bagian->gaji_pokok*6) + $payroll->tunjangan, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    <div class="col-6 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3" style="background-color:crimson; text-align:center; color:white">DEDUCTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width:50%">Potongan Alpha:</th>
                                    <td>Rp. {{number_format($payroll->alpha*$payroll->pegawai->bagian->gaji_pokok, 0, ',', '.') }} </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td>Rp. {{number_format($payroll->alpha*$payroll->pegawai->bagian->gaji_pokok, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-6 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="background-color:crimson; text-align:center; color:white">TAKE HOME PAY</th>
                                    <th style="background-color:crimson; text-align:center; color:white">Rp. {{number_format($payroll->gaji_total, 0, ',', '.') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width:50%">Ditransfer Ke:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="width:50%">No A/C:</th>
                                    <td>{{$payroll->pegawai->norek}} / {{$payroll->pegawai->nama_rek}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- accepted payments column -->

                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<script>
    window.print();
</script>
@endsection