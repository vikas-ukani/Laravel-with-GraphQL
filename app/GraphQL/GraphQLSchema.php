<?php

namespace App\GraphQL;

use App\GraphQL\Types\SkillType;
use App\GraphQL\Queries\SkillsQuery;
use App\GraphQL\Types\Task\TaskType;
use App\GraphQL\Types\User\UserType;
use App\GraphQL\Types\Auth\LoginType;
use App\GraphQL\Queries\Task\TaskQuery;
use App\GraphQL\Queries\User\UsersQuery;
use App\GraphQL\Types\Auth\RegisterType;
use App\GraphQL\Types\User\MyProfileType;
use App\GraphQL\Queries\User\MyProfileQuery;
use App\GraphQL\Mutations\Auth\LoginUserMutation;
use App\GraphQL\Mutations\Task\CreateTaskMutation;
use App\GraphQL\Mutations\Task\DeleteTaskMutation;
use App\GraphQL\Types\User\PersonalAccessTokenType;
use App\GraphQL\Mutations\Auth\RegisterUserMutation;
use App\GraphQL\Mutations\Skills\CreateSkillMutation;
use App\GraphQL\Mutations\Skills\UpdateSkillMutation;
use App\GraphQL\Mutations\Task\UpdateTaskStatusMutation;

class GraphQLSchema
{

    /**
     * Returning an GraphQl Configuration Schema
     *
     * @return array
     */
    public static function schema()
    {
        return [
            'default' => [
                'query' => [
                    'skills' => SkillsQuery::class,
                    'myprofile' => MyProfileQuery::class,
                    'tasks' => TaskQuery::class,
                    'users' => UsersQuery::class,
                ],
                'mutation' => [
                    'newSkill' => CreateSkillMutation::class,
                    'updateSkill' => UpdateSkillMutation::class,
                    'newTask' => CreateTaskMutation::class,
                    'updateTaskStatus' => UpdateTaskStatusMutation::class,
                    'deleteTask' => DeleteTaskMutation::class
                ],
                'types' => [
                    'token' => PersonalAccessTokenType::class,
                    'myprofile' => MyProfileType::class,
                    'skill' => SkillType::class,
                    'user' => UserType::class,
                    'login' => LoginType::class,
                    'task' => TaskType::class,
                ],
                'middleware' => [
                    // 'auth:sanctum',
                ],
                'method' => ['GET', 'POST'],
            ],
            'login' => [
                'query' => [],
                'mutation' => [
                    'login' => LoginUserMutation::class, // WORKING - Reference `graphql-schemas.md`
                ],
                'types' => [
                    'login' => LoginType::class,
                    'myprofile' => MyProfileType::class,
                    'skill' => SkillType::class,
                    'user' => UserType::class,
                    'task' => TaskType::class,
                    'token' => PersonalAccessTokenType::class
                ],
                'middleware' => [],
                'method' => ['GET', 'POST'],
            ],
            'register' => [
                'query' => [],
                'mutation' => [
                    'register' => RegisterUserMutation::class,
                ],
                'types' => [
                    'register' => RegisterType::class,
                    'user' => UserType::class,
                    'task' => TaskType::class,
                    'myprofile' => MyProfileType::class,
                    'token' => PersonalAccessTokenType::class
                ],
                'middleware' => [],
                'method' => ['GET', 'POST'],
            ],
        ];
    }
}
