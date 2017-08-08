<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller{
  public function show($postId){
    return $postId;
  }
  public function update(Request $request, $postId){
    $content = [
      'ID' => $postId,
      'Title' => $request->input('title'),
      'Content' => $request->input('content')
    ];
    return (new Response($content, 201));
  }
}
