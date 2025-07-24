<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    protected $with = 'major';

    protected $fillable = ['grade', 'major_id', 'class_number'];

    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }

    public function major(): BelongsTo {
        return $this->belongsTo(Major::class);
    }
}
