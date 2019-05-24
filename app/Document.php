<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Document
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $original_name
 * @property string $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Document whereUpdatedAt($value)
 */
class Document extends Model
{
    //
}
