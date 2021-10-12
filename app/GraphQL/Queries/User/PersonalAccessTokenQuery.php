<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use App\Models\Task;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Laravel\Sanctum\PersonalAccessToken;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class PersonalAccessTokenQuery extends Query
{
    protected $attributes = [
        'name'          => 'User access token',
        'description'   => 'User access token'
    ];

    public function type(): Type
    {
        return GraphQL::type('token');
    }

    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'token' => ['name' => 'token', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields, SelectFields $fields)
    {
        var_dump(auth()->user());
        return PersonalAccessToken::where('id',1)->first();
    }
}