<?php

namespace Acme\Infrastructure\Sqlite;

use Acme\Postcard\PostcardRepository;
use Acme\Postcard\Postcard;

class PostcardSqliteRepository implements PostcardRepository
{
    public function __construct()
    {
        $this->db = new \SQLite3(__DIR__ . '/../../../../public/_inc/db.sqlite');
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        $result = $this->db->querySingle(sprintf("SELECT * FROM postcards WHERE id = %d", $id), true);

        if ($result) {
            return Postcard::fromArray($result);
        }

    }
}