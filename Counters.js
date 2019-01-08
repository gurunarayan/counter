/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
jQuery.Class('Settings_Counters_Js', {}, {
	getCounterFilters : function(){
		jQuery("#pickListModules").on('change',function(){
			var modulename = $(this).val();
			var filterName	=	$('#filterDetails').val();
			
			var filterName = jQuery.parseJSON(filterName);
			console.log(filterName);
			var specificmodule = filterName[modulename];
			//jQuery("#menuListSelectElement").html("").trigger("liszt:updated");
			jQuery("#menuListSelectElement").select2("val", "");
			var optionslist = '<option>Select an Option</option>';
			jQuery.each(specificmodule,function(k,v){
				optionslist = optionslist+"<option value='"+k+"'>"+v+"</option>";
			});
			console.log(optionslist);
			jQuery("#menuListSelectElement").html(optionslist).trigger("liszt:updated");
			app.changeSelectElementView(jQuery("#menuListSelectElement"));
			
		});
	},
	triggerDelete : function() {
		jQuery('.deleteRecordButton').on('click',function(event){
		event.stopPropagation();
		var currentTarget = jQuery(event.currentTarget);
		var currentTrEle = currentTarget.closest('tr');
		
		var message = app.vtranslate('JS_LBL_ARE_YOU_SURE_YOU_WANT_TO_DELETE');
		Vtiger_Helper_Js.showConfirmationBox({'message' : message}).then(
			function(e) {
				instance.deleteDependency(module, sourceField, targetField).then(
					function(data){
						var params = {};
						params.text = app.vtranslate('JS_DEPENDENCY_DELETED_SUEESSFULLY');
						Settings_Vtiger_Index_Js.showMessage(params);
						currentTrEle.fadeOut('slow').remove();
					}
				);
			},
			function(error, err){
				
			}
		);
		});
	},
	
	registerEvents : function(e){
		var thisInstance = this;
		thisInstance.getCounterFilters();
		this.triggerDelete();
		//var container = thisInstance.getContainer();
		//var selectElement = thisInstance.getMenuListSelectElement();
		//var select2Element = app.getSelect2ElementFromSelect(selectElement);
		//var form = thisInstance.getForm();
		
	}
	
});
jQuery(document).ready(function(){
	var settingCountersInstance = new Settings_Counters_Js();
	settingCountersInstance.registerEvents();
})
hskhskhgskgjlsfjglgjlskgjslkgj
