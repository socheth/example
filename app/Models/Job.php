<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "user_id",
        "company_id",
        "title",
        "slug",
        "salary",
        "body",
    ];

    protected $table = "job_listings";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
