@extends('layout.app')
@section('content')
<body class="sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lihat Perbaikan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('perbaikan.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Lihat Perbaikan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title my-1"><strong>{{ $listperbaikan->judul }}</strong></h3>
                <div class="card-tools">
                <div class="btn-group"><a href="{{ route('perbaikan.edit', ['id' => $listperbaikan->id]) }}" class="btn btn-primary">Edit</a></div>
                <div class="btn-group"><button class="btn btn-danger" onclick="
                    event.preventDefault();
                    if (confirm('Anda yakin ingin menghapus data?')) {
                      document.getElementById('delete-row-{{ $listperbaikan->id }}').submit();
                    }">
                    Delete</button>
                    <form id="delete-row-{{ $listperbaikan->id }}" action="{{ route('perbaikan.destroy', ['id' => $listperbaikan->id]) }}" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                  </form></div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-3">Judul</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $listperbaikan->judul }}</div>
                </div>
                <div class="row">
                    <div class="col-3">Keterangan</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $listperbaikan->keterangan }}</div>
                </div>
                <div class="row">
                    <div class="col-3">Tanggal Laporan</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $listperbaikan->created_at }}</div>
                </div>
                <div class="row">
                    <div class="col-3">Diperbarui pada</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $listperbaikan->updated_at }}</div>
                </div>
                <div class="row">
                    <div class="col-3">Status</div>
                    <div class="col-auto">:</div>
                    <div class="col">{{ $listperbaikan->status }}</div>
                </div>
                <div class="row">
                    <div class="col-3">Foto</div>
                    <div class="col-auto">:</div>
                    <div class="col">
                        @if ($listperbaikan->eviden)
                            @foreach($listperbaikan->eviden as $image)
                            <a href="{{ asset('storage/eviden/'.$image->filename) }}" target="_blank">
                            <img src="{{ asset('storage/eviden/'.$image->filename) }}" style="width:100px; height:100px">
                        </a>
                    @endforeach
                  @else
                    <p>Tidak ada gambar</p>
                  @endif
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection