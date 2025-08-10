<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OTPNotification;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'age_group_id',
        'mobile_number',
        'is_mobile_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_mobile_verified' => 'boolean',
        ];
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function sendSMSOTP()
    {
        $otp = $this->otps()->create([
            'mobile_number' => $this->mobile_number,
            'code' => Otp::generateCode(),
            'expires_at' => now()->addMinutes(10),
        ]);

        // Here you would integrate with an SMS service to send the OTP
        // For now, we'll just return the OTP for testing
        return $otp;
    }

    public function sendEmailOTP()
    {
        $otp = $this->otps()->create([
            'mobile_number' => $this->mobile_number, // We'll keep this for tracking
            'code' => Otp::generateCode(),
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send email notification
        $this->notify(new OTPNotification($otp->code));

        return $otp;
    }

    public function verifyOTP($code)
    {
        $otp = $this->otps()
            ->where('code', $code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            return false;
        }

        $otp->update(['used' => true]);
        $this->update(['is_mobile_verified' => true]);

        return true;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->slug === $role;
        }
        return $this->role->is($role);
    }

    public function hasPermission($permission)
    {
        return $this->role->hasPermission($permission);
    }

    public function isAdmin()
    {
        return in_array($this->role->slug, ['super-admin', 'admin-manager', 'admin-supervisor', 'admin-staff']);
    }

    public function isSuperAdmin()
    {
        return $this->role->slug === 'super-admin';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
