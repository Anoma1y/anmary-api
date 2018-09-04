<?php

namespace App\Models\Profile;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BLOCKED = 3;

    public static $statusReadable = [
        self::STATUS_INACTIVE => 'Неактивный',
        self::STATUS_ACTIVE => 'Активный',
        self::STATUS_BLOCKED => 'Заблокирован'
    ];

    protected $fillable = [
        'user_id',
        'phone',
        'status'
    ];

    // Reverse ref to User model
    public function user() {
        return $this->belongsTo(User::class);
    }
}
