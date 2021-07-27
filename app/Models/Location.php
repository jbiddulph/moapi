<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Header;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function headers() {
        return $this->hasMany(Header::class);
    }
}
