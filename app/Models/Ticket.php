<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'priority',
        'status',
        'ticket_number',
        'resolved_at',
        'resolution_notes',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class)->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'open' => ['badge bg-primary', 'Open'],
            'in_progress' => ['badge bg-warning', 'In Progress'],
            'pending' => ['badge bg-info', 'Pending'],
            'resolved' => ['badge bg-success', 'Resolved'],
            'closed' => ['badge bg-secondary', 'Closed'],
        ];

        return $badges[$this->status] ?? ['badge bg-secondary', 'Unknown'];
    }

    public function getPriorityBadgeAttribute()
    {
        $badges = [
            'low' => ['badge bg-success', '🟢 Low'],
            'medium' => ['badge bg-warning', '🟡 Medium'],
            'high' => ['badge bg-danger', '🔴 High'],
            'urgent' => ['badge bg-dark', '⚫ Urgent'],
        ];

        return $badges[$this->priority] ?? ['badge bg-secondary', 'Unknown'];
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['open', 'in_progress', 'pending']);
    }

    public function scopeClosed($query)
    {
        return $query->whereIn('status', ['resolved', 'closed']);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
