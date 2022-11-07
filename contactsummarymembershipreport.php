<?php

require_once 'contactsummarymembershipreport.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contactsummarymembershipreport_civicrm_config(&$config) {
  _contactsummarymembershipreport_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contactsummarymembershipreport_civicrm_install() {
  _contactsummarymembershipreport_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function contactsummarymembershipreport_civicrm_postInstall() {
  _contactsummarymembershipreport_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contactsummarymembershipreport_civicrm_uninstall() {
  _contactsummarymembershipreport_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contactsummarymembershipreport_civicrm_enable() {
  _contactsummarymembershipreport_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contactsummarymembershipreport_civicrm_disable() {
  _contactsummarymembershipreport_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contactsummarymembershipreport_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contactsummarymembershipreport_civix_civicrm_upgrade($op, $queue);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contactsummarymembershipreport_civicrm_navigationMenu(&$menu) {
  _contactsummarymembershipreport_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'au.com.agileware.contactsummarymembershipreport')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contactsummarymembershipreport_civix_navigationMenu($menu);
} // */

/**
 * Implements hook_civicrm_entityTypes().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function contactsummarymembershipreport_civicrm_entityTypes(&$entityTypes) {
  _contactsummarymembershipreport_civix_civicrm_entityTypes($entityTypes);
}
