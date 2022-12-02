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
 
@foreach($items as $item)

            <h3>商品名：{{ $item['title'] }}</h3>
            
            <input id="copy1" type='text' value="{{ $item['title'] }}">
            <button onclick="cp()">コピー</button>
            
            <script>
            function cp(){
            var txt = document.getElementById("copy1");
            txt.select();
            document.execCommand("Copy");
            }
            </script>
            
            
            <p id="price">現在の価格:<span id="rakuten_price">{{ $item['price'] }}円</span></p>
            <p><a href="{{ $item['url']}}">楽天市場のページ</a></p>
            <img src="{{ $item['img']}}">
<form action="{{ route('products.create') }}" method="GET">
    @csrf
    <input type="hidden" name="itemCode" value={{$item['item_code']}}>
    <input type="submit" class='button' value='登録する'>
</form>


@endforeach
@endsection