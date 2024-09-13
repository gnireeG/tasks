<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'host',
        'port',
        'folder',
        'subjectfilter',
        'bodyfilter',
        'fromfilter',
        'delete_after_fetch',
        'user_id',
        'last_fetched_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // add global scope to only fetch inboxes for the authenticated user
    protected static function boot(){
        parent::boot();

        static::addGlobalScope('user', function($query){
            $query->where('user_id', auth()->id());
        });
    }
}
