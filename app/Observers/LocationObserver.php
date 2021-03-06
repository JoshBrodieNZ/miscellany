<?php

namespace App\Observers;

use App\Models\Location;
use App\Models\MiscModel;
use App\Services\ImageService;

class LocationObserver extends MiscObserver
{
    /**
     * @param MiscModel $model
     */
    public function saving(MiscModel $model)
    {
        parent::saving($model);

        // Handle image. Let's use a service for this.
        ImageService::handle($model, $model->getTable(), 60, 'map');

//        // Need to update the parent tree
//        $newParentId = $model->parent_location_id;
//        $originalParentId = $model->getOriginal('parent_location_id');
//        if (!empty($originalParentId) && $originalParentId != $model->parent_location_id) {
//            $model->parent_location_id = $originalParentId;
//            dd($model->parent->name);
//            $model->refreshNode();
//            $model->parent_location_id = $newParentId;
//        }
    }

    /**
     * @param Location $location
     */
    public function deleting(MiscModel $location)
    {
        parent::deleting($location);

        /**
         * We need to do this ourselves and not let mysql to it (set null), because the plugin wants to delete
         * all descendants when deleting the parent, which is stupid.
         */
        foreach ($location->locations as $sub) {
            $sub->parent_location_id = null;
            $sub->save();
        }

        // We need to refresh our foreign relations to avoid deleting our children nodes again
        $location->refresh();

        ImageService::cleanup($location, 'map');
    }
}
