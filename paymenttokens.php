<?php

require_once 'paymenttokens.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function paymenttokens_civicrm_config(&$config) {
  _paymenttokens_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function paymenttokens_civicrm_xmlMenu(&$files) {
  _paymenttokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function paymenttokens_civicrm_install() {
  return _paymenttokens_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function paymenttokens_civicrm_uninstall() {
  return _paymenttokens_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function paymenttokens_civicrm_enable() {
  return _paymenttokens_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function paymenttokens_civicrm_disable() {
  return _paymenttokens_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function paymenttokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _paymenttokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function paymenttokens_civicrm_managed(&$entities) {
  return _paymenttokens_civix_civicrm_managed($entities);
}

/**
 * implements hook civicrm_alter_drupal_entities
 *
 * @param array $whitelist
 */
function paymenttokens_civicrm_alter_drupal_entities(&$whitelist) {
  $whitelist['civicrm_payment_token'] = 'payment_token';
}

/**
 * implements hook civicrm_alter_drupal_entity_labels
 *
 * @param $labels
 */
function paymenttokens_civicrm_alter_drupal_entity_labels(&$labels) {
  $labels['civicrm_payment_token'] = 'code';
}
