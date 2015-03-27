<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class CustomLogicHooks {
    public function beforeFetchQuery($bean, $event, $args) {
        $modules = array('calls', 'emails', 'meetings', 'notes', 'tasks');

        // Remove unwanted fields from SELECT
        $bad_fields = array('my_favorite', 'following');
        foreach($bad_fields as $b) {
            $ind = array_search($b, $args['fields']);
            if($ind !== false) {
                unset($args['fields'][$ind]);
            }
        }

        // Add related_id to SELECT
        if(!in_array('related_id', $args['fields'])) {
            $args['fields'][] = 'related_id';
        }

        // Remove alias from order by
        $order_by_field = $args['query']->order_by[0]->column->field;
        $order_by_dir = $args['query']->order_by[0]->column->direction;
        if($order_by_field === 'last_name') { $order_by_field = 'assigned_user_name__last_name'; } // Temporary fix for Assigned User Last Name coming in as "last_name"
        $args['query']->orderByReset();
        $args['query']->orderByRaw($order_by_field, $order_by_dir);

        // Loop through each Activity Module
        foreach($modules as $k=>$module) {
            $innerQuery = new SugarQuery();
            $innerQuery->from(BeanFactory::newBean(ucfirst($module)));

            // Loop through each field and add to inner SELECT
            foreach($args['fields'] as $field) {
                if($field === 'module') {
                    $innerQuery->select->fieldRaw('"'. $module . '"', 'module');
                } else if($field === 'related_module') {
                    $innerQuery->select->fieldRaw('LOWER(' . $module . '.parent_type)', 'related_module');
                } else if($field === 'related_id') {
                    $innerQuery->select->fieldRaw($module . '.parent_id', 'related_id');
                } else {
                    $innerQuery->select->field($field);
                }

                // WHERE
                foreach($innerQuery->where as $i=>$w) {
                    $innerQuery->where[$i] = clone $args['query']->where[$i]; // Cloning objects to get value instead of reference
                    foreach($innerQuery->where[$i]->conditions as $j=>$c) {
                        $innerQuery->where[$i]->conditions[$j] = clone $args['query']->where[$i]->conditions[$j];
                        $innerQuery->where[$i]->conditions[$j]->field = clone $args['query']->where[$i]->conditions[$j]->field;
                        $innerQuery->where[$i]->conditions[$j]->field->table = $module; // Change alias
                    }
                }
            }

            // Keep fields in the same order for all queries
            ksort($innerQuery->select->select);

            // Combine inner queries
            $args['query']->union($innerQuery);
        }

        //$GLOBALS['log']->fatal(print_r($args['query']->compileSql(), true));
    }
}
