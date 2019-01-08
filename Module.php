<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_Counters_Module_Model extends Vtiger_Module_Model {

    public function getPickListTableName($fieldName) {
        return 'vtiger_'.$fieldName;
    }

    public function getFieldsByType($type) {
		$presence = array('0','2');

hkjshgkkghdkghdkjgdkfjg        $fieldModels = parent::getFieldsByType($type);
        $fields = array();
        foreach($fieldModels as $fieldName=>$fieldModel) {
            if(($fieldModel->get('displaytype') != '1' && $fieldName != 'salutationtype') || !in_array($fieldModel->get('presence'),$presence)) {
                continue;
            }
            $fields[$fieldName] = Settings_Picklist_Field_Model::getInstanceFromFieldObject($fieldModel);
        }
        return $fields;
    }


    public static function getModulesForCounters() {
         $db = PearDatabase::getInstance();

        // vtlib customization: Ignore disabled modules.
        $query = 'SELECT vtiger_tab.name,vtiger_tab.tablabel as tabname FROM vtiger_tab
                        WHERE isentitytype=1';
        // END
        $result = $db->pquery($query, array());

        $modulesModelsList = array();
        while($row = $db->fetch_array($result)){
            $moduleName  = $row['name'];
			$moduleLabel  = $row['tabname'];
            $instance = new self();
            $instance->name = $moduleName;
            $instance->label = $moduleLabel;
            $modulesModelsList[] = $instance;
        }
        return $modulesModelsList;
    }

	public static function getFiltersForCounters() {
         $db = PearDatabase::getInstance();

        // vtlib customization: Ignore disabled modules.
        $query = 'SELECT vtiger_customview.entitytype,vtiger_customview.viewname,vtiger_cvcolumnlist.cvid FROM vtiger_customview INNER JOIN vtiger_cvcolumnlist ON vtiger_customview.cvid=vtiger_cvcolumnlist.cvid group by cvid';
        // END
        $result = $db->pquery($query, array());
		
        $filtersList = array();
        while($row = $db->fetch_array($result)){
            $moduleName  = $row['entitytype'];
			$moduleFilter  = $row['viewname'];
			$cvId  = $row['cvid'];
			$filtersList[$moduleName][$cvId] =$moduleFilter;          
        }
        //echo "<pre>"; echo print_r($filtersList);die;
       return $filtersList;
    }
    public static function getCountersDataFromDb() {
         $db = PearDatabase::getInstance();

        // vtlib customization: Ignore disabled modules.
        $query = 'SELECT * FROM vtiger_counters';
        // END
        $result = $db->pquery($query, array());
       return $result;
    }
	public static function getcountersByRecordId($request) {
         $db = PearDatabase::getInstance();
        // vtlib customization: Ignore disabled modules.
        $query = 'SELECT * FROM vtiger_counters WHERE counterid='.$request->get('record');
        // END
        $result = $db->pquery($query, array());
       return $result;
    }
    /**
	 * Static Function to get the instance of Vtiger Module Model for the given id or name
	 * @param mixed id or name of the module
	 */
	public static function getInstance($value) {
		//TODO : add caching
		$instance = false;
		    $moduleObject = parent::getInstance($value);
		    if($moduleObject) {
			$instance = self::getInstanceFromModuleObject($moduleObject);
		    }
		return $instance;
	}

	/**
	 * Function to get the instance of Vtiger Module Model from a given Vtiger_Module object
	 * @param Vtiger_Module $moduleObj
	 * @return Vtiger_Module_Model instance
	 */
	public static function getInstanceFromModuleObject(Vtiger_Module $moduleObj){
		$objectProperties = get_object_vars($moduleObj);
		$moduleModel = new self();
		foreach($objectProperties as $properName=>$propertyValue){
			$moduleModel->$properName = $propertyValue;
		}
		return $moduleModel;
	}
}
