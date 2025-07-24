<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $with = ['grade'];
    protected $fillable = ['nama', 'grade_id', 'major_id', 'email', 'alamat'];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
}
