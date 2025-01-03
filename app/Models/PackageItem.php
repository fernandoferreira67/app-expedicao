<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;
    protected $table = "packages_item";
    protected $primaryKey = "id";
    protected $fillable = ['chave_nfe','status', 'packages_id', 'user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

}
