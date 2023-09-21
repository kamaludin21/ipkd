<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
      'document_parent_id',
      'slug',
      'name',
      'file',
      'description'
    ];

    public function parent()
    {
      return $this->belongsTo(DocumentParent::class, 'document_parent_id');
    }
}
