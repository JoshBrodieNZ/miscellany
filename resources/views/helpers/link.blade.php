@extends('layouts.app', [
    'title' => trans('helpers.title'),
    'description' => trans('helpers.description'),
    'breadcrumbs' => [
        trans('helpers.link.title')
    ]
])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4>{{ trans('helpers.link.title') }}</h4>
                </div>

                <div class="box-body">
                    <p>
                        {{ trans('helpers.link.description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
