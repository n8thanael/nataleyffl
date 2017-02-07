<?php

use Bigcommerce\Api\Client as Bigcommerce;

class bc_api_test {

  public $string;

  public function test(){

    Bigcommerce::configure(array(
        'store_url' => 'https://store-yiaomofyl1.mybigcommerce.com',
        'username'  => 'n8thanael',
        'api_key'   => '27829dd700728b0e723d457bb1eca1d25e11bac4'
    ));

    /*
    Bigcommerce::configure(array(
        'client_id' => '991f5nw2mjoukseygibqn5idsl9haqd',
        'auth_token' => '63x7yadlpx20svh9543xaeqhtjc0j7s',
        'store_hash' => 'yiaomofyl1'
    ));
    */

    Bigcommerce::verifyPeer(false);

    $ping = Bigcommerce::getTime();

    if(!$ping){
      $error = Bigcommerce::getLastError();
      $this->string .= '<pre>';
      $this->string .= implode($error);
      $this->string .= '</pre>';
    } else {
      $this->string .=  $ping->format('H:i:s');  
    }

    $products = Bigcommerce::getProducts();

    foreach ($products as $product){
      $this->string .=  $product->id . " - ";  
      $this->string .=  $product->name . " $";
      $this->string .=  $product->price . "<br>";
    }

    $product = Bigcommerce::getProduct(80);

    $this->string .=  $product->name;
    $this->string .=  $product->price;

    $count = Bigcommerce::getProductsCount();
    $this->string .=  "<p>" . $count . "</p>";

    return $this->string;
  }

  public function tellmesomething(){
     $this->string = 'something';
     return $this->string;
  }

}