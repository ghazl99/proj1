<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Localization;
use App;
use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Video;
use Illuminate\Support\Facades\Redirect;
use App\Traits\OfferTrait;
class OfferController extends Controller
{
  use OfferTrait;
    /**
     * Class constructor.
     */
    public function __construct()
    {
//
    }
    public function get_offer() {
    return Offer::get();
    }
    // public function store(){
    // Offer::create([
    //     'name'=>'jacket',
    //      'price'=>'200000',
    //      'details'=>'fifty pieces ',
    // ]);
    // }
    public function create(){
        return view('offer.create');
    }
    public function store(OfferRequest $request){
        //validate
    //     $rules=['name'=> 'required|max:100|unique:offers,name',
    //                                         'price'=>'required|numeric',
    //                                          'details'=> 'required',
    // ];
    // $message=[
    //     'name.required'=>__('message.offer name required'),
    //     'name.unique'=>__('message.offer name must be  unique'),
    //     'price.numeric'=>'اسم العرض يجب ان يكون ارقام',
    // ];
    // $val=Validator::make($request->all(),$rules,$message);
    // if ($val ->fails()) {

    // return redirect()->back()->withErrors($val)->withInput($request->all());
    //}
    //saved photo
    $file_name=$this->saveImage($request->photo,'/offers');
        //create record in db
    Offer::create([
    'name'=>$request ->name ,
    'photo'=>$file_name,
    'price'=> $request ->price,
    'details'=> $request ->details,
    ]);
    return redirect()->back()->with(['success'=>'saved successfully']);

    }
    public function getOffer() {
       $offers=Offer::select('id','name','status','price','photo')->get();
       return view('offer.all',compact('offers'));
    }
    public function editOffer($id) {
    //    Offer::findOrFail($id);
      $off= Offer::find($id); //
      if(!$off)
      {
        return Redirect()->back();
      }
      $off=Offer::select('id','name','price','details')->find($id);
      return view('offer.edit',compact('off'));
    }
      public function updateOffer(OfferRequest $request ,$id) {
        //validation
        //check if exist
     $off=Offer::select('id','name','price','details')->find($id);

    //  $off= Offer::find($id); //
    //          return Redirect()->back();
             //update
      $off->update($request ->all());
     return redirect()->Route('offers.all')->with(['success'=>'update successfully']);

      }
      public function deleteOffer($id){
        $off= Offer::find($id); //
        if(!isset($off)){

         return Redirect()->Route('offers.all')->with(['error'=>'offer id not found']);
        }

         $off->delete();
      return Redirect()->Route('offers.all')->with(['success'=>'offer deleted successfully']);
      }
      public function getVideo() {
        $video=Video::first();
        event(new VideoViewer($video));
            return view('offer.video')->with('video',$video);

      }

}
