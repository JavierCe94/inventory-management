<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:36
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertGarmentController extends Controller
{
    /**
     * @param Request               $request
     * @param InsertGarment         $insertGarment
     * @param ReactRequestTransform $reactRequestTransform
     *
     * @return JsonResponse
     */
    public function insertGarment(
        Request $request,
        InsertGarment $insertGarment,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $insertGarment->handle(new InsertGarmentCommand(
            $item['name'],
            $item['garmentTypeId']
        ));

        return new JsonResponse($output['data'], $output['code']);
    }
}