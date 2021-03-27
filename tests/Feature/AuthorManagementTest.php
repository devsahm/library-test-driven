<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
     public function an_author_can_be_created()
     {

        $this->withoutExceptionHandling();
        $response= $this->post('/author', [
            'name'=>'Authors',
            'dob'=>'14/10/1990'
        ]);
        $author= Author::first();
        $this->assertCount(1, Author::all());
        // $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        // $this->assertEquals('1990/10/14', $author->first()->dob->format('Y/m/d'));
        $response->assertRedirect('/authors/'.$author->id);



     }

      /** @test */
     public function an_author_name_is_required()
     {
       $response= $this->post('/author', [
            'name'=>'',
            'dob'=>'12-03-2000'
        ]);
        $response->assertSessionHasErrors('name');

     }


      /** @test */
      public function an_author_dob_is_required()
      {
        $response= $this->post('/author', [
             'name'=>'Damilare',
             'dob'=>''
         ]);
         $response->assertSessionHasErrors('dob');

      }

}
