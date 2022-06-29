@extends('layouts.subscribelayout')

@section('content')
    <section id="services">
        @if(session()->has('notice'))
            <div class="alert alert-success">
                {{ session()->get('notice') }}
            </div>
        @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

{{--            <div style="float: right;  position: -webkit-sticky; position: sticky; top:0;">--}}
{{--                <img id="subscribe_how_to_img" src="{{ URL::asset('images/How_to_pay_subscribe_page.jpeg') }}" alt="Mpesa">--}}
{{--            </div>--}}
        <div class="content-box">
            <div style="text-align: center; color: #456AC8; text-transform: uppercase;" class="content-title wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
                <h3>Subscription payments</h3>
                <div class="content-title-underline"></div>
                <img id="subscribe_how_to_img" src="{{ URL::asset('images/How_to_pay_subscribe_page.jpeg') }}" alt="Mpesa">

            </div>
            <div class="container">
                <div class="top_container">
                <div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="user_name">
                            <h5>Hello <b>{{ Auth::user()->name }} ,</b></h5>
                        <br>

                            <h6 style="color: red">Your subscription to prime securities premium content has expired.</h6>
                    <br>
                        Which means you lose access to our premium services which among others includes:

                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-pencil fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Access to our regular updates on the market
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-line-chart fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Weekly and monthly analysis on gainers & losers
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-bar-chart fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Analysis of the listed companies
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-lightbulb-o fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Access to buy/sell recommendations
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-info fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Supplement the information you get from your broker
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa-usd fa-2x"></i>
                            </div>
                            <div class="service-item-title">

                            </div>
                            <div class="service-item-desc">
                                Guide you on the basics of investing in the stock market
                            </div>
                        </div>
                    </div>



                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="top_container">
    <div class="content-title wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
        <div style = "margin-top: 7%; text-align: center; color: #456AC8; text-transform: uppercase;">
        <h4>Add Funds to your Primesecurities account</h4>
        </div>
        <div class="content-title-underline"></div>
    </div>

        <div class="payment_header">
            <h6>1) Payment Method</h6>
        </div>

        <div class="payment_methods_container">
            <div>
            <div id="mpesa_radio_button">
                <label><input type="radio" class="payment_method" id="mpesa" name="p_method" value="Mpesa" checked="checked" autocomplete="off" >
                    Mpesa
                </label>
            </div>
            <div id="paypal_radio_button">
                <label><input type="radio" class="payment_method" id="paypal" name="p_method" value="Paypal" autocomplete="off" >
                    Paypal
                </label>
            </div>
            </div>

            <div>
            <div id = "mpesa_currency">
                  <select name="mpesa_c" id="mpesa_c">
                    <option value="0">Select Payment Currency:</option>
                    <option value="1">KES-------Kshs</option>
                </select>
        </div>
        <div id = "paypal_currency">

              <select name="paypal_c" id="paypal_c">
                <option value="0">Select Payment Currency:</option>
                <option value="1">USD---------US Dollar</option>
                <option value="2">GBP---------British Pound</option>
                <option value="3">EUR---------Euro</option>
            </select>

    </div>
            </div>


            <div>
    <div id="mpesa_logo">
        <div>
        <img src="{{ URL::asset('images/mpesa.png') }}" alt="Mpesa">
    </div>

</div>
    <div id="paypal_logo">
        <img src="{{ URL::asset('images/paypal_logo.png') }}" alt="Paypal">
        <h4 style="color: red;">Coming Soon</h4>

    </div>
            </div>


