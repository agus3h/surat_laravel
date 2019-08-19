 @extends('layouts.master')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Surat Masuk</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data Surat Masuk</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>


          @if (Session::has('message'))
          <div class="alert alert-success alert-dismissible">{{Session::get('message')}}</div>
          @endif


        <form action="{{route('surat_masuk.update',$masuk->id)}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <div class="card-body">
        
          <?php echo csrf_field();?>
            <div class="form-group">
              <label for="">Surat Dari</label>
              <input type="text" name="dari" class="form-control" id="dari" value="{{$masuk->dari}}">
                 <span class="help-block text-danger"><strong>{{$errors->first('dari')}}</strong></span>
            </div>

            <div class="form-group">
              <label for="">Nomor Surat</label>
              <input type="text" name="nomor" class="form-control" id="nomor" value="{{$masuk->nomor}}">
               <span class="help-block text-danger"><strong>{{$errors->first('nomor')}}</strong></span>
            </div>

            <div class="form-group">
              <label for="">Perihal</label>
              <input type="text" name="perihal" class="form-control" id="perihal" value="{{$masuk->perihal}}">
               <span class="help-block text-danger"><strong>{{$errors->first('perihal')}}</strong></span>
            </div>

            <div class="form-group">
              <label for="">Kategori Surat</label>
              <select name="kategori_id" class="form-control" id="kategori_id">
                <option value="">Pilih</option>
                @foreach($kategori as $row)
              <option value="{{$row->id}}" {{$row->id == $masuk->kategori_id ? 'selected':''}}>{{$row->nama}}</option>
                @endforeach
              </select>
              <span class="help-block text-danger"><strong>{{$errors->first('kategori_id')}}</strong></span>
            </div>

            <div class="form-group">
              <label for="">Catatan</label>
              <textarea name="catatan" class="form-control" rows="5" id="catatan">{{$masuk->catatan}}</textarea>
              <span class="help-block text-danger"><strong>{{$errors->first('catatan')}}</strong></span>
            </div>

            <div class="form-group">
              <label for="">Status</label>
              <select class="form-control" name="status">
              <option value="Diproses"{{old('status') == 'Diproses' ? 'selected':''}}>Diproses</option>
              <option value="Selesai" {{old('status') == 'Selesai' ? 'selected':''}}>Selesai</option>
              </select>
            </div>


            <div class="form-group">
              <label for="">File Surat</label>
              <input type="file" name="file" class="form-control" value="{{$masuk->file}}">
          <span class="help-block text-danger">{{$errors->first('file')}}</span>
             <img src="{{asset('public/uploads/surat_masuk/'.$masuk->file)}}" class="img-thumbnail" width="1200px" height="50px">
            </div>
        
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="{{route('surat_masuk.index')}}" class="btn btn-danger">Kembali</a>
        </div>
        <!-- /.card-footer-->
      </div>
      </form>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection