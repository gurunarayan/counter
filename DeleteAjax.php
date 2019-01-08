<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_Counters_DeleteAjax_Action extends Settings_Vtiger_Index_Action {
    
    public function process(Vtiger_Request $request) {
		$counterId = $request->get('counterId');
		global $adb;
		$adb->pquery("DELETE FROM vtiger_counters WHERE counterid=?",array($counterId));
		
    }
    public function validateRequest(Vtiger_Request $request) { 
        $request->validateWriteAccess(); 
    }
}
