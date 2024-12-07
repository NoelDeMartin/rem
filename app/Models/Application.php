<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function profileDocument(): array {
        return [
            'client_id' => route('applications.show', $this),
            'client_name' => $this->name,
            'redirect_uris' => [$this->url],
        ];
    }
}
