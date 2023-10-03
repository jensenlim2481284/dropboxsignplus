<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    # Boot 
    public static function boot()
    {
        parent::boot();
        self::creating(function ($qr) {
            $qr->uid = bin2hex(random_bytes(8));
        });
    }

    public function getEncryptedUidAttribute(){
        return encryptWithoutIV($this->uid);
    }

}
