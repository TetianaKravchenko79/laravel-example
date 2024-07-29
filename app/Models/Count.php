<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Count extends Model {

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

}
