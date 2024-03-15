@extends('layout.app')
@section('content')
<body class="sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('perbaikan.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Perbaikan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container px-3">
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>
        </div>
        <!-- /.card-header -->
      <!-- form start -->
      <form method="post" action="{{ route('perbaikan.update', $listperbaikan->id) }}" enctype="multipart/form-data">
        @method('PUT')  
        @csrf
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <div class="alert-title"><h4>Ada kesalahan</h4></div>
                Mohon maaf, ada kesalahan dalam penginputan data.
              <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
              </ul>
            </div> 
          @endif
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $listperbaikan->judul) }}" placeholder="Masukkan judul">
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Tulis keterangan lebih lanjut tentang kerusakan...">{{ old('keterangan', $listperbaikan->keterangan) }}</textarea>
            </div>
            <div class="form-group">
              <label for="eviden">Tambah eviden baru</label>
              <div class="row">
                <div class="col">
                  @if ($listperbaikan->eviden)
                  @foreach($listperbaikan->eviden as $image)
                  <a href="{{ asset('storage/eviden/'.$image->filename) }}" target="_blank">
                  <img src="{{ asset('storage/eviden/'.$image->filename) }}" style="width:100px; height:100px">
                  </a>
                  @endforeach
                @endif
                </div>
              </div>
            </div>
              <input type="file" class="form-control" id="photo" name="photo[]" multiple>
            </div>
            <div class="px-3">
              <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
      </form>
      <!-- /.card-body -->
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
<!-- ./wrapper -->
</div>