<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Entities\File;

class EntityFiles extends Model
{
    use HasFactory;

    protected $table = 'entity_files';



    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
