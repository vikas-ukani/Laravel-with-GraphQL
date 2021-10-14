<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Task;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A Task type',
        'model' => Task::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Task id'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User id'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'An user name'
            ],
            'is_completed' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The status of a task'
            ],
            'user' => [
                'type' => GraphQL::type('myprofile'),
                'description' => 'The task user',
                'always' => ['name'],
            ]
        ];
    }
}
