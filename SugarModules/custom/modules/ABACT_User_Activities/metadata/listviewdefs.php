<?php
$module_name = 'ABACT_User_Activities';
$listViewDefs [$module_name] =
array (
  'MODULE' =>
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_MODULE',
    'width' => '10%',
  ),
  'NAME' =>
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'customCode' => '<a href="index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3D{$MODULE}%26action%3DDetailView%26record%3D{$ID}">{$NAME}</a>',
  ),
  'RELATED_MODULE' =>
  array (
    'width' => '10%',
    'label' => 'LBL_RELATED_MODULE',
    'default' => true,
    'customCode' => '{$RELATED_MODULE}',
  ),
  'RELATED_NAME' =>
  array (
    'width' => '10%',
    'label' => 'LBL_RELATED_NAME',
    'default' => true,
    'customCode' => '<a href="index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3D{$RELATED_MODULE}%26action%3DDetailView%26record%3D{$RELATED_ID}">{$RELATED_NAME}</a>',
  ),
  'ASSIGNED_USER_NAME' =>
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'DATE_ENTERED' =>
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_MODIFIED' =>
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
);
?>
