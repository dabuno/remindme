<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Fact;
use App\Tag;
use Illuminate\Http\Request;


Route::get("/mail", function() {
    var_dump("testing email");
    Mail::queue('emails.reminder', [], function ($m) {
                $m->to("bogdan.durla@gmail.com", "Username")->subject('Your Reminder!');
            });
});

Route::get("/random/{id?}", function($id = null) {
    $count = Fact::count();


    $ids = $id ? [$id] : Fact::pluck("id");
    $random = random_int(0, count($ids) - 1);

    Mail::queue('facts.daily', ['fact' => Fact::findOrFail($ids[$random])], function ($m) {
        $m->to("bogdan.durla@gmail.com", "Bogdan")->subject('Daily Joy');
    });

    return view('facts', [
        'facts' => [Fact::findOrFail($ids[$random])]
    ]);
});


/**
 * Show Fact Dashboard
 */
Route::get('/', function () {
    return view('facts', [
        'facts' => Fact::orderBy('created_at', 'desc')->get()
    ]);
});
/**
 * Add New Fact
 */
Route::post('/fact', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'content' => 'required',
    ],
    [
        'content.required' => 'Fact field is required',
    ]);
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $tag = Tag::firstOrCreate(["tag" => $request->tag]);

    $fact = new Fact;
    $fact->content = $request->content;
    $fact->source = $request->source;
    $fact->tag_id = $tag->id;
    $fact->save();
    return redirect('/');
});
/**
 * Delete Fact
 */
Route::delete('/fact/{id}', function ($id) {
    Fact::findOrFail($id)->delete();
    return redirect('/');
});
