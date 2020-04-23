<?php

namespace Selene\Modules\RevisionModule\Models;

use Carbon\Carbon;
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
    
    public static function getLastAuto($table, $contentId) {
        return Revision::query()->where('table', '=', $table)
            ->where('content_id', '=', $contentId)
            ->orderByDesc('_id')
            ->first();
    }
    
    public static function getByContent($table = null, $contentId = null, $limit = 10) {
        $revisions = self::query();

        if (!empty($table)) {
            $revisions->where('table', '=', $table);
        }

        if (!empty($contentId)) {
            $revisions->where('contentId', '=', $contentId);
        }

        if (!empty($table) && !empty($contentId)) {
            $auto = self::getLastAuto($table, $contentId);
            if ($auto) {
                $revisions->where('created_at', '>', $auto->created_at);
            }
        }

        return $revisions->limit($limit)
            ->orderBy('_id', 'DESC')
            ->get();
    }
}
