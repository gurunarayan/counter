<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_Counters_Save_Action extends Settings_Vtiger_Index_Action {

	public function process(Vtiger_Request $request) {
		$db = PearDatabase::getInstance();
		$moduleName = $request->getModule(false);
		echo $moduleName;
		$countersModuleModel = Settings_Vtiger_Module_Model::getInstance();
		$modulename	=	$request->get('modulename');
		$filtersname	=	$request->get('filtersname');
		$widgetview	=	json_encode($request->get('widgetview'));
		$nameofwidget	=	$request->get('nameofwidget');
		$query	=	"INSERT INTO vtiger_counters(module,view,filtername,countername) VALUES('$modulename','$widgetview','$filtersname','$nameofwidget')";
		$db->query($query);
		$loadUrl = $countersModuleModel->getIndexViewUrl();
		header("Location: $loadUrl");
	}

        public function validateRequest(Vtiger_Request $request) { 
            $request->validateWriteAccess(); 
        }
}
