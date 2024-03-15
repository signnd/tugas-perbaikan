@extends('layout.app')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Content Wrapper. Berisi konten di dalam halaman -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('perbaikan.index') }}">Dashboard</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <!-- <h3 class="card-title text-lg">Tabel Perbaikan</h3> -->
            <a href="{{ route('perbaikan.create') }}" class="btn btn-success btn-md">Tambah</a>
            <div class="card-tools">
              <div class="input-group input-group-sm py-2" style="width: 300px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
                <!-- <a class="btn btn-primary text-white" href="{{ route('perbaikan.create') }}">
                  <i class="fa-solid fa-pen-to-square"></i>Tambah baru</a> -->
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive-xxl">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Tanggal Laporan</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                @forelse ($listperbaikan as $list)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $list->judul }}</td>
                <td>{{ $list->keterangan }}</td>
                <td>{{ $list->created_at }}</td>
                <td>{{ $list->status }}</td>
                <td>
                  <a href="{{ route('perbaikan.show', ['id' => $list->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-eye"></i> Lihat</a>
                  <a href="{{ route('perbaikan.edit', ['id' => $list->id]) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-pen-square"></i> Edit</a>
                  <a href="#" class="btn btn-sm btn-danger" onclick="
                    event.preventDefault();
                    if (confirm('Anda yakin ingin menghapus data?')) {
                      document.getElementById('delete-row-{{ $list->id }}').submit();
                    }">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                  <form id="delete-row-{{ $list->id }}" action="{{ route('perbaikan.destroy', ['id' => $list->id]) }}" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                  </form>
              </tr>
              @empty
              <tr>
                <td colspan="5">Data kosong</td>
              </tr>
              @endforelse
            </table>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
