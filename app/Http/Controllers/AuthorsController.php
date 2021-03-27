<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function store()
    {
       $author=Author::create($this->validatedData());
        return redirect($author->path());

    }


    protected function validatedData()
    {
    return  request()->validate([
        'name'=>'required',
        'dob'=>'required'
    ]);

    }

}
