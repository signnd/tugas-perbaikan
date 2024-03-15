<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = 'perbaikan';
    protected $fillable = ['judul', 'keterangan', 'status', 'created_at', 'updated_at', 'user_id'];

    public function eviden() {
        return $this->hasMany(Eviden::class, 'perbaikan_id', 'id');
    }
}
