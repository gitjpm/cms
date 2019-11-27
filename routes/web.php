<?php

use App\Post;
use App\Role;
use App\User;

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

    $posts = Post::where('id', 6)->orderBy('id', 'desc')->take(1)->get();

    return $posts;


});

Route::get('/hola', function(){

    $post = new Post();
    $post->hola();

});

Route::get('/findmore', function () {
    $posts = Post::findOrFail(1);

    return $posts;
    
});

Route::get('/basicinsert', function(){

    $post = new Post();

    $post->title = 'El nuevo titulo';
    $post->content = 'Este es el contenido';
    
    $post->save();

});

Route::get('/basicinsert2', function(){

    $post = Post::find(2);

    $post->title = 'El titulo';
    $post->content = 'modificando el contenido...';
    
    $post->save();

});

Route::get('/create', function(){

    Post::create(['title' => 'Post creado a partir de create', 'content' => 'contenido ...']);

    //$post->insert();


});

Route::get('/update', function(){

    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'jajajaja']);    

});


Route::get('/delete', function(){

    $post = App\Post::find(1);

    $post->delete();

});

Route::get('/delete2', function () {
    Post::destroy([2,5]);
});


Route::get('/softdelete', function(){

    Post::find(7)->delete();

});

Route::get('/readsoftdeleted', function () {
    $post = Post::withTrashed()->where('id', 6)->get();

    return $post;
});

Route::get('/restore', function(){

    Post::withTrashed()->where('is_admin', 0)->restore();

});

Route::get('/forcedelete', function(){

    Post::withTrashed()->find(7)->forceDelete();

});

Route::get('/user/{id}/post', function($id){

    $thePost = User::find($id)->post;
    return view('postjson')->with('thePost', $thePost);

});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

Route::get('/user/{id}/posts', function($id){

    $user = User::find($id);

    foreach($user->posts as $post){
        echo $post->title;
        echo "<br>";

    }

});

// many to many
Route::get('/user/{id}/role', function($id){

    $user = User::find($id);

    foreach($user->roles as $role){
        return $role->name;
    }
});

Route::get('/role/{id}/users', function ($id) {

    $role = Role::find($id);
    $users = $role->users()->orderBy('name', 'desc')->get();

    foreach($users as $user){
        echo $user->name;
        echo "<br>";
    }
    
});

Route::get('/user/pivot', function () {

    $user = App\User::find(1);

    foreach($user->roles as $role){
        echo $role->pivot;
        echo "<br>";

    }
});

Route::get('/role/pivot', function () {

    $role = Role::find(2);

    foreach($role->users as $user){
        echo $user->name." viene del pivot: <br>";
        echo $user->pivot;
        echo "<br><br>";

    }
});

Route::get('/user/photos', function(){
    $user = User::find(1);

    foreach($user->photos as $photo){
        return $photo;
    }

});


//Route::get('/post/{name}', 'PostsController@index');

//Route::resource('posts', 'PostsController'); 

// Route::get('/contact', 'PostsController@contact');
// Route::get('/posts/{id}/{name}/{pass}', 'PostsController@show_post');