<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'generated_by',
        'report_type',
        'filters',
        'file_path',
        'download_count',
    ];

    protected $casts = [
        'filters' => 'array',
    ];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
