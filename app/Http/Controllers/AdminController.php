<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the index-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $users = User::where('role', '!=', 'admin')
                    ->orderBy('created_at', 'desc')
                    ->get();

                   // Ajax response
        if ($request->ajax()) {
            return response()->json([
                'table' => view("admin.admin-standard", ['users' => $users])->render(),
            ]);
        } 
        return view('admin.index', compact('users'));
    }

    /**
     * Delete item from the dashboard-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request, User $user) //!!!User $user from id="{{$user->id}}" + url: '/users/' + id,
    {
        $user->delete();

        return $this->index($request); //!!!need Request $request - if ($request->ajax()) ... in index
    } 

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     */      
    public function store(Request $request)
    {
       //...
    }  

    /**
     * Edit-view for selected user.
     *
     * @param  ...
     * @return \Illuminate\Http\Response
     */      
    public function show(User $user)
    {
       //...
    }  

    /**
     * Update selected user in storage.
     *
     * @return \Illuminate\Http\Response
     */      
    public function update(Request $request, User $user)
    {
       //...
    }

}
