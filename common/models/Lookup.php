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
    
    public static $container_type = [
        0 => "Request",
        1 => "Approved",
        2 => "Cancel",
        3 => "Return",
        4 => "Return Approved",
        
        
     
    ];
    public static $consignee = [
        1 => "Alaroudh Used Cars & spare parts co llc",
        2 => "ARIANA WORLDWIDE SHIPPING LLC",
        3 => "AL AROUDH USED CARS CO LLC",
        4 => "FARID AHMAD",
    ];
    public static $status = [
        1 => "ON HAND",
        2 => "MANIFEST",
        3 => "CAR ON THE WAY",
        4 => "SHIPPED",
    ];
    public static  $location = [
        1 => "LA",
        2 => "GA",
        3 => "NY",
        4 => "TX",
    ];
    public static  $agent = [
        'NAME' => "Ariana Worldwide",
        'Address' => "7801 PARKHURST DR",
        'CITY' => " HOUSTON",
        'PHONE' => "l713-631-1560",
        'STATE' => "SOPHIA",
    ];
    public static  $title_type = [
        '1' => 'Clean title',
        '2' => 'Pending title',
        '3' => 'Bos title',
        '4' => 'Lien title',
        
    ];
    public static  $condition = [
        '1' => 'Operable',
        '0' => 'Non-Op',
    ];
    public static  $normal_condition = [
        '1' => 'Yes',
        '0' => 'No',
    ];

                    
        
}    