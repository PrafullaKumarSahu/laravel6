<?php
namespace App\Http\Containers;

class Example2
{
    protected $learning;

    public function __construct($learning)
    {
        $this->learning = $learning;
    }
    public function test()
    {
        return $this->learning;
    }
}
