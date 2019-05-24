<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $sender
 * @property string|null $title
 * @property string|null $body
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
 */
class Message extends Model
{
    protected $fillable = [
        'sender', 'title', 'body', 'company_id',
    ];
}
