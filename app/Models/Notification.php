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

    public function getPublishedToAttribute()
    {
        if (auth()->user()->memberId->role_id == 1) {
            if ($this->attributes['published_to'] !== '["all"]') {
                $publishedTo = json_decode($this->attributes['published_to']);

                return Division::whereIn('id', $publishedTo)->get();
            }
        } else {
            $memberId = auth()->user()->id;
            $divisionId = DivisionMember::where('member_id', $memberId)->first();
            $divisionId = $divisionId->division_id;
            $publishedTo = json_decode($this->attributes['published_to']);
            foreach ($publishedTo as $department) {
                if ($department == $divisionId) {
                    return Division::where('id', $department)->get();
                }
            }
        }

        return $this->attributes['published_to'];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'created_by');
    }

}
