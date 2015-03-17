<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.edit.php');

class ABACT_User_ActivitiesViewEdit extends ViewEdit {
    function ABACT_User_ActivitiesViewEdit() {
 		parent::ViewEdit();
 	}

    function display(){
        echo '<style type = "text/css">span.utils a.utilsLink { display:none !important; } #shortcuts > span > span:first-child { display: none !important; }</style>';

        sugar_die('You cannot create or edit records here. <a href="javascript:window.history.back();">Go back.</a>');
    }
}
