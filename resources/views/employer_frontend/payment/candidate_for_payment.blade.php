@include('layouts.app')
<div class="container">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light ">
@if(Session::has('error'))
<div class="custom-alerts alert alert-danger fade in">
{{Session::get('error')}}
</div>
@endif
@if(Session::has('success'))
 <div class="custom-alerts alert alert-success fade in">
{{Session::get('success')}}
</div>
@endif
<?php //Session::forget('zero'); ?>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Candidate Name<?php Session::get('error');?></th>
                    <th>Hire Date</th>
                    <th>Total Placement Fee</th>
                    <th>Remaining Placement Fee</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody id="tbody_filter">

            @foreach($users as $user)

            <?php  $paid=app(App\Http\Controllers\employer_frontend\PaymentController::class)->getremainfees($user->payment_base_id); 

              $paymentcount=app(App\Http\Controllers\employer_frontend\PaymentController::class)->getpaymentcount($user->payment_base_id);
                $payment_due=0;

            ?>

          
                <tr>

                 <td>{{$user->c_F}}&nbsp;{{$user->c_L}}</td>
                 <td>{{date('m/d/Y', strtotime($user->hiredate))}}</td>
                 <td>{{$user->payment}}</td>
                 @if($paid==0)

                 <?php $paymentremain=$user->payment;?>
                 <?php 

                    if($user->paymentsetting=='I')
                    {

                       $cal_installment=$user->payment/3;
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
                    $final_remain_payment=$user->payment-$payment_due;
   
                    ?>
                    <td>{{$user->payment}}</td>
                 @else

                    <?php $paymentremain=$user->payment-$paid;?>
                    <?php 

                    if($user->paymentsetting=='I')
                    {
                      if($paymentcount==1)
                      {
                       $cal_installment=$user->payment/3;
                        $cal_installment=floor($cal_installment);

                      }
                     else
                     {
                        $cal_installment=$user->payment-$paid;
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
                    $final_remain_payment=$user->payment-$payment_due;
                    ?>

                    <td>{{$user->payment-$paid}}</td>
                 @endif
                 <td><button>
                 Make Payment
                 </button></td>
                </tr>
                @endforeach
            </tbody>             
        </table>
    </div>
</div>