<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = ['name','type','area','seats','building_id'];

    public $timestamps = false;
}
