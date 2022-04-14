@extends('layouts.admin_app')
@section('content')
<div class="content-wrapper" style="min-height:auto;">
    <section class="content">
        <div class="container-fluid">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Customer</h2>
        </div>
        <div class="float-right mb-3">
            <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => ['customers.update',$customer->id],'method'=>'PATCH')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles', $roles,$customer->role ,array('class' => 'form-control','multiple','selected')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name</strong>
            {!! Form::text('name', $customer->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Mobile No</strong>
            {!! Form::text('phone', $customer->phone, array('placeholder' => 'Phone','class' => 'form-control','maxlength'=>'10')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Second Mobile No. :</strong>
            {!! Form::text('second_phone', $customer->second_phone, array('placeholder' => 'Additional Phone','class' => 'form-control','maxlength'=>'10')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Area</strong>
            {!! Form::text('area', $customer->area, array('placeholder' => 'Area','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Remark</strong>
            <textarea name="remark"  class="form-control" rows="3">{{$customer->remark}}</textarea>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Assign</strong>
            <select name="assign"  class="form-control">
                @if (!empty($users))
                @foreach ($users as $user)
                    <option value="{{$user->id}}" {{$user->id == $customer->assign?'selected':''}}>{{$user->name}}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

        </div>
    </section>
</div>
@endsection