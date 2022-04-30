<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        //
    ];


    protected array $availableIncludes = [
        //
    ];


    public function transform(User $user)
    {
        return [
            'identifier'   => (int)$user->id,
            'name'         => (string)$user->name,
            'email'        => (string)$user->email,
            'isVeirfied'   => (int)$user->verified,
            'isAdmin'      => ($user->admin === 'true'),
            'creationDate' => $user->created_at,
            'lastChange'   => $user->updated_at,
            'deletedDate'  => isset($user->deleted_at) ? (string)$user->deleted_at : null
        ];
    }
}
