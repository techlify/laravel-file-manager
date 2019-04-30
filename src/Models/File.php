<?php

namespace Techlify\FileManager\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    const TYPE = "File";
    
    const FILE_SUB_URL = "techlify/file-manager/";

    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'techlify_files';
    protected $primaryKey = 'id';

    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $appends = array('fileUrl');

    public function getFileUrlAttribute()
    {
        $url = Storage::url($this->filename);

        return $url;
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['owner_id']))
        {
            $query->where('owner_id', '=', $filters['owner_id']);
        }

        if (isset($filters['owner_type']))
        {
            $query->where('owner_type', '=', $filters['owner_type']);
        }

        if (isset($filters['sort_by']) && "" != trim($filters['sort_by']))
        {
            $sort = explode("|", $filters['sort_by']);
            $query->orderBy($sort[0], $sort[1]);
        }
    }

}
