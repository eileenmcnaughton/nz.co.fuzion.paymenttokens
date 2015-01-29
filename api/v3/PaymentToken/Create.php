<?php
/**
 * @file
 * Created by PhpStorm.
 * User: eileen
 * Date: 19/11/2014
 * Time: 8:35 PM
 */

/**
 * Create payment token.
 *
 * @param array $params
 *
 * @return array
 *   API result array.
 *
 * @throws \API_Exception
 */
function civicrm_api3_payment_token_create($params) {
  return _civicrm_api3_basic_create('CRM_Payment_BAO_PaymentToken', $params);
}

function _civicrm_api3_payment_token_create_spec(&$params) {
}
