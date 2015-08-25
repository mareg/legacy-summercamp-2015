<?php

namespace Acme\Postcard;

interface PostcardRepository
{

    /**
     * @param integer $id
     *
     * @return Postcard
     */
    public function findById($id);
}
