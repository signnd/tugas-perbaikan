<!-- untuk memakai icon, cocokkan nama icon di fontawesome dengan icon yang tersedia di 
public\adminlte\plugins\fontawesome-free\css\all.css -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Informasi pengguna di idebar -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Widget pencarian (search) di sidebar -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Menu Navigasi Sidebar -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('perbaikan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-house"></i>
              <p>Halaman utama</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('perbaikan.create') }}" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>Tambah data baru</p>
            </a>
        </li>
        </ul>
      </nav>
      <!-- akhir menu sidebar -->
    </div>
    <!-- akhir sidebar -->
</aside>