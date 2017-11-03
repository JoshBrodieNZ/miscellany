@extends('layouts.app', ['title' => trans('organisations.members.create.title', ['name' => $organisation->name]), 'description' => trans('organisations.members.create.description')])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add a member</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {!! Form::open(array('route' => 'organisation_member.store', 'method'=>'POST')) !!}
                    @include('organisations.members._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection