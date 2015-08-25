<?php

namespace Acme\Postage;

interface PostageRepository
{
    /**
     * @param integer $quantity
     *
     * @return Postage
     */
    public function findPostageForQuantity($quantity);
}
