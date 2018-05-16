<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:56
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertGarmentTypeController extends Controller
{
    /**
     * @param Request               $request
     * @param InsertGarmentType     $insertGarmentType
     * @param ReactRequestTransform $reactRequestTransform
     *
     * @return JsonResponse
     */
    public function insertGarmentType(
        Request $request,
        InsertGarmentType $insertGarmentType,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $insertGarmentType->handle(new InsertGarmentTypeCommand(
            $item['name']
        ));

        return new JsonResponse($output['data'], $output['code']);
    }
}