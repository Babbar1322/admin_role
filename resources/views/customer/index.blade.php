@extends('layouts.admin_app')

@section('content')
<div class="content-wrapper" style="min-height:auto;">
  <section class="content">
      <div class="container-fluid">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Customers</h2>
        </div>
        <div class="float-right mb-3">
            <a class="btn btn-success" href="{{ route('customers.create') }}"> Create New Customer</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Mobile No.</th>
   <th>Roles</th>
   <th>Area</th>
   <th>Assign</th>
   <th width="280px">Action</th>
 </tr>
 
 @foreach ($customers as $key => $custm)
  <tr>
    <td>{{ $customers->firstItem()+$key}}</td>
    <td>{{ $custm->name }}</td>
    <td>{{ $custm->phone }}</td>
    <td>
           <label class="badge badge-success">{{$custm->role}}</label>
    </td>
    <td>{{$custm->area}}</td>
    <td>{{$custm->assign}}</td>
    <td>
       {{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> --}}
       <a class="btn btn-primary" href="{{ route('customers.edit',$custm->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['customers.destroy', $custm->id],'style'=>'display:inline','onclick'=>'return confirm("Are you sure want to delete!")']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $customers->render() !!}

      </div>
  </section>
</div>
@endsection