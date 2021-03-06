@extends('layouts.app', [
    'title' => trans('crud.notes.create.title', ['name' => $entity->name]),
    'description' => '',
    'breadcrumbs' => [
        ['url' => route($parentRoute . '.index'), 'label' => trans($parentRoute . '.index.title')],
        ['url' => route($parentRoute . '.show', $entity->child->id), 'label' => $entity->name]
    ]
])

@section('content')
    @include('partials.errors')
    @include('cruds.notes._create')
@endsection

@include('layouts.widgets.tinymce')
