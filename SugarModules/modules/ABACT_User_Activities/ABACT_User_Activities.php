<?php
require_once('modules/ABACT_User_Activities/ABACT_User_Activities_sugar.php');

class ABACT_User_Activities extends ABACT_User_Activities_sugar {

	function ABACT_User_Activities(){
		parent::ABACT_User_Activities_sugar();
	}

	function loadFromRow($arr) {
		$this->populateFromRow($arr);

		// This was being skipped in 6.7 for some reason, manually setting it
		if(empty($this->assigned_user_name) && !empty($arr['assigned_user_name'])) {
			$this->assigned_user_name = $arr['assigned_user_name'];
		}

		// Don't think I need all this
		//$this->processed_dates_times = array();
        //$this->check_date_relationships_load();
        //$this->fill_in_additional_list_fields();
        //if($this->hasCustomFields())$this->custom_fields->fill_relationships();
		//$this->call_custom_logic("process_record");
	}

	function create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect) {
		global $app_list_strings;
		$app_list_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS'] = 'You currently have no records saved.';
		$app_list_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS_SUBMSG'] = '';

        $ret_array = parent::create_new_list_query($order_by, $where,$filter,$params, $show_deleted,$join_type, $return_array,$parentbean, $singleSelect);

		$where = str_replace('_cstm', '', $ret_array['where']);
		$where = str_replace('abact_user_activities', 'act', $where);

		// Extract custom fields from WHERE to outer query
		$where_temp = str_replace('where ', '', $where);
		$where_arr = explode(' AND ', $where_temp);
		$paren_beg = $paren_end = '';
		$where_outside_arr = array();
		foreach($where_arr as $k=>$w) {
			if(strpos($w, 'act.module') !== false || strpos($w, 'act.related_module') !== false || strpos($w, 'act.related_name') !== false) {
				$open = substr_count($w, '(');
				$closed = substr_count($w, ')');
				$diff = ($open - $closed);
				if($diff > 0) {
					$paren_beg .= '(';
					$w = preg_replace('/\(/', '', $w, $diff);
				} else if ($diff < 0) {
					$paren_end .= ')';
					$w = preg_replace('/\)/', '', $w, abs($diff));
				}
				$where_outside_arr[] = str_replace('act.', '', $w);
				unset($where_arr[$k]);
			}
		}
		$where = ' where ' . $paren_beg . implode(' AND ', $where_arr) . $paren_end;


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
		$from .= ' ) AS t1 ';
		if(!empty($where_outside_arr)) {
			$from .= ' WHERE ' . implode(' AND ', $where_outside_arr);
		}

		$ret_array['from'] = $from;
        $ret_array['from_min'] = '';
        $ret_array['where'] = '';
        $ret_array['order_by'] = ' ORDER BY ' . $order_by;

        return $ret_array;
    }

}
