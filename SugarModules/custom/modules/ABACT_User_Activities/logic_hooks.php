<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['before_fetch_query'] = Array();
$hook_array['before_fetch_query'][] = array(1, 'CustomLogicHooks', 'custom/modules/ABACT_User_Activities/CustomLogicHooks.php', 'CustomLogicHooks', 'beforeFetchQuery');
