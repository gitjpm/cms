<?php

use App\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function(){
    DB::insert('insert into posts(title, content) values(?, ?)', array('PHP with Laravel', 'This is the content of the post'));
});

Route::get('/read', function(){

    $results = DB::select('select * from posts');
     
    return $results;
});

Route::get('/read/{id}', function($id = null){

    if(!is_null($id)){
        $results = DB::select('select * from posts where id = ?', [$id]);
    }else{
        $results = DB::select('select * from posts');
    }
    
    return $results;
});

Route::get('/update/{id}', function($id){
    $updated = DB::update('UPDATE posts SET title = "The new title!" WHERE id = ?', [$id]);

    return $updated;
    
});

//Eloquent
Route::get('/find', function(){ 
    $posts = Post::all();


    foreach($posts as $post){
        echo $post->title;
    }

    return $posts;

});

Route::get('/findwhere', function(){

    $posts = Post::where('id', 5)->orderBy('id', 'desc')->take(1)->get();

    return $posts;


});



//Route::get('/post/{name}', 'PostsController@index');

//Route::resource('posts', 'PostsController'); 

// Route::get('/contact', 'PostsController@contact');
// Route::get('/posts/{id}/{name}/{pass}', 'PostsController@show_post');