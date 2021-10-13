<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Task;

use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class TaskQuery extends Query
{
    protected $attributes = [
        'name'          => 'Task query',
        'description'   => 'A query of task'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        // true, if logged in
        return ! Auth::guest();
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('task'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::id()],
            'title' => ['name' => 'title', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
      return auth()->user()->tasks;
    }
}
