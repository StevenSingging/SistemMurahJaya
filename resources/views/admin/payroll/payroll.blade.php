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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center mr-3">
                <span class="p-sm-3 p-2 mr-sm-3 mr-2 rounded-circle bg-primary">
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
                <h4 class="fs-20 text-black mb-0">Riwayat Payroll</h4>

            </div>
            <a href="{{route('tambahpayroll')}}" class="btn btn-success btn-sm" role="button" style="float:right;"><span class="fa-solid fa-plus" aria-hidden="true"></span> Tambah Payroll</a>

        </div>

        <div class="card-body">
            <table id="payroll" class="table table-bordered table-hover">
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
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payroll as $row)
                    <tr>
                        <td>
                            <a>
                                {{date('l', strtotime($row->tgl_payroll))}}
                            </a>
                            <br />
                            <small>
                                {{date('F d, Y', strtotime($row->tgl_payroll))}}
                            </small>
                        </td>
                        <td>
                            <a>
                                #PAY ID
                            </a>
                            <br />
                            <small>
                                {{ucfirst($row->kode_payroll)}}
                            </small>
                        </td>
                        <td>
                            <a>
                                {{ucfirst($row->pegawai->nama)}}
                            </a>
                            <br />
                            <small>
                                {{ucfirst($row->nama_jabatan)}}
                            </small>
                        </td>
                        <td>
                            <a>
                                Rp. {{number_format($row->gaji_total, 0, ',', '.')}}
                            </a>
                            <br />
                            <small>
                                <span class="fs-14">
                                    <i class="fas fa-check-circle"></i>&nbsp; termasuk potongan
                                </span>
                            </small>
                        </td>
                        <td>
                            <a>
                                {{date('H:i:s', strtotime($row->waktu_payroll))}}
                            </a>
                            <br />
                            <small>
                                <i class="fas fa-check-circle"></i>&nbsp; transaksi berhasil
                            </small>
                        </td>
                        <td>
                            <a href="{{route('slippayroll',$row->id)}}" class="btn btn-success" role="button"><span class="fa-solid fa-print" aria-hidden="true"></span></a>
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
        $('#payroll').DataTable({
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