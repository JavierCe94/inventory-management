<?php

namespace Inventory\Management\Infrastructure\Service\ReactRequestTransform;

use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 13:15
 */

class ReactRequestTransform
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function transform(Request $request): array
    {
        $arrayRequest = array(json_decode($request->getContent()));
        $item = [];

        foreach ($arrayRequest[0] as $key => $value) {
            $item[$key] = $value;
        }

        return $item;
    }
}