<?php
$module_name = 'ABACT_User_Activities';
$searchdefs[$module_name] =
array (
  'layout' =>
  array (
    'basic_search' =>
    array (
      0 => 'name',
      1 =>
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' =>
    array (
      'name' =>
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'assigned_user_id' =>
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' =>
        array (
          'name' => 'get_user_array',
          'params' =>
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'module' =>
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_MODULE',
        'width' => '10%',
        'default' => true,
        'name' => 'module',
      ),
      'date_entered' =>
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'date_modified' =>
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_modified',
      ),
      'related_module' =>
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_RELATED_MODULE',
        'width' => '10%',
        'default' => true,
        'name' => 'related_module',
      ),
      'parent_name' =>
      array (
        'type' => 'varchar',
        'label' => 'LBL_PARENT_NAME',
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),
    ),
  ),
  'templateMeta' =>
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' =>
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
