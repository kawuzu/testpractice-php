<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['name', 'address'];

    // Отключаем авто-таймстампы, если их нет в БД
    public $timestamps = false;
}
