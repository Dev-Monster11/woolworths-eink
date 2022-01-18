<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $product_name
 * @property string $unit_quantity
 * @property string $unit_of_measurement
 * @property string $product_price
 * @property string $breakdown_price
 * @property string $breakdown_divisor
 * @property string $breakdown_quantity
 * @property string $breakdown_unit
 * @property string $ip_address
 * @property string $mac_address
 * @property string $barcode_data
 * @property string $barcode_id
 * @property string $sub_barcode_id
 * @property string $qr_code_data
 * @property string $sale_mode
 * @property string $half_price_mode
 * @property string $half_price_value
 * @property string $last_edited
 */
class Tag extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'eink_tags';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';
    
    /**
     * @var array
     */
    // protected $fillable = ['product_name', 'unit_quantity', 'unit_of_measurement', 'product_price', 'breakdown_price', 'breakdown_divisor', 'breakdown_quantity', 'breakdown_unit', 'ip_address', 'mac_address', 'barcode_data', 'barcode_id', 'sub_barcode_id', 'qr_code_data', 'sale_mode', 'half_price_mode', 'half_price_value', 'last_edited'];
    protected $fillable = ['ip_address', 'mac_address'];
}
