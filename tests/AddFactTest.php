<?php

use App\Fact;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AddFactTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
           ->type('Test Fact', 'content')
           ->press('Add Fact')
           ->see("Test Fact");
    }



    public function test_visitor_can_create_fact() {
        $fact = factory(Fact::class)->create([
            'content' => 'tester content',
            'source' => 'tester content'
        ]);
        $fact->save();
    }
}
