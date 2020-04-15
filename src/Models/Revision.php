<?php

namespace Selene\Modules\RevisionModule\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Zdrojowa\AuthenticationLink\Models\User;

class Revision extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'revisions';

    protected $appends = ['id'];
    protected $hidden  = ['_id'];

    protected $primaryKey = '_id';

    protected $fillable = [
        'table',
        'action',
        'content_id',
        'content',
        'created_at',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
