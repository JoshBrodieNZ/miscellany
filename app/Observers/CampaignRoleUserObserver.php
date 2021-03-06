<?php

namespace App\Observers;

use App\Models\CampaignRoleUser;
use App\Notifications\Header;

class CampaignRoleUserObserver
{
    /**
     * @param CampaignRoleUser $campaignRoleUser
     */
    public function saving(CampaignRoleUser $campaignRoleUser)
    {
        
    }

    /**
     * @param CampaignRoleUser $campaignRoleUser
     */
    public function saved(CampaignRoleUser $campaignRoleUser)
    {
    }

    /**
     * @param CampaignRoleUser $campaignRoleUser
     */
    public function created(CampaignRoleUser $campaignRoleUser)
    {
        $notification = new Header(
            'campaign.role.add',
            'user',
            'green',
            [
                'role' => $campaignRoleUser->campaignRole->name,
                'campaign' => $campaignRoleUser->campaignRole->campaign->name
            ]
        );
        $campaignRoleUser->user->notify($notification);
    }

    /**
     * @param CampaignRoleUser $campaignRoleUser
     */
    public function creating(CampaignRoleUser $campaignRoleUser)
    {
    }

    /**
     * @param CampaignRoleUser $campaignRoleUser
     */
    public function deleted(CampaignRoleUser $campaignRoleUser)
    {
        $notification = new Header(
            'campaign.role.remove',
            'user',
            'green',
            [
                'role' => $campaignRoleUser->campaignRole->name,
                'campaign' => $campaignRoleUser->campaignRole->campaign->name
            ]
        );
        $campaignRoleUser->user->notify($notification);
    }
}
