<?php

return [
    'actions'           => [
        'back'      => 'Back',
        'copy'      => 'Copy',
        'export'    => 'Export',
        'more'      => 'More Actions',
        'move'      => 'Move',
        'new'       => 'New',
        'private'   => 'Private',
        'public'    => 'Public',
    ],
    'add'               => 'Add',
    'attributes'        => [
        'actions'       => [
            'add'               => 'Add an attribute',
            'apply_template'    => 'Apply an Attribute Template',
            'manage'            => 'Manage',
        ],
        'create'        => [
            'description'   => 'Create a new attribute',
            'success'       => 'Attribute :name added to :entity.',
            'title'         => 'New Attribute for :name',
        ],
        'destroy'       => [
            'success'   => 'Attribute :name for :entity removed.',
        ],
        'edit'          => [
            'description'   => 'Update an existing attribute',
            'success'       => 'Attribute :name for :entity updated.',
            'title'         => 'Update attribute for :name',
        ],
        'fields'        => [
            'attribute' => 'Attribute',
            'template'  => 'Template',
            'value'     => 'Value',
        ],
        'index'         => [
            'success'   => 'Attributes for :entity updated.',
            'title'     => 'Attributes for :name',
        ],
        'placeholders'  => [
            'attribute' => 'Number of conquests, Challenge Rating, Initiative, Population',
            'template'  => 'Select a template',
            'value'     => 'Value of the attribute',
        ],
        'template'      => [
            'success'   => 'Attribute Template :name applies on :entity',
            'title'     => 'Apply an Attribute Template for :name',
        ],
    ],
    'bulk'              => [
        'errors'    => [
            'admin' => 'Only campaign admins can change the private status of entities.',
        ],
        'success'   => [
            'private'   => ':count entity is now private|:count entities are now private.',
            'public'    => ':count entity is now visible|:count entities are now visible.',
        ],
    ],
    'cancel'            => 'Cancel',
    'click_modal'       => [
        'close'     => 'Close',
        'confirm'   => 'Confirm',
        'title'     => 'Confirm your action',
    ],
    'create'            => 'Create',
    'delete_modal'      => [
        'close'         => 'Close',
        'delete'        => 'Delete',
        'description'   => 'Are you sure you want to remove :tag?',
        'title'         => 'Delete confirmation',
    ],
    'destroy_many'      => [
        'success'   => 'Deleted :count entity|Deleted :count entities.',
    ],
    'edit'              => 'Edit',
    'errors'            => [
        'node_must_not_be_a_descendant' => 'Invalid node (category, parent location): it would be a descendant of itself.',
    ],
    'events'            => [
        'hint'  => 'Shown below is a list of all the Calendars in which this entity was added using the "Add an event to a calendar" interface.',
    ],
    'export'            => 'Export',
    'fields'            => [
        'attribute_template'    => 'Attribute Template',
        'calendar'              => 'Calendar',
        'calendar_date'         => 'Calendar Date',
        'character'             => 'Character',
        'creator'               => 'Creator',
        'dice_roll'             => 'Dice Roll',
        'entity'                => 'Entity',
        'entry'                 => 'Entry',
        'event'                 => 'Event',
        'family'                => 'Family',
        'image'                 => 'Image',
        'is_private'            => 'Private',
        'location'              => 'Location',
        'name'                  => 'Name',
        'organisation'          => 'Organisation',
        'race'                  => 'Race',
        'section'               => 'Category',
    ],
    'filter'            => 'Filter',
    'filters'           => [
        'clear' => 'Clear Filters',
        'hide'  => 'Hide Filters',
        'show'  => 'Show Filters',
        'title' => 'Filters',
    ],
    'forms'             => [
        'actions'   => [
            'calendar'  => 'Add a calendar date',
        ],
    ],
    'hidden'            => 'Hidden',
    'hints'             => [
        'attribute_template'    => 'Apply an attribute template directly when creating this entity.',
        'calendar_date'         => 'A calendar date allows easy filtering in lists, and also maintains a calendar event in the selected calendar.',
        'image_limitations'     => 'Supported formats: jpg, png and gif. Max file size: :size.',
        'is_private'            => 'Hide from non "Admin" users.',
    ],
    'history'           => [
        'created'   => 'Created by <strong>:name</strong> <span data-toggle="tooltip" title=":realdate">:date</span>',
        'unknown'   => 'Unknown',
        'updated'   => 'Last modified by <strong>:name</strong> <span data-toggle="tooltip" title=":realdate">:date</span>',
    ],
    'image'             => [
        'error' => 'We weren\'t able to get the image you requested. It could be that the website doesn\'t allow us to download the image (typically for Squarespace and DeviantArt), or that the link is no longer valid.',
    ],
    'is_private'        => 'This entity is private and not visible by non-admin users.',
    'linking_help'      => 'How can I link to other entries?',
    'manage'            => 'Manage',
    'move'              => [
        'description'   => 'Move this entity to another place',
        'errors'        => [
            'permission'        => 'You aren\'t allowed to create entities of that type in the target campaign.',
            'same_campaign'     => 'You need to select another campaign to move the entity to.',
            'unknown_campaign'  => 'Unknown campaign.',
        ],
        'fields'        => [
            'campaign'  => 'New campaign',
            'target'    => 'New type',
        ],
        'hints'         => [
            'campaign'  => 'You can also try to move this entity to another campaign.',
            'target'    => 'Please be aware that some data might be lost when moving an element from one type to another.',
        ],
        'success'       => 'Entity \':name\' moved.',
        'title'         => 'Move :name',
    ],
    'new_entity'        => [
        'error' => 'Please review your values.',
        'fields'=> [
            'name'  => 'Name',
        ],
        'title' => 'New entity',
    ],
    'notes'             => [
        'actions'       => [
            'add'   => 'Add a note',
        ],
        'create'        => [
            'description'   => 'Create a new note',
            'success'       => 'Note \':name\' added to :entity.',
            'title'         => 'New Note for :name',
        ],
        'destroy'       => [
            'success'   => 'Note \':name\' for :entity removed.',
        ],
        'edit'          => [
            'description'   => 'Update an existing note',
            'success'       => 'Note \':name\' for :entity updated.',
            'title'         => 'Update note for :name',
        ],
        'fields'        => [
            'creator'   => 'Creator',
            'entry'     => 'Entry',
            'name'      => 'Name',
        ],
        'hint'          => 'Information that doesn\'t quite fit in the standard fields of an entity or that should be kept private can be added as Notes.',
        'index'         => [
            'title' => 'Notes for :name',
        ],
        'placeholders'  => [
            'name'  => 'Name of the note, observation or remark.',
        ],
    ],
    'or_cancel'         => 'or <a href=":url">cancel</a>',
    'panels'            => [
        'appearance'            => 'Appearance',
        'attribute_template'    => 'Attribute Template',
        'calendar_date'         => 'Calendar Date',
        'entry'                 => 'Entry',
        'general_information'   => 'General Information',
        'move'                  => 'Move',
        'system'                => 'System',
    ],
    'permissions'       => [
        'action'    => 'Action',
        'actions'   => [
            'delete'    => 'Delete',
            'edit'      => 'Edit',
            'read'      => 'Read',
        ],
        'allowed'   => 'Allowed',
        'fields'    => [
            'member'    => 'Member',
            'role'      => 'Role',
        ],
        'helper'    => 'Use this interface to fine-tune which users and roles that can interact with this entity.',
        'success'   => 'Permissions saved.',
        'title'     => 'Permissions',
    ],
    'placeholders'      => [
        'calendar'      => 'Choose a calendar',
        'character'     => 'Choose a character',
        'entity'        => 'Entity',
        'event'         => 'Choose an event',
        'family'        => 'Choose a family',
        'image_url'     => 'You can upload an image from a URL instead',
        'location'      => 'Choose a location',
        'organisation'  => 'Choose an organisation',
        'race'          => 'Choose a race',
        'section'       => 'Choose a category',
    ],
    'relations'         => [
        'actions'   => [
            'add'   => 'Add a relation',
        ],
        'fields'    => [
            'location'  => 'Location',
            'name'      => 'Name',
            'relation'  => 'Relation',
        ],
        'hint'      => 'Relations between entities can be set up to represent their connections.',
    ],
    'remove'            => 'Remove',
    'save'              => 'Save',
    'save_and_close'    => 'Save and Close',
    'save_and_new'      => 'Save and New',
    'save_and_update'   => 'Save and Update',
    'save_and_view'     => 'Save and View',
    'search'            => 'Search',
    'select'            => 'Select',
    'tabs'              => [
        'attributes'    => 'Attributes',
        'calendars'     => 'Calendars',
        'events'        => 'Events',
        'menu'          => 'Menu',
        'notes'         => 'Notes',
        'permissions'   => 'Permissions',
        'relations'     => 'Relations',
    ],
    'update'            => 'Update',
    'users'             => [
        'unknown'   => 'Unknown',
    ],
    'view'              => 'View',
];
