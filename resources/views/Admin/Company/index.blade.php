@extends('layouts.app')

@section('outer_style')

@endsection

@section('content')
<div class="container">
  <div class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark">Companies Managment</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Dashboard v3</li> -->
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-12 grid-margin">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-info float-right" href="{{route('companies.create')}}">Add +</a>
          </div>

          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif

            <div class="row">
              <div class="col-12 table-responsive">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr #</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Registered On</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($companies as $key=>$company)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$company->name}}</td>
                      <td>{{$company->address}}</td>
                      <td>{{$company->contact}}</td>
                      <td>{{$company->email}}</td>
                      <td>{{$company->status}}</td>
                      <td>{{$company->created_at}}</td>
                      <td>
                        <a class="btn btn-outline-primary" href="{{route('companies.edit',$company->id)}}">Edit</a>
                        <a class="btn btn-outline-success" href="{{route('register_event_index',$company->id) }}">Register Event</a>
                        <a class="btn btn-outline-primary" href="{{route('delete_company', $company->id)}}">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="col-md-4 pull-right">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('outer_script')

<script>

jQuery(document).ready(function($){
  $('#table').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true,
  });
});

</script>
@endsection
