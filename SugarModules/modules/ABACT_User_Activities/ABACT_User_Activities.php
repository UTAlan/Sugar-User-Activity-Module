<?php
require_once('modules/ABACT_User_Activities/ABACT_User_Activities_sugar.php');

class ABACT_User_Activities extends ABACT_User_Activities_sugar {

	function ABACT_User_Activities(){
		parent::ABACT_User_Activities_sugar();
	}

	function create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect) {
		global $app_list_strings;
		$app_list_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS'] = 'You currently have no records saved.';
		$app_list_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS_SUBMSG'] = '';

        $ret_array = parent::create_new_list_query($order_by, $where,$filter,$params, $show_deleted,$join_type, $return_array,$parentbean, $singleSelect);

		$where = str_replace('_cstm', '', $ret_array['where']);
		$where = str_replace('abact_user_activities', 'act', $where);

		// For Searching on these fields
		//$where = str_replace('module', '?', $where);
		//$where = str_replace('related_module', '?', $where);
		//$where = str_replace('related_name', '?', $where);

		$modules = array('calls', 'emails', 'meetings', 'notes', 'tasks');
		$related = array('accounts', 'bugs', 'cases', 'contacts', 'leads', 'opportunities', 'project', 'project_task', 'prospects', 'tasks');
		$concat  = array('contacts', 'leads', 'prospects');

        $ret_array['select'] = 'SELECT * ';
        $from = ' FROM ( ';
		foreach($modules as $k=>$module) {
			if($k > 0) { $from .= ' UNION '; }
			$from .= ' ( SELECT act.id, act.name, act.date_entered, act.date_modified, "' . ucfirst($module) . '" AS module, act.parent_type AS related_module, act.parent_id AS related_id, act.assigned_user_id, CONCAT(u.first_name, " ", u.last_name) AS assigned_user_name, ';
			$count = '';
			foreach($related as $rel) {
				$from .= ' IF( ' . $rel . '.id IS NOT NULL, ' . (in_array($rel, $concat) ? ' CONCAT( ' . $rel . '.first_name, " ", ' . $rel . '. last_name), ' : $rel . '.name, ');
				$count .= ' ) ';
			}
			$from .= ' "" ' . $count . ' AS related_name FROM ' . $module . ' act ';
			foreach($related as $rel) {
				$from .= ' LEFT JOIN ' . $rel . ' ON ' . $rel . '.id = act.parent_id ';
			}
			$from .= ' LEFT JOIN users u ON u.id = act.assigned_user_id ' . $where . ' ) ';
		}
		$from .= ' ) AS t1';

		$ret_array['from'] = $from;
        $ret_array['from_min'] = '';
        $ret_array['where'] = '';
        $ret_array['order_by'] = ' ORDER BY ' . $order_by;

		//echo '<pre>'.print_r($ret_array, true).'</pre>';

        return $ret_array;
    }

}