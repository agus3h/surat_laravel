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
          <h3 class="card-title">Input Data User</h3>

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

       
                    <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                         <div class="card-body">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                          
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                          
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                           
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                          
                        </div>


                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Role Akses</label>

                           
                                <select name="role" id="role" class="form-control">
                                    <option value="pencatat" {{old('role') == 'pencatat' ? 'selected':''}}>Pencatat</option>
                                    <option value="pengolah" {{old('role') == 'pengolah' ? 'selected':''}}>Pengolah</option>
                                    <option value="admin" {{old('role') == 'admin' ? 'selected':''}}>Admin</option>
                                </select>
                       
                    </div>

                    </div>
                        <div class="card-footer">
                             <a href="{{route('user.index')}}" class="btn btn-default">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                        </div>
                    
                    </form>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection

