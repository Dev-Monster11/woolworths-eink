<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $itaskid
 * @property string $strweekday
 * @property int $ihour
 * @property int $iminute
 * @property int $ihalfday
 * @property string $strcolor
 */
class ErrorList extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'error_list';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * @var array
     */
    protected $fillable = ['id', 'err_type_id', 'user', 'account','tag_id'];
}
