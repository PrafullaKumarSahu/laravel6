<?php
namespace App\Http\Containers;

class Example3
{
    protected $collaborator;

    public function __construct(Collaborator $collaborator)
    {
        $this->collaborator = $collaborator;
    }
    public function test()
    {
        return 'It is working.';
    }
}
