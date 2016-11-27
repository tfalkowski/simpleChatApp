<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('_index', new Route('/index', array(
    '_controller' => 'AppBundle:Chat:Index',
)));

return $collection;
