<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $network_band
 * @property string $vendor_name
 */
class ScanSetting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['network_band', 'vendor_name'];

}
