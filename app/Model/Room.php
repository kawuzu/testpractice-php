<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'type', 'area', 'seats', 'building_id'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}