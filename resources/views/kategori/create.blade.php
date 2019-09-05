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
          <h3 class="card-title">Input Data Jenis Surat</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          </div>
        </div>



        <form action="{{route('kategori.store')}}" method="post">
        <div class="card-body">
        
          <?php echo csrf_field();?>
            <div class="form-group">
              <label for="">Jenis Surat <sup>*</sup></label>
              <input type="text" name="nama" class="form-control" id="nama" value="{{old('nama')}}" placeholder="Biasa, Rahasia, Penting dll" autofocus>
               <span class="help-block text-danger">{{$errors->first('nama')}}</span>
            </div>
        
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
           <a href="{{route('kategori.index')}}" class="btn btn-default">Kembali</a>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        <!-- /.card-footer-->
      </div>
      </form>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection