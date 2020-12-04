<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $token = $request->bearerToken();
        $user = DB::table('users')->where('api_token', $token)->first();
        $data = $request->validate([
                            'name' => 'required|max:255',
                            'email' => 'required',
                            'password' => 'nullable|min:6',
                            'phone' => 'nullable',
                            'date' => 'nullable'
                        ]);       

        $images = $user->photo;

        if ($request->hasFile('file')) {
            
            @unlink(storage_path('app/public/' . $user->photo));
            
            $file = ($request->file('file'));

            $images = time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/', $images);

        }

        if (empty($request->password)) {
            $query = DB::table('users')->where([
                    'id' => $user->id
                ])->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'date_of_birth' => empty($request->date) ? date('Y-m-d') : $request->date,
                    'photo' => $images
                ]);
    
        } else {
            $query = DB::table('users')->where([
                'id' => $user->id
                ])->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'date_of_birth' => empty($request->date) ? date('Y-m-d') : $request->date,
                    'photo' => $images
                ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => 'Update successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
