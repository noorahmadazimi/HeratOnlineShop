<?php

namespace App\Http\Controllers;
use App\Product;
use App\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RecommenddController extends Controller
{
   public function addRating( Request $request){

    $stars_rate = $request->input('product_rating');
    $product_id = $request->input('product_id');

    $product_check = Product::where('id',$product_id);
    $user_check = Auth::check();


    if($product_check && $user_check ){

        $rateProduct= new Rating();

        $alreadyRated = Rating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
        if($alreadyRated){
            $alreadyRated->stars_rated = $stars_rate;
            $alreadyRated->update();

        }
        else{
        $rateProduct->user_id = Auth::id();
        $rateProduct->product_id=$product_id;
        $rateProduct->stars_rated = $stars_rate;
        $rateProduct->number_of_clicked="1";
        $rateProduct->number_of_view="1";

        $rateProduct->save();
        }

        
        return redirect()->back()->with('status','Thank You For Ratting This Product');
       
    }
    else{
        return redirect()->back()->with('status2','Ooops! You should log in first!');
    }


   }

   public function addView(Request $request){

    $product_id = $request->input('product_id');

    $product_check = Product::where('id',$product_id);
    $user_check = Auth::check();


    if($product_check && $user_check ){

        $rateProduct= new Rating();

        $viewNum = $rateProduct->number_of_clicked;
        

        $alreadyClicked = Rating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
        if($alreadyClicked){

            $alreadyClicked->number_of_clicked = $viewNum+1;
            $alreadyClicked->number_of_view = $viewNum+1;
             
            $alreadyClicked->update();

            
        }
        else{
        $rateProduct->user_id = Auth::id();
        $rateProduct->product_id=$product_id;
        $rateProduct->stars_rated = "0";
        $rateProduct->number_of_clicked = 1;
        $rateProduct->number_of_view = 1;

        $rateProduct->save();
        }

        
        return redirect()->back();
       
    }
    else{
        return redirect()->back();
    }


   
}

public function recommendedMethod(){

    $i =0;


    $findRelatedDataProductId = array();
    $findRelatedDataRate = array();
    $findOtherSameRatedUser = array();
    
    //specifies user interests
    $findRelatedData = Rating::get()->where('user_id',Auth::id());
    foreach($findRelatedData as $find){
      $findRelatedDataProductId[$i]  = $find->product_id;
      $findRelatedDataRate[$i] = $find->stars_rated;

      $i++;
      
    }

    
    
    $otherUser = array();
    $myClearArray = array();

    $productIdArray = array();
    $productRateArray = array();
    $similarityArray = array();
      
    $clearIndex = 0;
    $clearIndex2=0;
      //finding similar user
    for($i=0 ; $i< count($findRelatedDataProductId) ; $i++){

        $otherUser[$i] = Rating::get()->where('user_id' , '!=' , Auth::id())
        ->where('product_id' ,$findRelatedDataProductId[$i]);

        if($otherUser[$i] != '[]'){
            $myClearArray[$clearIndex] = $otherUser[$i];
            $clearIndex++;

        }else{}
        
    }
 // finding pearson correlation average for evey person
    for($j=0 ; $j<count($myClearArray) ; $j++){
         
        foreach($myClearArray[$j] as $ca){
            $productIdArray[$j] =  $ca->product_id;
            $productRateArray[$j] = $ca->stars_rated;
            
        }
           $similarityArray[$j] = $this->pearsonCorrelation($findRelatedDataRate,$productRateArray);
        
    }
    
      
    $wieghtedArray = array();
    $similarityArray2 =array();
    $totalWieghted = 0;
    $totalSimilarity = 0;
    //finding weight for similarity User
    for($i=0 ; $i< count($productIdArray) ; $i++){

        $similarityArray2[$i] = Rating::get()->where('product_id' , $productIdArray[$i])
        ->where('stars_rated' ,$productRateArray[$i]);
        foreach($similarityArray2[$i] as $sim){
            $wieghtedArray[$i] =  $sim->stars_rated *$similarityArray[$i];
            
        }
        
        // echo($wieghtedArray[$i].'<br>');
    }

    //recommended after the matrix created successfully
    $recommedMatrix = array();
    for($i = 0 ; $i< count($similarityArray) ; $i++){
      
        $totalWieghted += $wieghtedArray[$i];
        $totalSimilarity+= $similarityArray[$i];

       
        if($totalSimilarity==0){
            $totalSimilarity=1;
        }

        $averageProductToRate = $totalWieghted/$totalSimilarity;
        $recommedMatrix[$i] = $averageProductToRate;

    }


    $recommedMatrixObject=array();
    for($i=0 ; $i< count($productIdArray) ; $i++){
        $recommedMatrixObject[$i] = Product::get()->where('id' , $productIdArray[$i]);
        
        
    }
   
//     for($i=0 ; $i< count($recommedMatrixObject) ; $i++){
//     foreach($recommedMatrixObject[$i] as $rmo){
//     echo($rmo->id);
//     }
// }


return view('RecommendedProducts', compact('recommedMatrixObject'));
}


function pearsonCorrelation($x , $y){

    if(count($x) > count($y)){
      for($i=count($y)-1 ; $i < count($x) ; $i++){
        $y[$i]=0;
      }
    }
    else if(count($y) > count($x)){
        for($i=count($x)-1 ; $i < count($y) ; $i++){
            $x[$i]=0;
          }
    }
     
    if(count($x)!= count($y)){return -1;}
    $x = array_values($x);
    $y = array_values($y);
    $xs = array_sum($x)/count($x);
    $ys = array_sum($y)/count($y);
  
    $a=0;
    $bx=0;
    $by=0;
  
    for($i=0 ; $i < count($x) ; $i++){
     
      $xr = $x[$i]-$xs;
      $yr = $y[$i]-$ys;
      $a+=$xr*$yr;
      $bx += pow($xr,2);
      $by += pow($yr,2);
  
    }
  
    $b = sqrt($bx*$by);
    if($b==0) return 0;
    return $a/$b;
  
  
   }
  
  
  
  
   

  
}


