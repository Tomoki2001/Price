@extends('app')
   
@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1.3rem;">商品登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{url('/products/product')}}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('products.store') }}" method="POST">
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="商品名">
                 @error('name')
                   <span style="color:red;">名前を200文字以内で入力してください</span>
                 @enderror
            </div>
           
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="hidden" name="item_code" class="form-control" value={{$itemCode}}>
            </div>
        </div>
      
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="購入したい価格">
                @error('price')
                   <span style="color:red;">購入したい価格を入力してください</span>
                 @enderror
                
            </div>
           
            <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
            <input type="hidden" name="imageFlag">

            
        </div>
      
        
        
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>
</div>
@endsection