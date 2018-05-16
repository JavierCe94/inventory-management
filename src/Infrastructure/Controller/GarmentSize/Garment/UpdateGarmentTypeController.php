<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 9:00
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateGarmentTypeController extends Controller
{
    /**
     * @param Request               $request
     * @param UpdateGarmentType     $updateGarmentType
     * @param ReactRequestTransform $reactRequestTransform
     *
     * @return JsonResponse
     */
    public function updateGarmentType(
        Request $request,
        UpdateGarmentType $updateGarmentType,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $updateGarmentType->handle(new UpdateGarmentTypeCommand(
            $item['id'],
            $item['name']
        ));
        return new JsonResponse($output['data'], $output['code']);
    }
}
