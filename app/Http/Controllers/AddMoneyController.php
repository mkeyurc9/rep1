<?php
	namespace App\Http\Controllers;
// use App\Http\Requests;
// use Illuminate\Http\Request;
use Validator;
use Session;
// use Redirect;
use Illuminate\Support\Facades\Input;
// /** All Paypal Details class **/
// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;
// use PayPal\Api\Amount;	
// use PayPal\Api\Details;
// use PayPal\Api\Item;
// use PayPal\Api\ItemList;
// use PayPal\Api\Payer;
// use PayPal\Api\Payment;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\ExecutePayment;
// use PayPal\Api\PaymentExecution;
// use PayPal\Api\Transaction;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\employer_frontend\PaymentController;
use Paypal;
use Redirect;
use URL;
use Illuminate\Http\Request;
use DB;
class AddMoneyController extends HomeController
{
   
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function payPremium($payment)
    {
        // return view('payPremium');
        // $this->getCheckout($payment);
    }

  public function getCheckout($paymentbaseid)
    {

        $paid=app(PaymentController::class)->getremainfees($paymentbaseid); 
        $user=app(PaymentController::class)->getuserinfo($paymentbaseid); 
        $paymentcount=app(PaymentController::class)->getpaymentcount($paymentbaseid);
        //for the calculation of the payment due

        if($paid==0)
        {
            $paymentremain=$user[0]->payment;
            
            if($user[0]->paymentsetting=='I')
            {

                $cal_installment=$user[0]->payment/3;
                $cal_installment=floor($cal_installment);
                if($paymentremain!=$cal_installment)
                {
                    $payment_due=$cal_installment;
                } 
                else
                {
                    $payment_due=$paymentremain;
                }
            }
            else
            {
                $payment_due=$paymentremain;
            }
            $final_remain_payment=$user[0]->payment-$payment_due;

        }

        else
        {

            $paymentremain=$user[0]->payment-$paid;
            
            if($user[0]->paymentsetting=='I')
            {
                if($paymentcount==1)
                {
                    $cal_installment=$user[0]->payment/3;
                    $cal_installment=floor($cal_installment);
                }
                else
                {
                    $cal_installment=$user[0]->payment-$paid;
                }
                if($paymentremain!=$cal_installment)
                {
                    $payment_due=$cal_installment;
                } 
                else
                {
                    $payment_due=$paymentremain;
                }

            }
            $final_remain_payment=$user[0]->payment-$payment_due;

        }
        if (preg_match("/^\d+(\.\d+)?$/", $payment_due) && $payment_due!=0) 
        {
            $payment_preprocessing = array
            (
                'employer_id' => $user[0]->empid,
                'candidate_id' => $user[0]->candidid,
                'job_id' => $user[0]->jobid,
                'payment_base_id' => $user[0]->payment_base_id,
                'payment_setting' => $user[0]->paymentsetting,
                'paid' => $payment_due,
                'payment_status' => 'Pending',
                'transaction_id' =>'',
                'response' => '',
                'created_at' => date('Y-m-d H:i:s '),
                'updated_at' => date('Y-m-d H:i:s')
        
            );

        DB::table('payment_preprocessing')->insert($payment_preprocessing);


        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $webProfile = PayPal::WebProfile();

        $inputFields = PayPal::InputFields();
        $inputFields->setAllowNote(true)->setNoShipping(1)->setAddressOverride(0);


        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($payment_due);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Payment Amount '.$payment_due);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('getDone'));
        $redirectUrls->setCancelUrl(route('getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $payment->setExperienceProfileId("XP-VLYB-MQ6T-N95J-ASEP");
        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl ); 
    }

        Session::flash('error','Invalid Amount');
        return redirect()->route('candidatepay.canddidate_payment');
    }

    public function createWebProfile(){

        $flowConfig = PayPal::FlowConfig();
        $presentation = PayPal::Presentation();
        $inputFields = PayPal::InputFields();
        $webProfile = PayPal::WebProfile();
        $flowConfig->setLandingPageType("Billing"); //Set the page type

        // $presentation->setLogoImage("https://www.example.com/images/logo.jpg")->setBrandName("Example ltd"); //NB: Paypal recommended to use https for the logo's address and the size set to 190x60.

        $inputFields->setAllowNote(true)->setNoShipping(1)->setAddressOverride(0);
        
        $webProfile->setName("JonZedra " . uniqid())
            ->setFlowConfig($flowConfig)
            // Parameters for style and presentation.
            ->setPresentation($presentation)
            // Parameters for input field customization.
            ->setInputFields($inputFields);

        $createProfileResponse = $webProfile->create($this->_apiContext);
            
        echo $createProfileResponse->getId(); //The new webprofile's id
    }


    public function getDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

// echo '<pre>';
// print_r($executePayment);exit;

        if ($executePayment->getState() == 'approved') { 

            $paymentpreprocessing=$this->getidpaypmentprepocessing();

                $preprocessing=array(
                    'payment_status'=>'Completed',
                    'transaction_id'=>$id,
                    'response'=>serialize($executePayment),
                    'updated_at' => date('Y-m-d H:i:s')
                    );

                DB::table('payment_preprocessing')
                    ->WHERE('id',$paymentpreprocessing->id)
                    ->update($preprocessing);



                    $paymentmade=array(
                        'employer_id'=>$paymentpreprocessing->employer_id,
                        'candidate_id'=>$paymentpreprocessing->candidate_id,
                        'job_id'=>$paymentpreprocessing->job_id,
                        'payment_base_id'=>$paymentpreprocessing->payment_base_id,
                        'payment_preprocessing_id'=>$paymentpreprocessing->id,
                        'payment_setting'=>$paymentpreprocessing->payment_setting,
                        'paid'=>$paymentpreprocessing->paid,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                       );
                    DB::table('payment_made')->insert($paymentmade);

//for updating payment completed status in payment_base
                    $condition=array(
                              'payment_base_id'=>$paymentpreprocessing->payment_base_id
                              );
                    $payment_made = DB::table('payment_made')->WHERE($condition)->count();

                    if($payment_made==3 || $paymentpreprocessing->payment_setting=='F')
                    {
                        $paymentbase_update=array(
                            'payment_complete'=>1
                            );

                    DB::table('payment_base')
                    ->WHERE('id',$paymentpreprocessing->payment_base_id)
                    ->update($paymentbase_update);

                    }
                    Session::flash('success','Payment Made successfully..!!');
                // return redirect()->route('candidatepay.canddidate_payment');
                    return view('employer_frontend/payment/payment_successful');



        }
        elseif($executePayment->getState() == 'failed')
        {
                $paymentpreprocessing=$this->getidpaypmentprepocessing();

                $preprocessing=array
                (
                    'payment_status'=>'Failed',
                    'transaction_id'=>$id,
                    'response'=>serialize($executePayment),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                DB::table('payment_preprocessing')
                    ->WHERE('id',$paymentpreprocessing->id)
                    ->update($preprocessing);
        }
        elseif ($executePayment->getState() == 'canceled')
        {
             $paymentpreprocessing=$this->getidpaypmentprepocessing();

                $preprocessing=array
                (
                    'payment_status'=>'Canceled',
                    'transaction_id'=>$id,
                    'response'=>serialize($executePayment),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                DB::table('payment_preprocessing')
                    ->WHERE('id',$paymentpreprocessing->id)
                    ->update($preprocessing);
        }
        elseif ($executePayment->getState() == 'expired')
        {
             $paymentpreprocessing=$this->getidpaypmentprepocessing();

                $preprocessing=array
                (
                    'payment_status'=>'Expired',
                    'transaction_id'=>$id,
                    'response'=>serialize($executePayment),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                DB::table('payment_preprocessing')
                    ->WHERE('id',$paymentpreprocessing->id)
                    ->update($preprocessing);
        }
        elseif ($executePayment->getState() == 'pending')
        {
             $paymentpreprocessing=$this->getidpaypmentprepocessing();

                $preprocessing=array
                (
                    'payment_status'=>'Pending',
                    'transaction_id'=>$id,
                    'response'=>serialize($executePayment),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                DB::table('payment_preprocessing')
                    ->WHERE('id',$paymentpreprocessing->id)
                    ->update($preprocessing);
            }
            else
            {
                 Session::flash('success','Payment Made successfully..!!');
                // return redirect()->route('candidatepay.canddidate_payment');
                    return view('employer_frontend/payment/payment_successful');
            }
        // \Session::put('error','Payment failed');
        // return Redirect::route('paypalpayment.paywithpaypal');
    }

    public function getCancel()
    {
        return redirect()->route('candidatepay.canddidate_payment');
    }
    public function getidpaypmentprepocessing()
    {
        return DB::table('payment_preprocessing')->orderBy('id', 'desc')->first();
    }
}