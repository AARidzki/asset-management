<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Demand;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry_Item extends Model
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

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }
}
