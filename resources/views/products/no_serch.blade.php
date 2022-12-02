@extends('app')
   
@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1.3rem;">商品値段確認</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products/product') }}">戻る</a>
        </div>
    </div>
</div>

<h3 style="font-size:2rem;">検索結果</h3>
<br>

<h4 style="font-size:1.5rem;">まだ設定した金額より<span>{{$diff}}円</span>高いです...</h4>


<div class="watermark">
   
    <div class="watermark__inner">
　　 <div class="watermark__body">Soory</div>
    </div>
    
</div>




@endsection