<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Audit log for every AI tool invocation.
 *
 * @property int         $id
 * @property string      $tool_name
 * @property string|null $args        JSON-encoded args
 * @property int|null    $user_id
 * @property string|null $request_id
 * @property bool        $success
 * @property string|null $message
 */
class AiToolCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_name',
        'args',
        'user_id',
        'request_id',
        'success',
        'message',
    ];

    protected $casts = [
        'success' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Decode args JSON for display.
     */
    public function getDecodedArgsAttribute(): array
    {
        return json_decode($this->args ?? '{}', true) ?? [];
    }
}
