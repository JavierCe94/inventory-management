<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:55
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateGarmentController extends Controller
{
    /**
     * @param Request               $request
     * @param UpdateGarment         $updateGarment
     * @param ReactRequestTransform $reactRequestTransform
     *
     * @return JsonResponse
     */
    public function updateGarment(
        Request $request,
        UpdateGarment $updateGarment,
        ReactRequestTransform $reactRequestTransform
    ) {
        $item = $reactRequestTransform->transform($request);

        $output = $updateGarment->handle(new UpdateGarmentCommand(
            $item['id'],
            $item['name']
        ));

        return new JsonResponse($output['data'], $output['code']);
    }
}