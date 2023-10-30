@extends('layouts.app')
@section('content')

<div class="container">
    <div class="alert alert-success" role="alert" id="success" style="display: none;" >
            update successfully
    </div>
    <div class="alert alert-danger" role="alert" id="error" style="display: none;" >
            failed successfully
    </div>
    <h1> add your offers</h1>
    <form method="" enctype="" id="myForm">
        @csrf
            {{method_field('PUT')}}
        <div class="form-group">
            <label for="exampleInputEmail1">offer name</label>
            <input type="text" class="form-control" name="name" value="{{$off -> name}}" aria-describedby="emailHelp" placeholder="name">
            @error('name')
                <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            
            <input type="text" style="display: none;" class="form-control" name="id" value="{{$off -> id}}" aria-describedby="emailHelp" placeholder="name">
           
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
            <input type="text" class="form-control" name="price" placeholder="price" value="{{$off -> price}}">
            @error('price')
                <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">offer details</label>
            <input type="text" class="form-control" name="details" value="{{$off -> details}}"  placeholder="details">
            @error('details')
                <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
            @enderror
            <br>
        </div>
        <button offer_id="{{$off->id}}" type="button" id="update_offer" class="btn btn-primary">save</button>
    </form>
</div>
@endsection
@section('scripts')
 <script>
    $(document).on('click','#update_offer',function(e){
        console.log(123);
       e.preventDefault();
        var form = new FormData($('#myForm') [0]);
        $.ajax({
            enctype:'multipart/form-data',
            url:"/offersajax/update",
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
