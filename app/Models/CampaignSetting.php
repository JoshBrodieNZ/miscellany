<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class CampaignSetting extends Model
{
    /**
     * @var string
     */
    public $table = 'campaign_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'characters',
        'events',
        'families',
        'items',
        'journals',
        'locations',
        'notes',
        'organisations',
        'quests',
        'calendars',
        'sections',
        'dice_rolls',
        'menu_links',
        'conversations',
        'races',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign_id', 'id');
    }

    /**
     * Count the number of activated modules
     * @return int
     */
    public function countEnabledModules()
    {
        $count = 0;
        foreach ($this->fillable as $col) {
            if ($col != 'campaign_id' && $this->$col == true) {
                $count++;
            }
        }

        return $count;
    }
}
