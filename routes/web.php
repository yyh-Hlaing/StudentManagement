<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//passing data from route to view
Route::get('about',function(){
    $name="yuyuhlaing";
    $email="yyh123@gmail.com";
    return view('aboutus')->with('name',$name)->with('email',$email);
});


Route::get('about/{name}/{id}',function($name,$id){
    // $name="yuyuhlaing";
    // $email="yyh123@gmail.com";
    //no1. return view('aboutus')->with('name',$name)->with('email',$email);
    //no2. return view('aboutus',compact('name','email'));
    //no3. return view('aboutus',[
    //     'name'=>$name,
    //     'email'=>$email

    // ]);
    return view('aboutus', compact('name','id'));
    });

Route::view('contact-us/{name}/{id}','contactus');




// Route::get('/',function(){
//     return ('welcome from laravel');
// });

// Route::get('about',function(){
//     return 'about us';
// });


// Route::prefix('details')->group(function(){
//     Route::get('student',function(){
//     return 'this is student';
// })->name('student-details');
// Route:: get('teacher',function(){
//     return 'this is teacher';
// })->name('teacher-details');
// });

// Route::get('student/{id}/{reg}',function($id,$reg){
//     return 'studentId' . $id . 'Registration Number' . $reg;
// });

// Route::fallback(function(){
//     return 'Please try again';
// });