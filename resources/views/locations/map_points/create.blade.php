@extends((isset($ajax) && $ajax ? 'layouts.ajax' : 'layouts.app'), [
    'title' => trans('locations.map_points.create.title', ['name' => $location->name]),
    'description' => '',
    'breadcrumbs' => [
        ['url' => route('locations.index'), 'label' => trans('locations.index.title')],
        ['url' => route('locations.show', [$location, '#map']), 'label' => $location->name]
    ]
])

@section('content')
    @include('partials.errors')

    {!! Form::open(array('route' => ['locations.map_points.store', $location], 'method'=>'POST', 'data-shortcut' => "1")) !!}
    @include('locations.map_points._form')

    <div class="form-group">
        <button class="btn btn-success">{{ trans('crud.save') }}</button>
        @if(!isset($ajax))
        {!! trans('crud.or_cancel', ['url' => route('locations.map_points.index', [$location])]) !!}
        @endif
    </div>

    {!! Form::close() !!}
@endsection
