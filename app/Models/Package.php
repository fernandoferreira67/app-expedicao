<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = "packages";
    protected $primaryKey = "id";
    protected $fillable = ['status','notes','carrier_id', 'user_id'];
    public const RELATIONSHIP_PACKAGE_CARRIER = 'carrier_package';

    public function carrier()
    {
      return $this->belongsTo(Carrier::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }


}
