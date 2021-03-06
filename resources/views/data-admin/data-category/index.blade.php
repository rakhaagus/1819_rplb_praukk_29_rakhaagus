@extends('../layouts/app')

@section('title','Data Category | Pizzify')

@section('content')

<div class="container-fluid mb-5" style="min-height: 82.5vh;">
    <div class="row">
      <div class="col-md-3">
        <h3 class=" py-3"><i class="fas fa-th-list mr-2 pt-4 pb-2" style="size: 2px"></i>Category</h3>
      </div>
      <div class="col-md-3 ml-auto pt-4">
          <nav aria-label="breadcrumb" style="color: white">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Master</li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
              </ol>
          </nav>
      </div>
    </div>
    

    <div class="card">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col">
                    <span style="font-size: 18px;">Data Category</span>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#excelModal">
                        Tambah Data Excel
                        </button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Tambah Data
                    </button>
                </div>
            </div>
        </div>
        <div class=" card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Category</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($category as $ctg)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ctg->nama }}</td>
                            <td>
                                <a href="{{ route('category.edit', $ctg->id) }}" class="btn btn-warning btn-md"><i class="fas fa-edit text-white d-inline"></i></a> |
                                @if (Auth::user()->level_id == 1)
                                <a href="{{ route('category.delete', $ctg->id) }}" class="btn btn-danger btn-md" ><i class="fas fa-trash text-white"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

  <!-- Modal create -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.store') }}" method="post">
            @csrf

              {{-- form-group --}}
              <div class="form-group">
                <label for="Nama">Nama Category</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="formGroupExampleInput" value="{{ old('nama') }}">
                @error('nama')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>

              {{-- Footer modal --}}
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Excel -->
  <div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.import') }}" method="post" enctype="multipart/form-data">
            @csrf

              {{-- form-group --}}
              <div class="form-group">
                <label for="Nama">Masukan File Excel</label>
                <input type="file" name="excel" class="form-control @error('excel') is-invalid @enderror" id="formGroupExampleInput" value="{{ old('nama') }}">
                @error('excel')
                    <div id="validationServer03Feedback" class="invalid-feedback">Data Hanya Boleh Berextensi xls</div>
                @enderror
              </div>

              {{-- Footer modal --}}
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@include('sweetalert::alert')

@endsection
