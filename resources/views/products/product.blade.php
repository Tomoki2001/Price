@extends('app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">商品登録</h2>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="{{route('products.create')}}">新規登録</a>
            </div>
        </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>商品名</th>
            <th>値段</th>
            <th>URL</th>
            <th>Email</th>
            <th></th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->url }}</td>
            <td style="text-align:right">{{ $product->email }}</td>
            <td style="text-align:center">
               <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">変更</a>
            </td>
             <td style="text-align:center">
                <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                 </form>
            </td>
        </tr>
        @endforeach
       
    </table>
 
    
@endsection