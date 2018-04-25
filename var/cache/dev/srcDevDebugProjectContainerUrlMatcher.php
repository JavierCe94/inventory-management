<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/garment/insertGarment')) {
            // insertGarmentType
            if (0 === strpos($pathinfo, '/garment/insertGarmentType') && preg_match('#^/garment/insertGarmentType/(?P<name>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'insertGarmentType')), array (  '_controller' => 'Inventory\\Management\\Infrastructure\\Controller\\ControllerGarment::insertGarmentType',));
            }

            // insertGarment
            if (preg_match('#^/garment/insertGarment/(?P<name>[^/]++)/(?P<garment_type_id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'insertGarment')), array (  '_controller' => 'Inventory\\Management\\Infrastructure\\Controller\\ControllerGarment::insertGarment',));
            }

        }

        // listGarmentTypes
        if ('/garment/listGarmentTypes' === $pathinfo) {
            return array (  '_controller' => 'Inventory\\Management\\Infrastructure\\Controller\\ControllerGarment::listGarmentTypes',  '_route' => 'listGarmentTypes',);
        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
