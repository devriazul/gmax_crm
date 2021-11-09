<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use Stripe;
use App\Models\paymentgateway;
use App\Models\Invoice;
use App\Models\paymentrecepit;
use App\Models\setting;


use Srmklive\PayPal\Services\ExpressCheckout;


class gatewaycontroller extends Controller
{

    // gateway settings
    
    public function paymentgatewaysettings()
    {    
        $gateways = paymentgateway::get();
        return view('settings.paymentgateways')->with(['gateways' =>$gateways]);    
     
    }

    public function paymentgatewaysettingssave(Request $request)
    {    
        $gateways =paymentgateway::findOrFail($request->id);    
        $gateways->paytitle =$request->paytitle;
        $gateways->apikey =$request->apikey;
        $gateways->apisecret =$request->apisecret;
        $gateways->apiextra =$request->apiextra;             
        $gateways->save();  
        return redirect()->back()->with('success', 'Payment Gateway Updated');
    }

    public function paymentgatewayenable(Request $request)
    {    
        $gateways =paymentgateway::findOrFail($request->id);       
        $gateways->status =$request->status;             
        $gateways->save();  
        return redirect()->back()->with('success', 'Payment Gateway Updated');
    }








    
    ////////////////////////// razor pay //////////////////////////////

    public function razorpayview()
    {        
        return view('app.payment.razorpay');
    }

    public function razorpaypayment(Request $request)
    {  
        $gateways =paymentgateway::findOrFail(3); 

        $input = $request->all();        
        $api = new Api($gateways->apikey,$gateways->apisecret);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                 $invoices = Invoice::findOrFail($request->invoid);
                    $paidamountnow = $invoices->totalamount - $invoices->paidamount;
                    $paymentrecepit =new paymentrecepit();
                    $paymentrecepit->invoiceid=$request->invoid;         
                    $paymentrecepit->amount =$paidamountnow;
                    $paymentrecepit->date =date('Y-m-d');
                    $paymentrecepit->transation =$input['razorpay_payment_id'];
                    $paymentrecepit->note ='Paid using Razorpay';  
                    $paymentrecepit->gateway ='Razorpay';                         
                    $paymentrecepit->save();      
                
                    $currentpaid =  $invoices->paidamount;
                    $invoices->paidamount = $currentpaid + $paidamountnow; 
                    $nowpaid=  $currentpaid + $paidamountnow;           
                    $invoices->invostatus = 3;                            
                    $invoices->save();  

            } 
            catch (\Exception $e) 
            {               
                return redirect()->back()->with('error', $e->getMessage());
            }            
        }
        
 
    return redirect()->back()->with('success', 'Thank you for your payment!');
    }


    //////////////////  stripe //////////////////////

    public function stripeview()
    {
        return view('app.payment.stripe');
    }

    public function stripepayment(Request $request)
    {
        $gateways =paymentgateway::findOrFail(2);         
        $invoices = Invoice::findOrFail($request->invoid);    
        $setting = setting::find(1);         
        $paidamountnow = $invoices->totalamount - $invoices->paidamount;
        $famount = $paidamountnow*100;
        Stripe\Stripe::setApiKey($gateways->apisecret);
        Stripe\Charge::create ([
                "amount" => $famount,
                "currency" => $setting->suffix,
                "source" => $request->stripeToken,
                "description" => "Payment of Invoice #". $invoices->id,
        ]);
          
        $paymentrecepit =new paymentrecepit();
        $paymentrecepit->invoiceid=$request->invoid;         
        $paymentrecepit->amount =$paidamountnow;
        $paymentrecepit->date =date('Y-m-d');
        $paymentrecepit->transation =$request->stripeToken;
        $paymentrecepit->note ='Paid using Stripe';  
        $paymentrecepit->gateway ='Stripe';                         
        $paymentrecepit->save();      
      
        $currentpaid =  $invoices->paidamount;
        $invoices->paidamount = $currentpaid + $paidamountnow; 
        $nowpaid=  $currentpaid + $paidamountnow;           
        $invoices->invostatus = 3;                            
        $invoices->save();   

        Session::flash('success', 'Payment Successful !');
           
        return back();
    }

    ////////////////////////////paypal //////////////////////////////

    public function paypalview()
    {
        return view('app.payment.paypal');
    }

    public function paypalhandlePayment(Request $request)
    {
        $oderidd =$request->invoid;
        $paymentid =$request->orderID;
       
        if($request->orderID!=NULL)
        {
            $invoices = Invoice::findOrFail($request->invoid);
            $paidamountnow = $invoices->totalamount - $invoices->paidamount;
            $paymentrecepit =new paymentrecepit();
            $paymentrecepit->invoiceid=$request->invoid;         
            $paymentrecepit->amount =$paidamountnow;
            $paymentrecepit->date =date('Y-m-d');
            $paymentrecepit->transation =$request->orderID;
            $paymentrecepit->note ='Paid using Paypal';  
            $paymentrecepit->gateway ='Paypal';                         
            $paymentrecepit->save();      
          
            $currentpaid =  $invoices->paidamount;
            $invoices->paidamount = $currentpaid + $paidamountnow; 
            $nowpaid=  $currentpaid + $paidamountnow;           
            $invoices->invostatus = 3;                            
            $invoices->save();  
          

            
        }
       
       
    }    
    
}
