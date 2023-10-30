@extends('layouts.app')
@section('content')
<div class="container">
 <div class="alert alert-danger" role="alert" id="success" style="display: none;" >
            delete successfully
 </div>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">price</th>
      <th scope="col">photo</th>
      <th scope="col">operation</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($offers as $offer)
    <tr class="offerrow{{$offer-> id}}" >
        <th scope="row">{{$offer-> id}}</th>
        <td>{{$offer->name}}</td>
        <td>{{$offer->price}}</td>
        <td><img src="{{ asset('/offers/' . $offer->photo) }}" width="300px" height="200px" /> {{ $offer->photo}}</td>
        <td><a href="{{url('offersajax/edit/'.$offer-> id)}}" class="btn btn-success"> {{__('update_ajax')}}</a>
        <a href="" offer_id="{{$offer->id}}" class="btn btn-danger delete_btn"> {{__('delete_ajax')}}</a>
        </td>

    </tr>
      @endforeach
  </tbody>
 </table>
</div>
@endsection
@section('scripts')
    <script>
       $(document).on('click','.delete_btn',function(e)
        {
            e.preventDefault();
            var offerid= $(this).attr('offer_id');
            $.ajax({
                enctype:'multipart/form-data',
                url:"/offersajax/delete",
                data:{
                    '_token':"{{csrf_token()}}",
                    'id':offerid,
                },
                type:'get',
                success:function(data){
                    if(data.status==true)
                        $('#success').show();
                    $('.offerrow'+data.id).remove();
                },
                error:function(reject){
                },
            });
        });
    </script>
@endsection
