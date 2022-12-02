@extends('app')
  
@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1.3rem;">商品検索・登録</h2>
            </div>
        </div>
        <form action="{{route('products.rakuten') }}"  method="GET">
        @csrf
        <input type='text' name='serch_word' placeholder="商品名">
        @error('serch_word')
        <span style="color:red;">名前を20文字以内で入力してください</span>
        @enderror
        <button type="submit">検索</button>
        </form>
    <table class="table table-bordered" border='10'  bordercolor='black'>
        <tr>
            <th>商品名</th>
            <th>アイテムコード</th>
            <th>購入したい値段</th>
            <th>検索</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        @foreach ($products as $product )
        <tr>
            <td>{{ $product->name }}</td>
            
            <td style="text-align:right">{{ $product->item_code }}</td>
            
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:center">
                <form action="{{route('products.serch') }}"  method="GET">
                @csrf
                <input type='hidden' name='item_code' value={{$product->item_code}}>
                <input type='hidden' name='price' value={{$product->price}}> 
                <button type="submit"  class="serch_button">調べる</button>
                </form>
                 </td>
            
            <td style="text-align:center">
               <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">変更</a>
            </td>
             <td style="text-align:center">
                <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                 </form>
             </td>
        </tr>
       
        @endforeach
        
    </table>
    <div>
        {{$products->links('pagination::bootstrap-4')}}
        
    </div>
    
    
@endsection