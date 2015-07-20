<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = $request->all();
		$date = date("Y-m-d H:i:s");
		if ($data) {
			$user = new User;
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->password = Hash::make($data['password']);
			$user->created_at = $date;
			if ($user->save()){
				return Response::json(array('status'=>'success','message'=>'user registered successfully'));
			}else{
				return Response::json(array('status'=>'success','message'=>'problem in registration'));
			}
		}
	}

	public function login(Request $request)
	{
		$date = date("H:i:s");
		$data = $request->all();
		if (empty($data['email']) || empty($data['password'])) {
			return Response::json(array('status'=>'failure','message'=>'Please enter the correct data'));
		}
			$email = $data['email'];
			$password = $data['password'];
			if (Auth::attempt(array('email'=>$email,'password'=>$password))) {
				//getting the user id 
				$result = User::where('email','like',$email)->get();
				$userdata = array();
				$userdata['id']= $result[0]['id'];
				$userdata['name'] = $result[0]['name'];
				$userdata['email'] = $result[0]['email'];
				$userdata['time'] = $date;
				return Response::json(array('status'=>'success','data'=>$userdata));
			}
		return Response::json(array('status'=>'failure','message'=>'Wrong username and password'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
