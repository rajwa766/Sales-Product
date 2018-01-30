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
  
    public static $status = [
        0 => "Pending",
        1 => "Approved",
        2 => "Request Canceled",
        3 => "Return Request",
        4 => "Return Approved",
        5 => "Transfer Request",
        6 => "Transfer Approved",
        7 => "Transfer Canceled",
        8 => "Return Canceled",
        9 => "Bonus",
       
    ];
    public static $accounts = [
        1 => 'Asset',
    
    ];
    
    public static $levels[
        'SUPER ADMIN ' => '1',
        'MR ' => '2',
        'MR ' => '2',
        
        
        
    ]
    public static $order_status = [
        '1' => 'Credit Card',
        '2' => 'Cash on Delivery',
        '3' => 'Bank Transfer',
    ];
} 
        
     
        