<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:20
 */

namespace WebAppId\Plane\Models;


use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    protected $table = 'planes';
    
    protected $fillable = ['id', 'name', 'iata_code', 'icao_code'];
}