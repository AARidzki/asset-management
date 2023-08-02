<?php

namespace App\Models;

use App\Models\Demand;
use App\Models\Monitor;
use App\Models\Category;
use App\Models\Location;
use App\Models\Entry_Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
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
