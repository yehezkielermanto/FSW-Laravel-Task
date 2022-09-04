<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class dosen extends Model
{
    use HasFactory;
    public function countDosen()
    {
        return DB::table('dosen')->count();
    }

    public function readDosen()
    {
        return DB::table('dosen')->get();
    }
}
