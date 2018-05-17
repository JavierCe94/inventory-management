<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 9:25
 */

namespace Inventory\Management\Domain\Service\Util\Observer;

interface Observable
{
    public function attach(Observer $observer);
    public function notify();
}