</div>
</div>


    <div style="text-align: center; color: #456AC8; text-transform: uppercase;" class="content-title wow animated zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                    <h3>Our Packages</h3>
                    <div class="content-title-underline"></div>
                </div>






    <div class="content-wrapper">
        <!-- Row start -->

            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="pricing-plan">
                    <div class="pricing-header">

                        <div class="services-title">Services we offer</div>

                    </div><ul class="pricing-features">
                                                    <li>
                                                        Access to our regular updates on the market

                                                    </li>
                                                    <li>
                                                        Weekly and monthly analysis on gainers & losers

                                                    </li>
                                                    <li>
                                                        Analysis of the listed companies

                                                    </li>
                                                    <li>
                                                        Access to buy/sell recommendations

                                                    </li>
                                                    <li>
                                                        Access to articles

                                                    </li>
                                                    <li>
                                                        General opinions on the market

                                                    </li>
                                                    <li>
                                                        Supplement the information you get from your broker

                                                    </li>
                                                    <li>
                                                        Discussions on your portfolio

                                                    </li>
                                                    <li>
                                                        Facilitate opening of a CDS account for those without

                                                    </li>
                                                    <li>
                                                        Guide you on the basics of investing in the stock market

                                                    </li>
                                                    <li>
                                                        Unlimited Q & A on the market via whatsapp or zoom

                                                    </li>
                    </ul>


                    <div class="pricing-footer">
                       <div class="package_info">
                           <h4 class="pricing-title">1 Month</h4>
                           <div class="pricing-cost" id="price">Ksh. 1500</div>
                       </div>
                        <div>
                        <a style="" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mpesaModal" onclick="inputPackageOrdered('1500')">Select Plan</a>
                        </div>
                    </div>

                    <div class="content-title-underline"></div>

                    <div class="pricing-footer">
                        <div class="package_info">
                            <h4 class="pricing-title">6 Months</h4>
                            <div class="pricing-cost" id="price">Ksh. 7500</div>
                        </div>
                        <div>
                            <a style="" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mpesaModal" onclick="inputPackageOrdered('7500')">Select Plan</a>
                        </div>
                    </div>

                    <div class="content-title-underline"></div>

                    <div class="pricing-footer">
                        <div class="package_info">
                            <h4 class="pricing-title">12 Months</h4>
                            <div class="pricing-cost" id="price">Ksh. 12000</div>
                        </div>
                        <div>
                            <a style="" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mpesaModal" onclick="inputPackageOrdered('12000')">Select Plan</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>




<!-- Modal -->
<div class="modal fade" id="mpesaModal" tabindex="-1" role="dialog" aria-labelledby="mpesaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productsModalLabel">Subscription payments via Mpesa Online</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="initiateMpesaForm" id="initiateMpesaForm" class="needs-validation" action="{{url('subscribe')}}" method="POST"  novalidate>
          @csrf
            <div class="form-group">
            <label for="payment">Package type(in months)</label>
            <input readonly  type="text" id="payment" name="payment" aria-describedby="paymentHelp">
          </div>

                    <div class="form-group">
            <label for="phone">Amount to pay</label>
            <input readonly  type="text" id="amount" name="amount" aria-describedby="amountHelp">
          </div>

                      <div class="form-group">
            <label for="subject">Mpesa Number</label>
            <input readonly  type="text" value="{{ Auth::user()->phone_number }}"  id="mpesa_number" name="mpesa_number">
          </div>

          <button type="submit" class="btn btn-primary" name="submit" value="Submit Form" >Submit</button>
         <!--  <input type="submit" name="submit" value="Submit Form"> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



{{--        <div >{!! $post->body !!}</div>--}}
<!-- AddToAny BEGIN -->
<div v-show="shareIcons == post.uid" class="a2a_kit a2a_kit_size_32 a2a_default_style"  v-bind:data-a2a-url="url" v-bind:data-a2a-title="title">
    <a class="a2a_button_facebook"></a>
    <a class="a2a_button_twitter"></a>
    <a class="a2a_button_email"></a>
    <a class="a2a_button_whatsapp"></a>
    <a class="a2a_button_telegram"></a>
    <a class="a2a_button_google_gmail"></a>
    <a class="a2a_button_linkedin"></a>
</div>
<!-- AddToAny END -->
<div>
    <div class="fb-comments" data-numposts="5" data-width=""></div>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script>
    $('.payment_method').on('change',function(){
if($('#mpesa').is(':checked')){
$("#paypal_logo").hide();
$("#paypal_currency").hide();
$("#mpesa_logo").show();
$("#mpesa_currency").show();
}
if($('#paypal').is(':checked')){
$("#mpesa_logo").hide();
$("#mpesa_currency").hide();
$("#paypal_logo").show();
$("#paypal_currency").show();
}
})
</script>
<script>
    window.onload = function(){
    $('.payment_method').reset();
}
    </script>

    <script>
        function inputPackageOrdered(v){
    document.getElementById('price').value = v;
        if (v === '1500'){
            $('#payment').val('1');
        }
        else if (v === '7500'){
            $('#payment').val('6');
        }
        else if (v === '12000'){
            $('#payment').val('12');
        }
    $('#amount').val(v);
}

    </script>

</div>
@endsection
