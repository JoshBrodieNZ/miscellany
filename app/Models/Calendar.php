<?php

namespace App\Models;

use App\Models\MiscModel;
use App\Traits\CampaignTrait;
use App\Traits\ExportableTrait;
use App\Traits\VisibleTrait;
use Collective\Html\HtmlFacade;

class Calendar extends MiscModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'name',
        'slug',
        'type',
        'entry',
        'is_private',
        'parameters',
        'months',
        'weekdays',
        'years',
        'seasons',
        'date',
        'suffix',

        // Leap year
        'has_leap_year',
        'leap_year_amount', // Add X number of days
        'leap_year_month', // At the end of month X
        'leap_year_offset', // every X years
        'leap_year_start', // X year is a leap year
    ];

    /**
     * Parameters in decoded json
     * @var bool
     */
    protected $params = false;

    /**
     * @var bool
     */
    protected $loadedMonths = false;

    /**
     * @var bool
     */
    protected $loadedWeekdays = false;

    /**
     * @var bool
     */
    protected $loadedYears = false;

    /**
     * @var bool
     */
    protected $loadedSeasons = false;

    /**
     * Fields that can be filtered on
     * @var array
     */
    protected $filterableColumns = [
        'name',
        'type',
        'is_private',
    ];

    /**
     * Traits
     */
    use CampaignTrait;
    use VisibleTrait;
    use ExportableTrait;

    /**
     * Entity type
     * @var string
     */
    protected $entityType = 'calendar';

    /**
     * Searchable fields
     * @var array
     */
    protected $searchableColumns  = ['name', 'entry', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function events()
    {
        return $this->hasManyThrough('App\Models\Event', 'App\Models\EntityEvent', 'calendar_id', 'entity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendarEvents()
    {
        return $this->hasMany('App\Models\EntityEvent', 'calendar_id');
    }

    /**
     * Get the months
     * @return null
     */
    public function months()
    {
        if ($this->loadedMonths === false) {
            $this->loadedMonths = json_decode($this->months, true);
        }
        return $this->loadedMonths;
    }

    /**
     * Get the weekdays
     * @return null
     */
    public function weekdays()
    {
        if ($this->loadedWeekdays === false) {
            $this->loadedWeekdays = json_decode($this->weekdays, true);
        }
        return $this->loadedWeekdays;
    }

    /**
     * Get the weekdays
     * @return null
     */
    public function years()
    {
        if ($this->loadedYears === false) {
            $this->loadedYears = json_decode($this->years, true);
        }
        return $this->loadedYears;
    }

    /**
     * Get the value of a parameter
     * @param $field
     * @return null
     */
    private function param($field)
    {
        if ($this->params === false) {
            $this->params = json_decode($this->parameters, true);
        }

        if (isset($this->params[$field])) {
            return $this->params[$field];
        }

        return null;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function currentDate($value)
    {
        $data = explode('-', $this->date);
        if ($value == 'year') {
            return $data[0];
        } elseif ($value == 'month') {
            return $data[1];
        } elseif ($value == 'date') {
            return $data[2];
        }
        return null;
    }

    /**
     * Get a list of months for select fields
     * @return array
     */
    public function monthList()
    {
        $months = [];
        $i = 1;
        foreach ($this->months() as $month) {
            $months[$i] = $month['name'];
            $i++;
        }
        return $months;
    }

    /**
     * Detach children when moving this entity from one campaign to another
     */
    public function detach()
    {
        foreach ($this->calendarEvents as $child) {
            $child->delete();
        }

        return parent::detach();
    }
}
