<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_date',
        'subject',
        'message',
        'status',
        'attachment',
        'created_by',
        'published_to',
    ];

    public function getPublishedDateAttribute()
    {
        if ($this->attributes['published_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['published_date'])->format('d/m/Y');
        }
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'created_by');
    }

    public function division()
    {
        dd($this->getPublishedDateAttribute());
        if ($this->attributes['published_to'] !== '["all"]') {
            $publishedTo = json_decode($this->attributes['published_to']);

            return Division::whereIn('id', $publishedTo)->get();
        }

        return $this->attributes['published_to'];
    }
}
