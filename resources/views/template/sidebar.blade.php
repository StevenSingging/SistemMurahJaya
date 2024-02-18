<li class="nav-header">MAIN NAVIGATION</li>
@if(auth()->user()->role == "Admin")
<li class="nav-item">
  <a href="{{route('dashboard.admin')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
    <i class="nav-icon fas fa-home-alt"></i>
    <p>
      Beranda

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('pegawai.admin')}}" class="nav-link {{ (request()->segment(1) == 'pegawai') ? 'active' : '' }}">
    <i class="nav-icon fa-solid fa-users"></i>
    <p>
      Pegawai

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('jabatan.admin')}}" class="nav-link {{ (request()->segment(1) == 'jabatan') ? 'active' : '' }}">
    <i class="nav-icon fa-solid fa-user-tie"></i>
    <p>
      Jabatan

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('absensi.admin')}}" class="nav-link {{ (request()->segment(1) == 'absensi') ? 'active' : '' }}">
    <i class="nav-icon fa-solid fa-user-slash"></i>
    <p>
      Absensi

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('cuti.admin')}}" class="nav-link {{ (request()->segment(1) == 'cuti') ? 'active' : '' }}">
    <i class="nav-icon fa-solid fa-user-clock"></i>
    <p>
      Cuti Kerja

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('payroll.admin')}}" class="nav-link {{ (request()->segment(1) == 'payroll') ? 'active' : '' }}">
    <i class="nav-icon fas fa-money-bill-alt"></i>
    <p>
      Payroll

    </p>
  </a>
</li>

<li class="nav-item has-treeview {{ (request()->segment(1) == 'laporanabsen') || (request()->segment(1) == 'laporancuti') || (request()->segment(1) == 'laporangaji') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-print"></i>
    <p>
      Laporan
      <i class="fas fa-angle-left right"></i>
      
    </p>
  </a>
  <ul class="nav nav-treeview " >
    <li class="nav-item">
      <a href="{{route('laporanabsen')}}" class="nav-link {{ (request()->segment(1) == 'laporanabsen') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Laporan Absensi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('laporancuti')}}" class="nav-link {{ (request()->segment(1) == 'laporancuti') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Laporan Cuti</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('laporangaji')}}" class="nav-link {{ (request()->segment(1) == 'laporangaji') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Laporan Gaji</p>
      </a>
    </li>

  </ul>
</li>
@endif

@if(auth()->user()->role == "Pegawai")
<li class="nav-item">
  <a href="{{route('dashboard.karyawan')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
    <i class="nav-icon fas fa-home-alt"></i>
    <p>
      Beranda

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('daftarabsen.karyawan')}}" class="nav-link {{ (request()->segment(1) == 'daftarabsen') ? 'active' : '' }}">
  <i class="nav-icon fa-solid fa-user-slash"></i>
    <p>
      Riwayat Absensi

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('daftarcuti.karyawan')}}" class="nav-link {{ (request()->segment(1) == 'daftarcuti') ? 'active' : '' }}">
  <i class="nav-icon fa-solid fa-user-clock"></i>
    <p>
      Cuti Kerja

    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{route('daftarpayroll.karyawan')}}" class="nav-link {{ (request()->segment(1) == 'daftarpayroll') ? 'active' : '' }}">
    <i class="nav-icon fas fa-money-bill-alt"></i>
    <p>
      Payroll

    </p>
  </a>
</li>

<!-- <li class="nav-item">
  <a href="{{route('dashboard.karyawan')}}" class="nav-link {{ (request()->segment(1) == 'riwayatabsen') ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      History Pembayaran

    </p>
  </a>
</li> -->

@endif
<!-- <li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link" onclick="return confirm('Apakah Anda yakin akan logout ?')">
        <i class="nav-icon fas fa-right-from-bracket"></i>
        <p>
          Logout

        </p>
      </a>
</li> -->