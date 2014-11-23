<?php
/**
 * Created by PhpStorm.
 * User: eileen
 * Date: 20/11/2014
 * Time: 10:36 AM
 */
/**
 * Created by PhpStorm.
 * User: eileen
 * Date: 19/11/2014
 * Time: 8:35 PM
 */
function civicrm_api3_payment_token_query($params) {
  $token = CRM_Core_DAO::executeQuery(
    "SELECT r.id, r.payment_processor_id, r.processor_id, t.id as token_id FROM civicrm_contribution_recur r LEFT JOIN civicrm_payment_token t ON t.code= r.processor_id
     WHERE t.expiry_date IS NULL
     AND r.processor_id IS NOT NULL"
  );
  $result = array();
  while ($token->fetch()) {
    try {
      $processorTypeID = civicrm_api3('payment_processor', 'getvalue', array('id' => $token->payment_processor_id, 'return' => 'payment_processor_type_id'));
      $processor = civicrm_api3('payment_processor_type', 'getvalue', array('id' => $processorTypeID, 'return' => 'name'));
      $query = civicrm_api3($processor, 'tokenquery', array('contribution_recur_id' => $token->id, 'sequential' => 1));
      $result[$token->id] = $query['values'][0];
      if (!empty($existingToken['values'][0])) {
        $token = array_merge($existingToken['values'][0], $token);
      }
      print_r($token);
      $tokenCreate = civicrm_api3('payment_token', 'create', $token);
    }
    catch (Exception $e) {
      //continue
    }
  }
  return civicrm_api3_create_success($result, $params);
}
