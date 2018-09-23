<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

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
}
