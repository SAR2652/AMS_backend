<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\UserData;
use Illuminate\Support\Collection;
use DB;

class APIController extends Controller
{
    public function postAsset(Request $request)
    {
        $asset = new Asset;
        $asset->asset_id = $request->asset_id;
        $asset->asset_name = $request->asset_name;
        $asset->quantity = $request->quantity;
        $asset->price = $request->price;
        $asset->holder = $request->holder;
        $asset->save();
        return 'Asset Saved successfully';
    }
    public function postUser(Request $request)
    {
        $user = new UserData;
       // $user->email = $request["email"];
        $user->email="2016.jay.rajput@ves.ac.in";
        //$user->name = $request->name;
        $user->name="Jay Rajput";
        $user->approved = 0;
        $user->uid = 0;
        $user->save();
        return 'User Saved successfully';
    }
    public function unapprovedUsers(Request $request)
    {
        $value=UserData::where("approved","=","0")->get();
        return $value;
    }
    public function userList(Request $request)
    {
        $value=DB::table("user_data")->get();
        return $value;
    }
    public function setUser(Request $request)
    {   $email="2016.tejas.thakur@ves.ac.in";
        $obj=UserData::where("email","=",$email)->first();

        echo $obj->email;
        $obj->approved=1;
        //$obj->uid=$request["uid"];
        $obj->uid=21047;
        $obj->save();

    }
    public function reqFromDep(Request $request)
    {
        $dpoId="21098";
        $regExp="'^".$dpoId[0]."+'";
        $query="select * from requests where Request_by regexp ".$regExp;
        $result=DB::select($query);
        return $result;

    }
    public function reqToDep(Request $request)
    {
        $dpoId="21098";
        $regExp="'^".$dpoId[0]."+'";
        $query="select * from requests where Request_From regexp ".$regExp;
        $result=DB::select($query);
        return $result;

    }

}
 