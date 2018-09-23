<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\UserData;
use App\Staff;
use App\LabAssistant;
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
    public function userDetail(Request $request)
    {
        $uid=21000;
        //$uid=$request->uid;
        $result=UserData::where("uid","=",$uid)->get();
        if(sizeof($result)==0)
            {return null;}
        return $result;
    }
    //Function to change the approval status of a unapproved registered user along with assignment of UID
    public function setUser(Request $request)
    {   $email="2016.jay.rajput@ves.ac.in";
        //$email=$request->email;
        $arr=array("staff","Lab Assistant","Departmental Purchase officer");
        $obj=UserData::where("email","=",$email)->first();

       // echo $obj->email;
        $obj->approved=1;
        //$obj->uid=$request["uid"];
       $obj->uid=21888;
        $role=(string)$obj->uid;
       if($role[1]=='1' || $role[1]=='2')
       {
           $user=new Staff;
           $user->uid=$obj->uid;
           $user->name=$obj->name;
           $user->email=$obj->email;
           $user->assets_held="";
           $user->assets_quantity="";
           $user->role=$arr[(int)$role[1]];
           $user->save();
       }
      

        $obj->save();
        return 'Successful';

    }
    //FOR Department Purchase Officer.Function to return the list of all the requests for assets sent by the staff of that department.
    public function reqFromDep(Request $request)
    {   
        $dpoId="21098";
        //Regular Expression of all the Request_by Ids starting from the same number as dpoId
        $regExp="'^".$dpoId[0]."+'";
        $query="select * from requests where Request_by regexp ".$regExp;
        $result=DB::select($query);
        return $result;

    }
    //FOR Department Purchase Officer.Function to return the list of all the requests for assets received by the staff of that department.
    public function reqToDep(Request $request)
    {
        $dpoId="21098";
        
        $regExp="'^".$dpoId[0]."+'";
        $query="select * from requests where Request_From regexp ".$regExp;
        $result=DB::select($query);
        return $result;

    }
    //FOR Staff.Function to return the list of all the requests for assets sent by the staff .
    public function reqToStaff(Request $request)
    {
        $uid=21045;
        //$uid=(int)$request->uid;
        $result=DB::table("requests")->where("Request_by","=",$uid)->get();
        for($i=0;$i<sizeof($result);$i++)
        {
            $name=Staff::select("name")->where("uid","=",$result[$i]->Request_from)->get();
            $fromname=$name[0]["name"];
            $result[$i]->fromname=$fromname;
            $asset_name=Asset::select("asset_name")->where("asset_id","=",$result[$i]->asset_id)->get();
            $assetn=$asset_name[0]["asset_name"];
            $result[$i]->asset_name=$assetn;
        }
        return $result;

    }
    public function reqFromStaff(Request $request)
    {
        $uid=21045;
        //$uid=(int)$request->uid;
        $result=DB::table("requests")->where("Request_from","=",$uid)->get();
        for($i=0;$i<sizeof($result);$i++)
        {
            $name=Staff::select("name")->where("uid","=",$result[$i]->Request_by)->get();
            $fromname=$name[0]["name"];
            $result[$i]->fromname=$fromname;
            $asset_name=Asset::select("asset_name")->where("asset_id","=",$result[$i]->asset_id)->get();
            $assetn=$asset_name[0]["asset_name"];
            $result[$i]->asset_name=$assetn;
        }
        return $result;

    }
    public function assetOwned(Request $request)
    {
        //$uid=$request->uid;
        $uid=21045;
        $myString = Staff::select("assets_held")->where("uid","=",$uid)->get();
        $string= $myString[0]["assets_held"];
        $myString2=Staff::select("assets_quantity")->where("uid","=",$uid)->get();
        $string2=$myString2[0]["assets_quantity"];
     
        $myArray = explode(',', $string);
        $assetquantity=explode(',', $string2);
        $ownedassets=[];
        for($i=0;$i<sizeof($myArray);$i++)
        {
        $assetname=Asset::select("asset_name")->where("asset_id","=",$myArray[$i])->get();
        //$assetquant=Staff::select("assets_quantity")->where("asset_id","=",$assetquantity[$i])->get();
        array_push($ownedassets,["asset_name"=>$assetname[0]["asset_name"],"asset_quantity"=>$assetquantity[$i]]);

        }
        return $ownedassets;
    }
    public function postRequest(Request $request)
    {
        $order = new Order;
        //generate order_no
        $order_no = 2200015;
        $order->order_id = $order_no;

        //Fill requester details
        $order->requested_by = $request->uid;

        //find request receiver's uid using name
        $request_to = $request->name;
        $request_from = DB::select("select uid from user where name = '$request_to' ");
        $order->request_from = $request_from;

        //fill asset_id
        $order->asset_id = $request->asset_id;

        //enter quantity
        $order->quantity = $request->quantity;
        
        //initial approval is null
        $order->approved = 0;

        //commit transaction
        $order->save();

        return 'request placed successfully';
        
    }

}
 