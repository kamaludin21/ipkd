<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentParent extends Model
{
    use HasFactory;

    protected $fillable = [
      'slug', 'name', 'description'
    ];

    public function document(): hasOne
    {
      return $this->hasOne(Document::class);
    }
}
