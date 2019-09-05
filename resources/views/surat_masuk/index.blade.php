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
          
          <a href="{{route('surat_masuk.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Tambah</a>
           <a href="{{route('surat_masuk.excel')}}" class="btn btn-primary btn-sm"><i class="fas fa-book"></i>Cetak</a>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

           @if (Session::has('tambah'))
          <div class="alert alert-success alert-dismissible">{{Session::get('tambah')}}</div>
          @endif

          @if (Session::has('edit'))
          <div class="alert alert-info alert-dismissible">{{Session::get('edit')}}</div>
          @endif

          @if (Session::has('delete'))
          <div class="alert alert-danger alert-dismissible">{{Session::get('delete')}}</div>
          @endif

         <table class="table table-border" id="data">
           <thead>
              <th>No</th>
              <th>Dari</th>  
              <th>Nomor</th>
              <th>Perihal</th>
              <th>Jenis Surat</th>
              <th>Catatan</th>
              <th>Tgl Terima</th>
              <th>File</th>
              <th>Status</th>
              <th>Aksi</th>
           </thead>
           <tbody>
             <?php $no=1; ?>
            @foreach($masuk as $row)
             <tr>
               <td>{{ $no++}}</td>
               <td> {{ $row->dari}}</td>
               <td> {{ $row->nomor}}</td>
               <td> {{ $row->perihal}}</td>
               <td> {{ $row->kategori->nama}}</td>
               <td><textarea readonly="" disabled="">{{ $row->catatan}}</textarea></td>
               <td>{{$row->created_at->formatLocalized(" %d %B %Y")}}</td>
               <td>
                @if($row->file)
                <img src="{{asset('public/uploads/surat_masuk/'.$row->file)}}" alt="{{$row->dari}}" width="50px" height="50px">
               @else
                  <img src="{{asset('public/uploads/no-image.png')}}" width="50px" height="50px">
                @endif 

              </td>

              @if($row->status == 'Diproses')
               <td>
                 <a href="{{route('surat_masuk.proses', $row->id)}}" class="btn btn-success">Diproses</a>
              </td>
               @else
               <td> 
                <a href="{{route('surat_masuk.selesai', $row->id)}}" class="btn btn-default"><strong>Selesai</strong></a>
               </td>
               @endif
               <td>
                <form action="{{route('surat_masuk.destroy',$row->id)}}" method="POST">  
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                    <!--FUNGSI EDIT-->
                    <a href="{{route('surat_masuk.edit', $row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>  
                    <!---->

                    <?php echo csrf_field(); ?>
                    
                    </form>
               </td>
             </tr>
             @endforeach
             <?php $no++; ?>
           </tbody>


         </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
       
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection