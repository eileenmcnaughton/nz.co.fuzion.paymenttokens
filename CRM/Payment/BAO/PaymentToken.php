<?php
/**
 * Created by PhpStorm.
 * User: eileen
 * Date: 19/11/2014
 * Time: 8:48 PM
 */
class CRM_Payment_BAO_PaymentToken extends CRM_Payment_DAO_PaymentToken
{
    static function create($params)
    {
        $hook = empty($params['id']) ? 'create' : 'edit';

        CRM_Utils_Hook::pre($hook, 'PaymentToken', CRM_Utils_Array::value('id', $params), $params);
        $instance = new CRM_Payment_DAO_PaymentToken();
        $instance->copyValues($params);
        $instance->save();
        CRM_Utils_Hook::post($hook, 'PaymentToken', $instance->id, $instance);

        return $instance;
    }
}
