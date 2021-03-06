<p class="export-hidden">{{ trans('families.hints.members') }}</p>

<table id="family-members" class="table table-hover">
    <tbody><tr>
        <th class="avatar"><br></th>
        <th>{{ trans('characters.fields.name') }}</th>
        <th>{{ trans('characters.fields.location') }}</th>
        <th>{{ trans('characters.fields.age') }}</th>
        <th>{{ trans('characters.fields.race') }}</th>
        <th>{{ trans('characters.fields.sex') }}</th>
    </tr>
    @foreach ($r = $model->members()->acl(auth()->user())->with('location')->paginate() as $relation)
        <tr>
            <td>
                <a class="entity-image" style="background-image: url('{{ $relation->getImageUrl(true) }}');" title="{{ $relation->name }}" href="{{ route('characters.show', $relation->id) }}"></a>
            </td>
            <td>
                <a href="{{ route('characters.show', $relation->id) }}">{{ $relation->name }}</a>
            </td>
            <td>
                @if ($relation->location)
                    <a href="{{ route('locations.show', $relation->location_id) }}">{{ $relation->location->name }}</a>
                @endif
            </td>
            <td>{{ $relation->age }}</td>
            <td>@if ($relation->race)
                    <a href="{{ route('races.show', $relation->race_id) }}" data-toggle="tooltip" title="{{ $relation->race->tooltip() }}">{{ $relation->race->name }}</a>
            @endif</td>
            <td>{{ $relation->sex }}</td>
        </tr>
    @endforeach
    </tbody></table>

{{ $r->fragment('tab_member')->links() }}
