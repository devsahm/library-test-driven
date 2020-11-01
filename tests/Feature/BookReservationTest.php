<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        
        $this->withoutExceptionHandling();
        $response= $this->post('/books', [

            'title'=>'Cool Book Title Book',
            'author'=>'Victor'

        ]);

        $response->assertOk();                                      
        $this->assertCount(1, Book::all());
    }


       /** @test */
       public function a_title_is_required()
    {
        
        // $this->withoutExceptionHandling();
        $response= $this->post('/books', [

            'title'=>'',
            'author'=>'Victor'
        ]);

        $response->assertSessionHasErrors('title');                                      
    }


 /** @test */
  public function a_author_is_required()
    {
       
        $response= $this->post('/books', [

            'title'=>'Cool Book Title',
            'author'=>''
        ]);

        $response->assertSessionHasErrors('author');                                      
    }



     /** @test */
    public function a_book_can_be_uodated()
    {
      $this->withoutExceptionHandling();
          $this->post('/books', [
            'title'=>'Cool Book Title',
            'author'=>' Victor'
           ]);

          $book=Book::first(); 

          $response= $this->patch('/books/'.$book->id, [
            'title'=>'New Title',
            'author'=>'New Author',
          ]);

          $this->assertEquals('New Title', Book::first()->title);
          $this->assertEquals('New Author', Book::first()->author);
                                             
    }


}
