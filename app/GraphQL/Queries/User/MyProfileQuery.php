<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class MyProfileQuery extends Query
{

    private $auth;

    protected $attributes = [
        'name' => 'user/MyProfile',
        'description' => 'My Profile Details',
    ];

    public function authorize($root, array $args, $ctx, ?ResolveInfo $resolveInfo = null, ?Closure $getSelectFields = null): bool
    {
        print_r(json_encode([$root, $args]));
        die;
        try {
            $this->auth = Auth::user();
        } catch (\Exception $e) {
            $this->auth = null;
        }
        return (bool) $this->auth;
        
        print_r(json_encode([$root, $args]));
        die;
        try {
            // $this->auth = Auth

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function type(): Type
    {
        return GraphQL::type('myprofile');
    }


    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $id = 1;
        $user = User::where('id', $id)->first();

        if (!$user) return null;
        return $user;
    }
}
