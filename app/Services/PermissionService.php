<?php

namespace App\Services;

use App\Models\CampaignUser;
use App\Exceptions\RequireLoginException;
use App\Models\CampaignInvite;
use App\Models\CampaignPermission;
use App\Models\CampaignRole;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class PermissionService
 * @package App\Services
 */
class PermissionService
{
    /**
     * @var EntityService
     */
    private $entityService;

    /**
     * @var array
     */
    public $entityActions = [
        'read', 'edit', 'delete'
    ];

    /**
     * PermissionService constructor.
     * @param EntityService $entityService
     */
    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * @param CampaignRole $role
     * @return array
     */
    public function permissions(CampaignRole $role)
    {
        $permissions = [];

        $campaignRolePermissions = [];
        foreach ($role->permissions as $perm) {
            $campaignRolePermissions[$perm->key] = 1;
        }

        $entityActions = ['read', 'edit', 'add', 'delete', 'permission'];
        //$actions = ['read', 'edit', 'add', 'delete'];

        // Public actions
        if ($role->is_public) {
            //$actions = ['read'];
            $entityActions = ['read'];
        }

        $excludedEntities = ['attribute_templates', 'menu_links'];

        foreach ($this->entityService->entities() as $entity => $class) {
            if (in_array($entity, $excludedEntities)) {
                continue;
            }
            $singularEntity = $this->entityService->singular($entity);

            foreach ($entityActions as $action) {
                $key = "{$singularEntity}_{$action}";
                $table = $key;
                $permissions[] = [
                    'entity' => $entity,
                    'action' => $action,
                    'table' => $table,
                    'key' => $key,
                    'enabled' => isset($campaignRolePermissions[$key]),
                ];
            }
        }

        return $permissions;
    }

    /**
     * @param $request
     * @param Entity $entity
     */
    public function saveEntity($request, Entity $entity)
    {
        // First, let's get all the stuff for this entity
        $permissions = $this->entityPermissions($entity);

        // Next, start looping the data
        if (!empty($request['role'])) {
            foreach ($request['role'] as $roleId => $data) {
                foreach ($data as $perm) {
                    if (empty($permissions['role'][$roleId][$perm])) {
                        $permObject = CampaignPermission::create([
                            'key' => $entity->type . '_' . $perm . '_' . $entity->child->id,
                            'campaign_role_id' => $roleId,
                            'table_name' => $entity->pluralType()
                        ]);
                    } else {
                        unset($permissions['role'][$roleId][$perm]);
                    }
                }
            }
        }
        if (!empty($request['user'])) {
//            dump($request['user']);
            foreach ($request['user'] as $userId => $data) {
                foreach ($data as $perm) {
                    if (empty($permissions['user'][$userId][$perm])) {
                        $permObject = CampaignPermission::create([
                            'key' => $entity->type . '_' . $perm . '_' . $entity->child->id,
                            'user_id' => $userId,
                            'table_name' => $entity->pluralType()
                        ]);
                    } else {
                        unset($permissions['user'][$userId][$perm]);
                    }
                }
            }
        }

        // Delete remaining permissions
        // Todo: Refactor?
        foreach ($permissions as $type => $data) {
            foreach ($data as $user => $actions) {
                foreach ($actions as $action => $perm) {
                    $perm->delete();
                }
            }
        }
    }

    /**
     * Get the permissions of an entity
     * @param Entity $entity
     * @return mixed
     */
    public function entityPermissions(Entity $entity)
    {
        $keyBase = $entity->type . '_';
        $keys = [];

        foreach ($this->entityActions as $action) {
            $keys[] = $keyBase . $action . '_' . $entity->child->id;
        }

        $permissions = ['user' => [], 'role' => []];
        foreach (CampaignPermission::whereIn('key', $keys)->get() as $perm) {
            $permissions[(!empty($perm->user_id) ? 'user' : 'role')][(!empty($perm->user_id) ? $perm->user_id : $perm->campaign_role_id)][$perm->action()] = $perm;
        }

        return $permissions;
    }
}
