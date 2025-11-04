<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['name', 'address'];

    public $timestamps = false;
}
