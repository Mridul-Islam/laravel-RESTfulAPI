<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        //
    ];


    protected array $availableIncludes = [
        //
    ];


    public function transform(Buyer $buyer)
    {
        return [
            'identifier'   => (int)$buyer->id,
            'name'         => (string)$buyer->name,
            'email'        => (string)$buyer->email,
            'isVeirfied'   => (int)$buyer->verified,
            'creationDate' => $buyer->created_at,
            'lastChange'   => $buyer->updated_at,
            'deletedDate'  => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null
        ];
    }
}
