<?php
// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'CRM_Contactsummarymembershipreport_Form_Report_CSM',
    'entity' => 'ReportTemplate',
    'params' => 
    array (
      'version' => 3,
      'label' => 'Contact Summary With Membership Type Report',
      'description' => 'Extended Contact Summary report with support of filtering/showing custom fields of Individual contact along with Membership Type.',
      'class_name' => 'CRM_Contactsummarymembershipreport_Form_Report_CSM',
      'report_url' => 'au.com.agileware.contactsummarymembershipreport/CSM',
      'component' => '',
    ),
  ),
);
