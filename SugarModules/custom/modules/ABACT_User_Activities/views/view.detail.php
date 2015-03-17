<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class ABACT_User_ActivitiesViewDetail extends ViewDetail {
    function ABACT_User_ActivitiesViewDetail() {
 		parent::ViewDetail();
 	}

    function display() {
        unset($this->dv->defs['templateMeta']['form']['buttons'][0]);
        $this->dv->process();
        echo $this->dv->display();
    }
}
