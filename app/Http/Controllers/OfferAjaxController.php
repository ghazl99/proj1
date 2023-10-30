<?php

namespace App\Http\Controllers;
use App\Traits\OfferTrait;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

class OfferAjaxController extends Controller
{
      use OfferTrait;

    public function create() {
        return view('offerajax.create');
    }
    public function save(Request $request) {
        // dd($request->input());
        //saved photo
        $file_name=$this->saveImage($request->photo,'/offers');
        //create record in db
        $off= Offer::create([
          'name'=>$request ->name ,
          'photo'=>$file_name,
          'price'=> $request ->price,
          'details'=> $request ->details,
        ]);
         if($off)
           return response()->json([
            'status'=> true,
            'msg'=>'saved successfully',
         ]);
         else
           return response()->json([
            'status'=> false,
            'msg'=>'Save failed',
         ]);
    }
    public function getOffer() {
       $offers=Offer::select('id','name','price','photo')->get();
       return view('offerajax.all',compact('offers'));
    }
    public function deleteOffer(Request $request)
    {
        $off= Offer::find($request ->id);
        if($off)
            $off->delete();
            return response()->json([
            'status'=> true,
            'msg'=>'delete successfully',
            'id'=>$request->id,
            ]);

    }
    public function editOffer(Request $request)
    {
    //    Offer::findOrFail($id);
        $off= Offer::find($request ->id); //
        if(!$off)
            {
                return response()->json([
                'status'=> false,
                'msg'=>'this offer not found',
                'id'=>$request->id,
                ]);
            }
        $off=Offer::select('id','name','price','details')->find($request ->id);
        return view('offerajax.edit',compact('off'));
    }
    public function updateOffer(Request $request) {
        $off= Offer::find($request ->id);
        $off->update($request ->all());
        // if($off)
        //     //update
            // return response()->json([
            // 'status'=> true,
            // 'msg'=>'update successfully',
            // ]);
            // $off->update($request ->all());


     }
}