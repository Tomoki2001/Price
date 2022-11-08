@extends('app2')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">商品登録変更画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products/product') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
 
 
  <form action="{{ route('products.update',$product->id) }}" method="POST">

    @method('PUT')
    
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="商品名">
                 @error('name')
                   <span style="color:red;">名前を20文字以内で入力してください</span>
                 @enderror
            </div>
           
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="url" value="{{ $product->url }}"  class="form-control" placeholder="商品のURL">
                @error('url')
                   <span style="color:red;">商品のURLを入力してください</span>
                 @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="購入してもよい値段">
                @error('price')
                   <span style="color:red;">値段を入力してください</span>
                 @enderror
                
            </div>
        </div>
        
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="email" value="{{ $product->email }}" class="form-control" placeholder="Email">
                @error('email')
                   <span style="color:red;">Emailを入力してください</span>
                 @enderror
            </div>
        </div>
 
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>