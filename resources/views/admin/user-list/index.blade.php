@extends('admin.admin_layouts')
@section('user') active show-sub @endsection
@section('user-sub') active @endsection
@section('admin_content')

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/admin/home') }}">Home</a>
            <span class="breadcrumb-item active">User Page</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row">
                <div class="col-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">User list</h6>
                        <div class="table-wrapper">
                          <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                              <tr>
                                <th class="wd-10p">Sl.</th>
                                <th class="wd-15p">User name</th>
                                <th class="wd-20p">User e-mail</th>
                                {{-- <th class="wd-20p">User Phone</th> --}}
                                <th class="wd-20p">Status</th>
                                
                                <th class="wd-20p">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $count = 1;
                                ?>
                              @foreach ($users AS $user)
                              <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ $user->phone }}</td> --}}
                                <td>
                                  <form method="post" action="{{ route('changeStatus', $user->id) }}">
                                      @csrf
                                      <input type="radio" name="status" value=1 {{ $user->status == 1 ? 'checked' : '' }}> Active
                                      <input type="radio" name="status" value=0 {{ $user->status == 0 ? 'checked' : '' }}> Inactive
                                      <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                                  </form>
                                </td>
                              
                              
                                <td class="d-flex">
                                  <a href="{{ route('user.details', ['id' => $user->id]) }}" class="btn btn-info btn-sm mr-2"><i class="bi bi-eye-fill"></i> Details</a>
                                  <form method="post" action="{{ route('user.delete', ['id' => $user->id]) }}" onsubmit="return confirm('Are you sure to delete this User..?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm"><i class="icon ion-trash-b"></i></button>
                                  </form>
                              </td>
                              
                              
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div><!-- table-wrapper -->
                      </div><!-- card -->
                </div>
        
            </div>
        </div><!-- sl-pagebody -->
      </div><!-- sl-mainpanel -->

@endsection

