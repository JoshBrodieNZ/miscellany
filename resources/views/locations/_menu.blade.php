<?php /** @var App\Models\location $location */ ?>
<div class="box box-solid">
    <div class="box-body box-profile">
        @include ('cruds._image')

        <h3 class="profile-username text-center">{{ $model->name }}
            @if ($model->is_private)
                <i class="fa fa-lock" title="{{ trans('crud.is_private') }}"></i>
            @endif
        </h3>

        <ul class="list-group list-group-unbordered">
            @if (!empty($model->type))
                <li class="list-group-item">
                    <b>{{ trans('locations.fields.type') }}</b> <span class="pull-right clear">{{ $model->type }}</span>
                    <br class="clear" />
                </li>
            @endif
            @if (!empty($model->parentLocation))
                <li class="list-group-item">
                    <b title="{{ trans('crud.fields.location') }}">
                        <i class="ra ra-tower"></i> <span class="visible-xs-inline">{{ trans('locations.fields.location') }}</span>
                    </b>

                    <span class="pull-right">
                            <a href="{{ route('locations.show', $model->parentLocation->id) }}" data-toggle="tooltip" title="{{ $model->parentLocation->tooltip() }}">{{ $model->parentLocation->name }}</a>@if ($model->parentLocation->parentLocation),
                        <a href="{{ route('locations.show', $model->parentLocation->parentLocation->id) }}" data-toggle="tooltip" title="{{ $model->parentLocation->parentLocation->tooltip() }}">{{ $model->parentLocation->parentLocation->name }}</a>
                        @endif
                            </span>
                    <br class="clear" />
                </li>
            @endif
            @include('cruds.layouts.section')
        </ul>
        @include('.cruds._actions')
    </div>
</div>

@if (!isset($exporting))
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ __('crud.tabs.menu') }}
        </h3>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <li class="@if(empty($active))active @endif">
                <a href="{{ route('locations.show', $model) }}">
                    {{ __('crud.panels.entry') }}
                </a>
            </li>
            <li class="@if(!empty($active) && $active == 'locations')active @endif">
                <a href="{{ route('locations.locations', $model) }}">
                    {{ __('locations.show.tabs.locations') }}
                    <span class="label label-default pull-right">
                        <?=$model->locations()->count()?>
                    </span>
                </a>
            </li>
            @if ($campaign->enabled('characters'))
            <li class="@if(!empty($active) && $active == 'characters')active @endif">
                <a href="{{ route('locations.characters', $model) }}">
                    {{ __('locations.show.tabs.characters') }}
                    <span class="label label-default pull-right">
                        <?=$model->characters()->count()?>
                    </span>
                </a>
            </li>
            @endif
            <li class="@if(!empty($active) && $active == 'events')active @endif">
                <a href="{{ route('locations.events', $model) }}">
                    {{ __('locations.show.tabs.events') }}
                    <span class="label label-default pull-right">
                        <?=$model->events()->count()?>
                    </span>
                </a>
            </li>
            <li class="@if(!empty($active) && $active == 'items')active @endif">
                <a href="{{ route('locations.items', $model) }}">
                    {{ __('locations.show.tabs.items') }}
                    <span class="label label-default pull-right">
                        <?=$model->items()->count()?>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
@endif