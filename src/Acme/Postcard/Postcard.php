<?php

namespace Acme\Postcard;

class Postcard
{
    private $id;
    private $title;
    private $filename;
    private $price;
    private $airline;
    private $make;

    public static function fromArray(array $data)
    {
        $postcard = new Postcard();

        $postcard->id = $data['id'];
        $postcard->title = $data['title'];
        $postcard->filename = $data['filename'];
        $postcard->price = $data['price'];
        $postcard->airline = $data['airline'];
        $postcard->make = $data['make'];

        return $postcard;
    }

    public function id()
    {
        return $this->id;
    }

    public function price()
    {
        return $this->price;
    }

    public function toView()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'filename' => $this->filename,
            'price' => sprintf("%1.02f", $this->price),
            'airline' => $this->airline,
            'make' => $this->make
        ];
    }
}
