<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyAttributeTemplate;
use App\Http\Requests\StoreEntityNote;
use App\Models\AttributeTemplate;
use App\Models\Character;
use App\Models\Attribute;
use App\Http\Requests\StoreAttribute;
use App\Models\EntityNote;
use App\Services\AttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Entity;

class EntityNoteController extends Controller
{
    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var string
     */
    protected $route = 'entity_notes';

    /**
     * Redirect tab after manipulating
     * @var string
     */
    protected $tab = '#notes';

    /**
     * Crud view path
     * @var string
     */
    protected $crudView = 'notes';

    /**
     * @var string
     */
    protected $model = \App\Models\EntityNote::class;

    /**
     * @param Entity $entity
     * @return \Illuminate\Http\Response
     */
    public function index(Entity $entity)
    {
        $this->authorize('browse', [$entity->child]);

        $notes = $entity->notes()->paginate();
        $name = $this->view;
        $route = $entity->type . $this->route;
        $parentRoute = $entity->pluralType();

        return view('cruds.notes.index', compact(
            'notes',
            'name',
            'route',
            'entity',
            'parentRoute'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Entity $entity, EntityNote $entityNote)
    {
        $this->authorize('attribute', [$entity->child, 'add']);

        $name = $entity->pluralType() . '.notes' . $this->view;
        $route = 'entities.' . $this->route;
        $parentRoute = $entity->pluralType();
        $ajax = request()->ajax();

        return view('cruds.notes.' . ($ajax ? '_' : null) . 'create', compact(
            'entityNote',
            'name',
            'route',
            'entity',
            'parentRoute',
            'ajax'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntityNote $request, Entity $entity)
    {
        $this->authorize('attribute', [$entity->child, 'add']);

        $note = new EntityNote();
        $note->entity_id = $entity->id;
        $note = $note->create($request->all());

        return redirect()
            ->route($entity->pluralType() . '.show', [$entity->child->id, $this->tab])
            ->with('success', trans('crud.notes.create.success', ['name' => $note->name, 'entity' => $entity->child->name]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity, EntityNote $entityNote)
    {
        $this->authorize('attribute', [$entity->child, 'edit']);

        $name = $entity->pluralType() . '.notes' . $this->view;
        $route = 'entities.' . $this->route;
        $parentRoute = $entity->pluralType();
        $model = $entityNote;

        return view('cruds.notes.edit', compact(
            'entity',
            'model',
            'name',
            'route',
            'parentRoute'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEntityNote $request, Entity $entity, EntityNote $entityNote)
    {
        $this->authorize('attribute', [$entity->child, 'edit']);

        $entityNote->update($request->all());

        return redirect()->route($entity->pluralType() . '.show', [$entity->child->id, $this->tab])
            ->with('success', trans('crud.notes.edit.success', ['name' => $entityNote->name, 'entity' => $entity->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CharacterAttribute  $characterAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity, EntityNote $entityNote)
    {
        $this->authorize('attribute', [$entity->child, 'delete']);

        $entityNote->delete();

        return redirect()
            ->route($entity->pluralType() . '.show', [$entity->child->id, $this->tab])
            ->with('success', trans('crud.notes.destroy.success', ['name' => $entityNote->name, 'entity' => $entity->name]));
    }
}
