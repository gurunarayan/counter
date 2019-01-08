{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
	<div class="listViewPageDiv">
		<div class="listViewTopMenuDiv">
			<h3>Counters</h3>
            <hr>
			<div class="clearfix"></div>
		</div>
		<div class="listViewContentDiv" id="listViewContents" style="padding: 1%;">
			<br>
			<form name="counters" action="" method="post" class="form-horizontal" id="counters">
				{foreach item=COUNTER_DETAILS from=$COUNTER_BY_ID_DETAILS}
				{assign var=VIEWDATA value=$COUNTER_DETAILS.view|json_decode:true}
				<input type="hidden" name="module" value="Counters" />
				<input type="hidden" name="action" value="Save" />
				<input type="hidden" name="parent" value="Settings" />
			<div class="row-fluid">
				<label class="fieldLabel span3"><strong>{vtranslate('LBL_SELECT_MODULE',$QUALIFIED_MODULE)} </strong></label>
				<div class="span6 fieldValue">
					<select class="chzn-select" id="pickListModules" name="modulename">
						<optgroup>
							<option value="">{vtranslate('LBL_SELECT_OPTION',$QUALIFIED_MODULE)}</option>
							{foreach item=PICKLIST_MODULE from=$PICKLIST_MODULES}
								<option {if $SELECTED_MODULE_NAME eq $PICKLIST_MODULE->get('name')} selected="" {/if}  value="{$PICKLIST_MODULE->get('name')}">{vtranslate($PICKLIST_MODULE->get('label'),$QUALIFIED_MODULE)}</option>
							{/foreach}	
						</optgroup>
					</select>
				</div>
			</div><br>
			<div class="row-fluid">
				<label class="fieldLabel span3"><strong>Filters</strong></label>
					{assign var=SELECTED_MODULE_IDS value=array()}
					<input type="hidden" id="filterDetails" name="filters" value="{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($FILTER_NAME))}">	
					<select data-placeholder="add filter" id="menuListSelectElement" class="select2 span6" multiple="" data-validation-engine="validate[required]" style="width:21%;" name="filtersname">
						
							<optgroup>
							<option value="">{vtranslate('LBL_SELECT_OPTION',$QUALIFIED_MODULE)}</option>
							{foreach item=PICKLIST_MODULE from=$PICKLIST_MODULES}
								<option {if $SELECTED_MODULE_NAME eq $PICKLIST_MODULE->get('name')} selected="" {/if} value="{$PICKLIST_MODULE->get('name')}">{vtranslate($PICKLIST_MODULE->get('label'),$QUALIFIED_MODULE)}</option>
							{/foreach}	
						</optgroup>
					</select>
				</div><br>
			<div class="row-fluid">
				<label class="fieldLabel span3"><strong>Widget Available Location</strong></label>
				<div class="span6 fieldValue">
					<input type="checkbox" name="widgetview[]" value="List" {if List|in_array:$VIEWDATA} checked {/if}> List View&nbsp;
					<input type="checkbox" name="widgetview[]" value="Edit" {if Edit|in_array:$VIEWDATA} checked {/if}> Edit View&nbsp;
					<input type="checkbox" name="widgetview[]" value="Detail" {if Detail|in_array:$VIEWDATA} checked {/if}> Detail View&nbsp;
				</div>
			</div><br>
			<div class="row-fluid">
				<label class="fieldLabel span3"><strong>Name of Widget</strong></label>
				<div class="span6 fieldValue">
					
					
					<input type="text" name="nameofwidget" class="" value="{$COUNTER_DETAILS.countername}">
					{/foreach}
				</div>
			</div>
		</div>
       <div class="row-fluid">
            <div class="" style="margin-left: 340px">
				<button class="btn btn-success" id="button_save" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
				<a class="cancelLink" type="reset" onclick="javascript:window.history.back();">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</div>
			<div class="clearfix"></div>
        </div>
		<br>
    </form>
</div>
	{/strip}	
