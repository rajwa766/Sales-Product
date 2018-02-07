<?php

namespace common\models;

/**
 * This is the model class for table "cash".
 *
 * @property integer $ID
 * @property string $name
 * @property string $details
 * @property double $total
 *
 * @property MoneyTransactions[] $moneyTransactions
 */
class Lookup
{

    public static $status = [
        '0' => "Pending",
        '1' => "Approved",
        '2' => "Request Canceled",
        '3' => "Return Request",
        '4' => "Return Approved",
        '5' => "Transfer Request",
        '6' => "Transfer Approved",
        '7' => "Transfer Canceled",
        '8' => "Return Canceled",
        '9' => "Bonus",

    ];
   
    public static $order_status = [
        '1' => 'Credit Card',
        '2' => 'Cash on Delivery',
        '3' => 'Bank Transfer',
    ];
    public static $user_status = [
        '1' => 'Active',
        '2' => 'In Active',
    ];
    public static $user_levels = [
        '1' => 'Super Admin',
        '2000' => 'Management Team',
        '3000' => 'Management Team Inter Level',
        '4000' => 'Management Team Pro Level',
        '5000' => 'Management Team Advance Level',
        '6000' => 'Management Team Begin Level',
        '7000' => 'Super Vip Team',
        '8000' => 'Super Vip Team Inter Level',
        '9000' => 'Super Vip Team Pro Level',
        '10000' => 'Super Vip Team Advance Level',
        '11000' => 'Super Vip Team Begin Level',
        '12000' => 'VIP Team',
        '13000' => 'VIP Team Inter Level',
        '14000' => 'VIP Team Pro Level',
        '15000' => 'VIP Team Advance Level',
        '16000' => 'VIP Team Begin Level',

    ];
    public static $seller_levels = [
        '3000' => 'Management Team Inter Level',
        '4000' => 'Management Team Pro Level',
        '5000' => 'Management Team Advance Level',
        '6000' => 'Management Team Begin Level',
        '8000' => 'Super Vip Team Inter Level',
        '9000' => 'Super Vip Team Pro Level',
        '10000' => 'Super Vip Team Advance Level',
        '11000' => 'Super Vip Team Begin Level',
        '13000' => 'VIP Team Inter Level',
        '14000' => 'VIP Team Pro Level',
        '15000' => 'VIP Team Advance Level',
        '16000' => 'VIP Team Begin Level',

    ];

}
