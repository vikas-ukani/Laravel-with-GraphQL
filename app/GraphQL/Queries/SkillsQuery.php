<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\User;
use App\Models\Skill;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SkillsQuery extends Query
{
    protected $attributes = [
        'name'          => 'skills query',
        'description'   => 'A query of skills'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('skill'));
        // return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::id()],
            'skill_title' => ['name' => 'skill_title', 'type' => Type::string()]
        ];
    }

      public function authorize($root, array $args, $ctx, ?ResolveInfo $resolveInfo = null, ?Closure $getSelectFields = null): bool
    {
        return auth()->guard()->check();
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields     = $getSelectFields();
        $select     = $fields->getSelect();
        $with       = $fields->getRelations();

        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query = $query->where('id', $args['id']);
            }
            return $query;
        };

        $skills = Skill::where($where)
            ->with($with)
            ->select($select)
            ->latest()
            ->get();
        return $skills;

        // $query = new Skill;
        // if (isset($args['id'])) {
        //     $query = $query->where('id', $args['id']);
        // }

        // $query = $query->with($with)
        //     ->select($select)
        //     ->get();
        // return $query;
    }
}
