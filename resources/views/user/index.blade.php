 @extends('layouts.master')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data User</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
          <a href="{{route('register')}}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Tambah</a>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

          @if (Session::has('edit'))
          <div class="alert alert-info alert-dismissible">{{Session::get('edit')}}</div>
          @endif

           @if (Session::has('tambah'))
          <div class="alert alert-success alert-dismissible">{{Session::get('tambah')}}</div>
          @endif


          @if (Session::has('delete'))
          <div class="alert alert-danger alert-dismissible">{{Session::get('delete')}}</div>
          @endif

         <table class="table table-border" id="data">
           <thead>
              <th>Nomer</th>
              <th>Username</th>
              <th>Password</th>
              <th>Role</th>     
              <th>Aksi</th>
           </thead>
           <tbody>
            @foreach($user as $row)
            <?php $no=1; ?>
             <tr>
               <td>{{ $no++}}</td>
               <td> {{ $row->name}}</td>
               <td> {{ $row->password}}</td>
               <td> {{ $row->role}}</td>
               <td>
                <form action="{{route('user.destroy',$row->id)}}" method="POST">  
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                    <!--FUNGSI EDIT-->
                    <a href="{{route('user.edit', $row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>  
                    <!---->

                    <?php echo csrf_field(); ?>
                    
                    </form>
               </td>
             </tr>
             <?php $no++; ?>
             @endforeach
           </tbody>


         </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection