<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MyProfileQuery extends Query
{

    private $auth;

    protected $attributes = [
        'name' => 'user/MyProfile',
        'description' => 'My Profile Details',
    ];


    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return ! Auth::guest();
    }

    public function type(): Type
    {
        return GraphQL::type('myprofile');
    }


    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return auth()->user();
    }
}
