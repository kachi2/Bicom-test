<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentName extends Model
{
    use HasFactory;

    protected $table = 'agentname';
    protected $fillable = [
       'firstname','lastname','email','phone','pollingunit_uniqueid'
    ];
}
