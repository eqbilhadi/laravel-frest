<?php

namespace Modules\Rbac\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Rbac\Builders\ComMenuBuilder;

class ComMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parent_id',
        'sort_num',
        'icon',
        'label_name',
        'controller_name',
        'route_name',
        'url',
        'is_active',
        'is_divider',
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_divider' => 'boolean'
    ];

    /**
     * Method roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(ComRole::class, 'com_menus_has_roles', 'menu_id', 'role_id');
    }

    /**
     * Method parent
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id')->with('parent', 'roles')->orderBy('sort_num', 'asc');
    }

    /**
     * Method children
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->with('children')->orderBy('sort_num', 'asc');
    }

    public function newEloquentBuilder($query): ComMenuBuilder
    {
        return new ComMenuBuilder($query);
    }
}
