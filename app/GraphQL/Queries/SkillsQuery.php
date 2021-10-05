<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Skill;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

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

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields     = $getSelectFields();
        $select     = $fields->getSelect();
        $with       = $fields->getRelations();

        $where = function ($query) use ($args) {
            // foreach ($args as $key => $value) {
            //     $query = $query->where($key, $value);
            // }
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
