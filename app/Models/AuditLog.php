<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_user_id',
        'admin_user_name',
        'action',
        'resource_type',
        'resource_id',
        'resource_title',
        'affected_count',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the admin user who performed the action
     */
    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    /**
     * Create an audit log entry
     */
    public static function createLog(
        string $action,
        string $resourceType,
        int $affectedCount = 1,
        ?int $resourceId = null,
        ?string $resourceTitle = null,
        ?array $metadata = null
    ): self {
        return self::create([
            'admin_user_id' => auth()->id(),
            'admin_user_name' => auth()->user()->name,
            'action' => $action,
            'resource_type' => $resourceType,
            'resource_id' => $resourceId,
            'resource_title' => $resourceTitle,
            'affected_count' => $affectedCount,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
