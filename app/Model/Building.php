<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class building extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'address'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}