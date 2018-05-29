<?php

namespace Inventory\Management\Infrastructure\Service\ReactRequestTransform;

use Symfony\Component\HttpFoundation\Request;

class ReactRequestTransform
{
    /**
     * @param Request $request
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
