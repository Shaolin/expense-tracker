<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToOrganization
{
    protected static function bootBelongsToOrganization()
    {
        // AUTO ASSIGN organization_id when creating
        static::creating(function ($model) {
            if (Auth::check() && empty($model->organization_id)) {
                $model->organization_id = session('organization_id')
                    ?? Auth::user()->organizations()->first()->id;
            }
        });

        // GLOBAL SCOPE (isolation)
       
        static::addGlobalScope('organization', function (Builder $builder) {

    if (Auth::check()) {

        $organizationId = session('organization_id')
            ?? optional(Auth::user()->organizations()->first())->id;

        if ($organizationId) {
            $builder->where('organization_id', $organizationId);
        }
    }
});
    }
}