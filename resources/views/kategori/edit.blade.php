 @extends('layouts.master')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Jenis Surat</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data Jenis Surat</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>

         @if (Session::has('edit'))
          <div class="alert alert-success alert-dismissible">{{Session::get('edit')}}</div>
          @endif

        
        <form action="{{route('kategori.update',$kategori->id)}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="card-body">
        
          <?php echo csrf_field();?>
            <div class="form-group">
              <label for="">Jenis Surat <sup>*</sup></label>
              <input type="text" name="nama" class="form-control" value="{{$kategori->nama}}">
               <span class="help-block text-danger">{{$errors->first('nama')}}</span>
            </div>
        
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <a href="{{route('kategori.index')}}" class="btn btn-danger">Kembali</a>
        </div>
        <!-- /.card-footer-->
      </div>
      </form>
      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection