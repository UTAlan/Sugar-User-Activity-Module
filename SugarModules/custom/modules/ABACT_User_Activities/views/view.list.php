<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.list.php');

class ABACT_User_ActivitiesViewList extends ViewList {
    function ABACT_User_ActivitiesViewList() {
 		parent::ViewList();
 	}

    function display() {
        echo '<style type = "text/css">span.utils a.utilsLink { display:none !important; } #shortcuts > span > span:first-child { display: none !important; } table.list.view > tbody > tr > td:first-child { display: none; } table.list.view > tbody > tr.pagination > td:first-child { display: table-cell; }</style>';

        if(!$this->bean || !$this->bean->ACLAccess('list')){
            ACLController::displayNoAccess();
        } else {
            $this->listViewPrepare();
            $this->listViewProcess();
        }
    }

    function listViewProcess() {
        global $app_strings;
        $app_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS'] = 'You currently have no records saved.';
        $app_strings['MSG_EMPTY_LIST_VIEW_NO_RESULTS_SUBMSG'] = '';

        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;
        $this->lv->multiSelect = false;

        if(!$this->headers)
            return;
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH",true);
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
     }
}
