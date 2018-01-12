<?php

namespace common\models;

use Yii;

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
class Lookup {
    public static $user_type = [
        1 => "Super Admin",
        2 => "Management Team",
        2 => "Management Team Seller",
        3 => "Super Vip Team ",
        3 => "Super Vip Team Seller",
        3 => "VIP Team",
        3 => "VIP Team Sellers",
        3 => "PRO Level",
        3 => "INTER Level",
        3 => "ADVANCE Level",
        4 => "BEGIN Level",
    ];
    public static $status = [
        0 => "Pending",
        1 => "Approved",
        2 => "Request Canceled",
        3 => "Return Request",
        3 => "Return Cancelled",
        4 => "Return Approved",
        5 => "Return Request",
        6 => "Return Approved ",
        7 => "Return Canceled",
       
    ];
} 
        
     
        