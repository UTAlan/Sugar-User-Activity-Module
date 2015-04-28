<?php
$manifest = array (
    'acceptable_sugar_flavors' => array('CE', 'PRO', 'CORP', 'ENT', 'ULT'),
    'acceptable_sugar_versions' => array (
        'exact_matches' => array(),
        'regex_matches' => array('6\\.[0-9]\\.[0-9]', '7\\.[0-9]\\.[0-9]', '7\\.[0-9]\\.[0-9]\\.[0-9]'),
    ),
    'author' => 'Alan Beam',
    'description' => 'Installs a custom module that allows you to view all Activities in a single List View.',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'User_Activities',
    'published_date' => '2015-04-27 00:00:00',
    'type' => 'module',
    'version' => '1.1.3',
    'key' => 'ABACT',
    'readme' => '',
    'type' => 'module',
    'remove_tables' => '',
);


$installdefs = array (
    'id' => 'User_Activities',
    'beans' => array (
        0 => array (
            'module' => 'ABACT_User_Activities',
            'class' => 'ABACT_User_Activities',
            'path' => 'modules/ABACT_User_Activities/ABACT_User_Activities.php',
            'tab' => true,
        ),
    ),
    'layoutdefs' => array (),
    'relationships' => array (),
    'image_dir' => '<basepath>/icons',
    'copy' => array (
        0 => array (
            'from' => '<basepath>/SugarModules/modules/ABACT_User_Activities',
            'to' => 'modules/ABACT_User_Activities',
        ),
        1 => array (
            'from' => '<basepath>/SugarModules/custom/modules/ABACT_User_Activities',
            'to' => 'custom/modules/ABACT_User_Activities',
        ),
    ),
    'custom_fields' => array (
        array(
            'name' => 'parent_name',
            'vname' => 'LBL_PARENT_NAME',
            'type'=>'parent',
        	'module' => 'ABACT_User_Activities',
            'parent_type'=>'record_type_display' ,
        	'type_name'=>'parent_type',
        	'id_name'=>'parent_id',
        	'group'=>'parent_name',
        	'source'=>'non-db',
        	'options'=> 'parent_type_display',
        	'studio' => true,
            'help' => '',
            'comments' => '',
            'no_default' => false,
            'max_size' => 255,
            'required' => false,
            'reportable' => true,
            'audited' => false,
            'importable' => 'true',
            'duplicate_merge' => false,
        ),
    ),
    'language' => array (
        0 => array (
            'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ),
    ),
);
