<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Demand;
use App\Models\Monitor;
use App\Models\Entry_Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function asset()
    {
        return $this->hasMany(Asset::class);
    }

    public function demand()
    {
        return $this->hasMany(Demand::class);
    }

    public function entry_item()
    {
        return $this->hasMany(Entry_Item::class);
    }

    public function monitor()
    {
        return $this->hasMany(Monitor::class);
    }
}
