<?php $r = $model->entity->relationships()->has('target')->with(['target'])->order(request()->get('order'), 'relation')->paginate(); ?>
<p class="export-hidden">{{ trans('crud.relations.hint') }}</p>
<p class="export-{{ ($r->count() === 0 ? 'visible export-hidden' : 'visible') }}">{{ trans('crud.tabs.relations') }}</p>

<table id="crud_families" class="table table-hover {{ ($r->count() === 0 ? 'export-hidden' : '') }}">
    <tbody><tr>
        <th><a href="{{ route($name . '.show', [$model, 'order' => 'relations/relation', '#relations']) }}">{{ trans('crud.relations.fields.relation') }}@if (request()->get('order') == 'relations/relation') <i class="fa fa-long-arrow-down"></i>@endif</a></th>
        <th class="avatar"><br></th>
        <th><a href="{{ route($name . '.show', [$model, 'order' => 'relations/target.name', '#relations']) }}">{{ trans('crud.relations.fields.name') }}@if (request()->get('order') == 'relations/target.name') <i class="fa fa-long-arrow-down"></i>@endif</a></th>
        @if ($campaign->enabled('locations'))<th>{{ trans('crud.relations.fields.location') }}</th>@endif
        @if (Auth::user()->isAdmin())
            <th><a href="{{ route($name . '.show', [$model, 'order' => 'relations/is_private', '#relations']) }}">{{ trans('crud.fields.is_private') }}@if (request()->get('order') == 'relations/is_private') <i class="fa fa-long-arrow-down"></i>@endif</a></th>
        @endif
        <th class="text-right">
            @can('relation', [$model, 'add'])
                <a href="{{ route($name . '.relations.create', [$name => $model->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> {{ trans('crud.relations.actions.add') }}    </a>
            @endcan
        </th>
    </tr>
    @foreach ($r as $relation)
        @can('view', $relation->target->child)
        <tr>
            <td>{{ $relation->relation }}</td>
            <td>
                <a class="entity-image" style="background-image: url('{{ $relation->target->child->getImageUrl(true) }}');" title="{{ $relation->target->child->name }}" href="{{ route($relation->target->pluralType() . '.show', $relation->target->child->id) }}"></a>
            </td>
            <td>
                <a href="{{ route($relation->target->pluralType() . '.show', $relation->target->child->id) }}" data-toggle="tooltip" title="{{ $relation->target->child->tooltip() }}">
                    {{ $relation->target->child->name }}
                </a>
            </td>
            @if ($campaign->enabled('locations'))<td>
                @if ($relation->target->child->location)
                    <a href="{{ route('locations.show', $relation->target->child->location_id) }}" data-toggle="tooltip" title="{{ $relation->target->child->location->tooltip() }}">{{ $relation->target->child->location->name }}</a>
                @endif
            </td>
            @endif
            @if (Auth::user()->isAdmin())
                <td>
                    @if ($relation->is_private == true)
                        <i class="fa fa-lock" title="{{ trans('crud.is_private') }}"></i>
                    @endif
                </td>
            @endif
            <td class="text-right">
                @can('relation', [$model, 'edit'])
                    <a href="{{ route($name . '.relations.edit', [$name => $model, 'relation' => $relation]) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> {{ trans('crud.edit') }}</a>
                @endcan
                @can('relation', [$model, 'delete'])
                {!! Form::open(['method' => 'DELETE', 'route' => [$name . '.relations.destroy', $name => $model, 'relation' => $relation], 'style'=>'display:inline']) !!}
                <button class="btn btn-xs btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('crud.remove') }}
                </button>
                {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @else
        <tr class="entity-hidden">
            <td colspan="{{ ($campaign->enabled('locations') ? 5 : 4) }}">{{ trans('crud.hidden') }}</td>
        </tr>
        @endcan
    @endforeach
    </tbody></table>

{{ $r->fragment('tab_relation')->links() }}
