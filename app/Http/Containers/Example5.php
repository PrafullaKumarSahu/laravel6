<?php
namespace App\Http\Containers;

class Example5
{
    protected $collaborator;

    protected $extra;

    public function __construct(Collaborator $collaborator, $extra)
    {
        $this->collaborator = $collaborator;
        $this->extra = $extra;
    }
    public function test()
    {
        return $this->extra;
    }
}
