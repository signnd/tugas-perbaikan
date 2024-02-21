<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eviden extends Model
{
    use HasFactory;
    protected $table = 'eviden';
    protected $fillable = ['perbaikan_id', 'filename'];

    public function perbaikan() {
        return $this->belongsTo(Perbaikan::class);
    }
}
