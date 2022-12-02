<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use RakutenRws_Client;
use App\Models\USer;

class ProductController extends Controller
{
    public function index()
    {
        $products = \Auth::user()->products()->get();
        $products =Product::paginate(6);
        
        return view('products.product',compact('products'));
    }
    
    public function create(Request $request)
    {
        $itemCode = $request->input('itemCode');
        return view('products.create',compact('itemCode'));
    }
    
    public function  store(Request $request)
    {
        $request->validate([
        'name' => 'required|max:200',
        'price' => 'required|integer',
        ]);
        
        $Products = new product;
        $Products->timestamps = false;
        $Products->name=$request->input(["name"]);
        $Products->price=$request->input(["price"]);
        $Products->item_code=$request->input(["item_code"]);
        $Products->user_id=$request->input(["user_id"]);
       
        $Products->save(); 
        
        return redirect()->route('products.product');
        
    }
    
    public function edit(Product $product)
    {
        
        return view('products.edit',compact('product'));
         
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
        'name' => 'required|max:20',
        'price' => 'required|integer',
        
        ]);
        
        
        $product->timestamps = false;
        $product->name=$request->input(["name"]);
        $product->price=$request->input(["price"]);
       
        $product->save(); 
        
        return redirect()->route('products.product');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.product');
        
    }
    
    public function get_rakuten_items(Request $request)
      {
        $serch = $request->input('serch_word');
        // 楽天apiを使うのが簡単になるクラスのインスタンスを作成
        $client = new RakutenRws_Client();
        // 検索ワードを取得
        // $search = $request->input(‘serch_word’);
        // define関数を定義
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        // アプリIDをセットする
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        // IchibaItem/Search API から、keyword=検索されたserch_word を検索します
        $response = $client->execute('IchibaItemSearch',array(
            // 検索ワードをキーワードに入れる
            'keyword' => $serch,
            // 'itemCode' => 'daichugame:10005059',
            //'itemCode' => 'm-shinwa:10003493',
            //'hits' => 30,
            //'page' => 2,
            //'minPrice' => 30000,
            //'maxPrice' => 600000, //値段の上限を設定できる。
            // 'NGKeyword' => '修理'
        ));
        if(!$response->isOk()){
            // エラーが発生した時の処理
            return 'Error:'.$response->getMessage();
        } else {
            // IchebaItemSearchから帰ってきた値を、配列$itemsに入れていく
            $items = [];
            foreach($response as $key => $rakutenItem){
                $items[$key]['title'] = $rakutenItem['itemName'];
                $items[$key]['price'] = $rakutenItem['itemPrice'];
                $items[$key]['url'] = $rakutenItem['itemUrl'];
                $items[$key]['item_code'] = $rakutenItem['itemCode'];
                if($rakutenItem['imageFlag']){
                    $imgSrc = $rakutenItem['mediumImageUrls'][0]['imageUrl'];
                    $items[$key]['img'] = preg_replace('/^http:/','https:',$imgSrc);
                }
            }
            
            // viewと一緒に先ほどの取得した値を‘items’として返す
            return view('products.rakuten')->with(['items' => $items]);
        }
    }
     
     public function serch_rakuten_items(Request $request)
      {
        $code = $request->input('item_code');
        $price = $request->input('price');
       
        // 楽天apiを使うのが簡単になるクラスのインスタンスを作成
        $client = new RakutenRws_Client();
        // 検索ワードを取得
        // $search = $request->input(‘serch_word’);
        // define関数を定義
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        // アプリIDをセットする
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        // IchibaItem/Search API から、keyword=検索されたserch_word を検索します
        $response = $client->execute('IchibaItemSearch',array(
            // 検索ワードをキーワードに入れる
            //'keyword' => $serch,
            // 'itemCode' => 'daichugame:10005059',
            'itemCode' => $code,
            //'hits' => 30,
            //'page' => 2,
            //'minPrice' => 30000,
            //'maxPrice' => $price, //値段の上限を設定できる。
            // 'NGKeyword' => '修理'
        ));
        if(!$response->isOk()){
            // エラーが発生した時の処理
            return 'Error:'.$response->getMessage();
        } else {
            // IchebaItemSearchから帰ってきた値を、配列$itemsに入れていく
            $items = [];
            foreach($response as $key => $rakutenItem){
            //echo $rakutenItem['itemPrice'];
            //echo $price;
                if($rakutenItem['itemPrice'] <= $price){
                    $items[$key]['title'] = $rakutenItem['itemName'];
                    $items[$key]['price'] = $rakutenItem['itemPrice'];
                    $items[$key]['url'] = $rakutenItem['itemUrl'];
                    $items[$key]['item_code'] = $rakutenItem['itemCode'];
                    $diff = $price - $rakutenItem['itemPrice'];
                    if($rakutenItem['imageFlag']){
                        $imgSrc = $rakutenItem['mediumImageUrls'][0]['imageUrl'];
                        $items[$key]['img'] = preg_replace('/^http:/','https:',$imgSrc);
                    }
                    
                }else{
                    $diff = $rakutenItem['itemPrice'] - $price;
                   return view('products.no_serch' , compact('diff'));
                }
                
                
            }
            
            
            return view('products.serch' , compact('diff','items'));
        }
    }
    
    
    
}
