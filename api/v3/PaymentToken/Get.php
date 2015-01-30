<?php
/**
 * Created by PhpStorm.
 * User: eileen
 * Date: 19/11/2014
 * Time: 8:35 PM
 */

/**
 * Get payment token.
 *
 * @param $params
 *
 * @return array
 */
function civicrm_api3_payment_token_get($params) {
    return _civicrm_api3_basic_get('CRM_Payment_BAO_PaymentToken', $params);
}
