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
          <h3 class="card-title">Input Data Surat Masuk</h3>

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

          <!-- @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif -->


        <form action="{{route('surat_masuk.store')}}" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <?php echo csrf_field();?>
            <div class="form-group ">
              <label for="">Surat Dari <sup>*</sup> </label>
              <input type="text" name="dari" class="form-control {{$errors->has('dari') ? 'is-invalid' : ''}}" id="dari" value="{{old('dari')}}" placeholder="Nama Pengirim" autofocus>
                 <span class="help-block text-danger">{{$errors->first('dari')}}</span>
            </div>

            <div class="form-group">
              <label for="">Nomor Surat <sup>*</sup></label>
              <input type="text" name="nomor" class="form-control {{$errors->has('nomor') ? 'is-invalid' : ''}}" id="nomor" value="{{old('nomor')}}" placeholder="xx/xxx/xx" >
               <span class="help-block text-danger">{{$errors->first('nomor')}}</span>
            </div>

            <div class="form-group">
              <label for="">Perihal <sup>*</sup></label>
              <input type="text" name="perihal" class="form-control {{$errors->has('perihal') ? 'is-invalid' : ''}}" id="perihal" value="{{old('perihal')}}" placeholder="Perihal" >
               <span class="help-block text-danger">{{$errors->first('perihal')}}</span>
            </div>

            <div class="form-group" hidden="">
              <label for="">Jenis Surat</label>
              <select name="kategori_id" class="form-control" id="kategori_id">
                @foreach($kategori as $row)
                <option value="{{$row->id}}">{{$row->nama}}</option>
                @endforeach
              </select>
              <span class="help-block text-danger">{{$errors->first('kategori_id')}}</span>
            </div>

            <div class="form-group">
              <label for="">Catatan <sup>(Optional)</sup></label>
              <textarea name="catatan" class="form-control {{$errors->has('catatan') ? 'is-invalid' : ''}}" rows="5" id="catatan" placeholder="Pakaian, Lampiran dll" >{{old('catatan')}}</textarea>
              <span class="help-block text-danger">{{$errors->first('catatan')}}</span>
            </div>

            <div class="form-group" hidden="">
              <label for="">Status <span class="form-required">*</span></label>
              <select class="form-control" name="status">
              <option value="Diproses" selected="">Diproses</option>
              <option value="Selesai">Selesai</option>
              </select>
            </div>


            <div class="form-group">
              <label for="">File Surat <sup>(Optional)</sup></label>
              <input type="file" name="file" class="form-control" id="file" value="{{old('file')}}">
             <span class="help-block text-danger">{{$errors->first('file')}}</span>
            </div>
        
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="{{route('surat_masuk.index')}}" class="btn btn-default">Kembali</a>
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