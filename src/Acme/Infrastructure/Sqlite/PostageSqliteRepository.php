<?php

namespace Acme\Infrastructure\Sqlite;

use Acme\Postage\PostageRepository;
use Acme\Postage\Postage;

class PostageSqliteRepository implements PostageRepository
{
    public function __construct()
    {
        $this->db = new \SQLite3(__DIR__ . '/../../../../public/_inc/db.sqlite');
    }

    /**
     * {@inheritdoc}
     */
    public function findPostageForQuantity($quantity)
    {
        $result = $this->db->querySingle(sprintf("SELECT price FROM postage WHERE quantity = %d", $quantity), true);

        if ($result) {
            return Postage::withQuantityAndPrice($quantity, $result['price']);
        }
    }
}