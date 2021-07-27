<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function headerLocation() {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
