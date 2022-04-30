<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        //
    ];


    protected array $availableIncludes = [
        //
    ];

    public function transform(Seller $seller)
    {
        return [
            'identifier'   => (int)$seller->id,
            'name'         => (string)$seller->name,
            'email'        => (string)$seller->email,
            'isVeirfied'   => (int)$seller->verified,
            'creationDate' => $seller->created_at,
            'lastChange'   => $seller->updated_at,
            'deletedDate'  => isset($seller->deleted_at) ? (string)$seller->deleted_at : null
        ];
    }
}
