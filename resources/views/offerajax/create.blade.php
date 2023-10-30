@extends('layouts.app')

@section('content')

<div class="container">
    <div class="alert alert-success" role="alert" id="success" style="display: none;" >
            saved successfully
    </div>
    <h1> add your offers</h1>
    <form method="" action="" enctype="" id="myForm">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="exampleInputEmail1">offer name</label>
          <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="name">
          @error('name')
          <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
          @enderror
         </div>

        <div class="form-group">
          <label for="exampleInputEmail1">select photo</label>
          <input type="file" class="form-control" name="photo" aria-describedby="emailHelp" placeholder="select photo">
          @error('photo')
          <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">offer price</label>
          <input type="text" class="form-control" name="price" placeholder="price">
          @error('price')
          <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">offer details</label>
          <input type="text" class="form-control" name="details" placeholder="details">
          @error('details')
          <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
          @enderror
          <br>
        </div>
        <button id="save_offer" class="btn btn-primary">{{__('message.testmessage')}}</button>
  </form>
</div>
@endsection
@section('scripts')
 <script>
   $(document).on('click','#save_offer',function(e){
    e.preventDefault();
    var form = new FormData($('#myForm') [0]);
    $.ajax({
        enctype:'multipart/form-data',
        url:"/offersajax/save",
        data:form,
        method:'post',
        // dataType:'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
            if(data.status==true)
                $('#success').show();
        },
        error:function(reject){
        },
    });
   });
 </script>
{{--     'name':$("input[name='name']").val(),
    // 'photo':$("input[name='photo']").val(),
    'price':$("input[name='price']").val(),
    'details':$("input[name='details']").val(),
     form.serialize() --}}
@stop
