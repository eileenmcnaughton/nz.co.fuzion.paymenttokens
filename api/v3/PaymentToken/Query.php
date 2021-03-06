<?php
/**
 * Created by PhpStorm.
 * User: eileen
 * Date: 20/11/2014
 * Time: 10:36 AM
 */
/**
 * Query details of a token.
 */
function civicrm_api3_payment_token_query($params) {
  $token = CRM_Core_DAO::executeQuery(
    "SELECT r.id as contribution_recur_id, r.payment_processor_id, r.processor_id, t.id as token_id, r.contact_id
     FROM civicrm_contribution_recur r LEFT JOIN civicrm_payment_token t ON t.token = r.processor_id
     WHERE (t.expiry_date IS NULL OR t.expiry_date < DATE_ADD(NOW(), INTERVAL 6 WEEK))
     AND r.processor_id IS NOT NULL
     AND r.payment_processor_id IS NOT NULL"
  );
  $result = array();
  while ($token->fetch()) {
    try {
      $tokenParams = array(
        'contribution_recur_id' => $token->contribution_recur_id,
        'payment_processor_id' => $token->payment_processor_id,
        'id' => $token->token_id,
      );
      $processor = getProcessorName($token->payment_processor_id);
      $query = civicrm_api3($processor, 'tokenquery', array(
          'contribution_recur_id' => $token->contribution_recur_id,
          'sequential' => 1,
        ));

      $result[$token->contribution_recur_id] = $query['values'][0];
      if (!empty($query['values'][0])) {
        $tokenParams = array_merge($tokenParams, $query['values'][0]);
      }

      $tokenCreate = civicrm_api3('payment_token', 'create', $tokenParams);
      civicrm_api3('ContributionRecur', 'create', array('id' => $token->contribution_recur_id, 'payment_token_id' => $tokenCreate['id']));
      $result[$token->contribution_recur_id]['token_id'] = $tokenCreate['id'];
    }
    catch (Exception $e) {
      $result[$token->contribution_recur_id] = array('message' => $e->getMessage());
    }
  }
  return civicrm_api3_create_success($result, $params);
}

/**
 * Get the name (entity) of the processor in use.
 *
 * @param int $payment_processor_id
 *
 * @return string
 * @throws \CiviCRM_API3_Exception
 */
function getProcessorName($payment_processor_id) {
  static $processors = array();
  if (empty($processors[$payment_processor_id])) {
    $processorTypeID = civicrm_api3('payment_processor', 'getvalue', array(
      'id' => $payment_processor_id,
      'return' => 'payment_processor_type_id',
    ));
    $processors[$payment_processor_id] = civicrm_api3('payment_processor_type', 'getvalue', array(
      'id' => $processorTypeID,
      'return' => 'name',
    ));
  }
  return $processors[$payment_processor_id];
}
