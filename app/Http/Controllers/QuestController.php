<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuest;
use App\Models\Character;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestController extends CrudController
{
    /**
     * @var string
     */
    protected $view = 'quests';
    protected $route = 'quests';

    /**
     * @var string
     */
    protected $model = \App\Models\Quest::class;

    /**
     * QuestController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->filters = [
            'name',
            'type',
            [
                'field' => 'character_id',
                'label' => trans('quests.fields.character'),
                'type' => 'select2',
                'route' => route('characters.find'),
                'placeholder' =>  trans('crud.placeholders.character'),
                'model' => Character::class,
            ],
            [
                'field' => 'quest_id',
                'label' => trans('quests.fields.quest'),
                'type' => 'select2',
                'route' => route('quests.find'),
                'placeholder' =>  trans('quests.placeholders.quest'),
                'model' => Quest::class,
            ],
            'is_completed',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuest $request)
    {
        return $this->crudStore($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Quest $quest)
    {
        return $this->crudShow($quest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Quest $quest)
    {
        return $this->crudEdit($quest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuest $request, Quest $quest)
    {
        return $this->crudUpdate($request, $quest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quest $quest)
    {
        return $this->crudDestroy($quest);
    }
}
