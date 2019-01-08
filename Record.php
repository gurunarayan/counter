<?php
class Settings_Counters_Record_Model extends Settings_Vtiger_Record_Model {
public function getModule() {
		return $this->module;
	}
	/**
	 * Function to get Id of this record instance
	 * @return <Integer> Id
	 */
	public function getId() {
		return $this->get('id');
	}
	/**
	 * Function to get Name of this record instance
	 * @return <String> Name
	 */
	public function getName() {
		return $this->get('name');
	}
/**
 * Function to get Edit view url
 * @return <String> Url
 */
public function getEditViewUrl() {
	$moduleModel = $this->getModule();
	return "index.php?module=".$moduleModel->getName()."&parent=".$moduleModel->getParentName()."&view=Edit&record=".$this->getId();
}
public static function getInstance($counterId) {
		$self = new self();
		$self->set('counterId', $counterId)
		return $self;
	}
}
i love to remove file
