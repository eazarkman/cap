@extends('layouts.page')
@section('content')
       <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Credit Application
                </h1>
            </section>
            <section class="content" id="customer_check">
                <div id="progressive_aggreement" style="display: none">

                </div>
                <div class="box box-primary" id="credit_form_data">
                    <div class="col-md-9">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Customer Number: </label>
                                <input id="customer_number" type="text" class="form-control" name="customer_number" value="" required autofocus>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="orderNumber" style="display: none;">
                                <label for="name" class="col-md-4 control-label">Customer Order Number: </label>
                                <input id="orderNumber" type="text" class="form-control" name="orderNumber" value="" required autofocus>
                            </div>

                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Source </label>
                                    <select class="form-control" name="admin" id="customer_source" onchange="sourceUpdate()">
                                        <!--option value="sw">Starworld</option-->
                                        <option value="bread">Bread</option>
                                        <option value="progressive">Progressive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="prefered_language_container">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Prefered Language </label>
                                    <select class="form-control" name="admin" id="prefered_language">
                                        <option value="english">English</option>
                                        <option value="spanish">Spanish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="col-md-6" id="employment_info" style="display:none;">
                        <div class="box-body">
                            <div class="emp_info form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Employer Name: </label>
                                <input id="EmployerName" type="text" class="form-control" name="EmployerName" value="" required autofocus>
                            </div>
                            <div class="emp_info form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Hire Date </label>
                                    <input id="HireDate" type="text" class="simple-field-data-mask form-control" data-mask="0000-00-00" placeholder="yyyy-mm-dd" name="HireDate" value="" required autofocus>
                                </div>
                            </div>
                            <div class="emp_info form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Monthly Gross Income </label>
                                    <input id="MonthlyGrossIncome" type="text" class="form-control" data-mask="000000000" placeholder="XXXXXXXXX" name="MonthlyGrossIncome" value="" required autofocus>
                                </div>
                            </div>
                            <div class="emp_info form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Last Pay Date </label>
                                    <input id="LastPayDate" type="text" class="simple-field-data-mask form-control" data-mask="0000-00-00" placeholder="yyyy-mm-dd" name="LastPayDate" value="" required autofocus>
                                </div>
                            </div>
                            <div class="emp_info form-group" id="PayFrequency">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">PayFrequency </label>
                                    <select class="form-control" name="admin" id="PayFrequency">
                                        <option value="BI-WEEKLY">BI-WEEKLY</option>
                                        <option value="WEEKLY">WEEKLY</option>
                                        <option value="SEMI-MONTHLY">SEMI-MONTHLY</option>
                                        <option value="MONTHLY">MONTHLY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Social Security Number </label>
                                    <input id="SocialSecurityNumber" type="text" data-mask="000-00-0000" placeholder="XXX-XX-XXXX" class="form-control" name="SocialSecurityNumber" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Birth Date </label>
                                    <input id="BirthDate" type="text" class="form-control" data-mask="0000-00-00" placeholder="yyyy-mm-dd" name="BirthDate" value="" required autofocus>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Bank and Credit card Information -->
                    <div class="col-md-6" id="bank_info" style="display:none;">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Bank Name: </label>
                                <input id="BankName" type="text" class="form-control" name="BankName" value="" required autofocus>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">ABA Routing Number: </label>
                                <input id="ABARoutingNumber" type="text" class="form-control" name="ABARoutingNumber" value="" required autofocus>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Account Number: </label>
                                <input id="AccountNumber" type="text" class="form-control" name="AccountNumber" value="" required autofocus>
                            </div>


                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Account Type </label>
                                    <select class="form-control" name="admin" id="AccountType">
                                        <!--option value="sw">Starworld</option-->
                                        <option value="Checking">Checking</option>
                                        <option value="Savings">Savings</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Date Account Opened: </label>
                                <input id="DateAccountOpened" type="text" class="simple-field-data-mask form-control" data-mask="0000-00-00" placeholder="yyyy-mm-dd" name="DateAccountOpened" value="" required autofocus>
                            </div>
                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">First Six digit of Credit card </label>
                                    <input id="CreditCardBin" type="text" class="form-control" data-mask="000000" placeholder="XXXXXX" name="CreditCardBin" value="" required autofocus>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div style="clear: both;"></div>
                    <div class="box-footer">
                        <button type="submit" id="initial_check_button" class="btn btn-info pull-right" onclick="return checkCustomer()">Check</button>
                    </div>
                </div>

            </section>
            <section class="content" id="checkout" style="display: none">
                <div class="row" style="margin-bottom: 15px;" id="app_id_check">
                    <div class="col-xs-6" style="margin-top: 15px;">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">App Id</label>
                            <div class="col-md-6">
                                <input id="app_id" type="text" class="form-control" name="app_id" value="" required autofocus>
                            </div>
                        </div>
                        <div style="clear: both; padding: 10px;"></div>
                        <div class="form-group">
                            <label for="equity" class="col-md-4 control-label">Source </label>
                            <div class="col-md-6 input-group">
                                <div class="form-group">
                                    <select class="form-control" name="admin" id="source" style="width: 374px;margin-left: 15px;">
                                        <option value="sw">Starworld</option>
                                        <option value="bread">Bread</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both; padding: 10px;"></div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-block btn-info btn-lg" onclick="checkApplication()">Check App Status</button>
                        </div>
                    </div>
                </div>

                <div class="row" id="shoppingcart" style="display: none;">
                    <div class="col-md-6">
                        <div class="box-body" id="userview">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Storis Order Number </label>
                                <input id="storis_order_number" type="text" class="form-control" name="storis_order_number" placeholder="Storis Order Number" value="">
                            </div>
                            <div style="clear: both;padding: 5px;"></div>
                            <div style="clear: both;padding: 5px;"></div>
                            <div class="col-xs-4" id="storis_order_btn">
                                <button type="button" class="btn btn-block btn-info btn-lg" onclick="checkOrder()">Get Order</button>
                            </div>
                            <div class="col-xs-6"  id="continue_checkout" style="display: none">
                                <button type="button" class="btn btn-block btn-info btn-lg" onclick="getBreadCheckout()">Continue to Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Production API for bread -->
                <!--script src="https://checkout.getbread.com/bread.js" data-api-key="02f47c08-5340-4965-b107-e62535231605"></script-->
                <!-- Sandbox API for bread -->
                <script src="https://checkout-sandbox.getbread.com/bread.js" data-api-key="6e60f090-d169-447d-939b-2cb54941d7aa"></script>
                <form id="bread-checkout-form" action="{{ url('/confirm') }}" method="POST">
                    {{ csrf_field() }}
                    <div id="bread-checkout-btn" data-bread-default-size="true"></div>
                    <input type="hidden" name="fullname" id="funame">
                    <input type="hidden" name="address" id="address">
                    <input type="hidden" name="address2" id="address2">
                    <input type="hidden" name="zip" id="zip">
                    <input type="hidden" name="city" id="city">
                    <input type="hidden" name="state" id="state">
                    <input type="hidden" name="phone" id="phone">
                    <input type="hidden" name="email" id="email">
                    <input type="hidden" name="first_name" id="first_name">
                    <input type="hidden" name="last_name" id="last_name">
                </form>
            </section>
            <!-- /.content -->
        </div>
       <div id="register_link" style="display:none"></div>
       <div id="registerloading">
           <img src="dist/img/ajax-loader.gif" class="user-image" alt="User Image">
       </div>
       <style>
           #register_link{top:0;right:0;width:100%;height:100%;position:fixed;z-index:9998;text-align:center;filter: progid:DXImageTransform.Microsoft.Alpha(opacity=80);-moz-opacity:.8;-khtml-opacity:.8;opacity:.8;background-color:#000}
           #registerloading{background: #fff;display:none;position:fixed;top:40%;left:42%;z-index:9999;margin: -70px 0 0 -150px;text-align: center;width: 780px;padding: 20px 10px;font-weight: 700;line-height: 1.2em;border-radius: 6px;-moz-border-radius: 6px;-webkit-border-radius: 6px;}
           #registerloading .ajx-loading{width: 36px;display: block;margin: 0 auto 20px;}</style>

       @include('layouts.contentfooter')
        <div class="control-sidebar-bg"></div>
    <!-- ./wrapper -->
       <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
       <script type="text/javascript" src="dist/js/jquery.mask.js"></script>
       <script type="text/javascript">
           $(function () {
               //Date picker
               $('#HireDate').datepicker({
                   autoclose: true,
                   changeMonth: true,
                   changeYear: true,
               });

               $('#BirthDate').datepicker({
                   autoclose: true,
                   changeMonth: true,
                   changeYear: true,
               });
               $('#DateAccountOpened').datepicker({
                   autoclose: true,
                   changeMonth: true,
                   changeYear: true,
               });


               $('#LastPayDate').datepicker({
                   autoclose: true,
                   changeMonth: true,
                   changeYear: true,
               });
           })
           var items = [];
           var tax = 0;
           function checkOrder(){
               $.get('getorder', {order_id:$("#storis_order_number").val(),customer_id:$("#customer_number").val()},
                       function(data) {
                           if(data.success){
                               items = data.orderInfo.items;
                               tax = data.orderInfo.tax;
                               $("#storis_order_btn").hide('slow');
                               $("#continue_checkout").show('slow');
                           }else{
                               alert(data.msg);
                           }
                       });
               return false;
           }

           function checkApplication() {
               $.get('checkapp', {appnumber: $("#app_id").val(),source: $("#source").val()},
                       function(data) {
                           if(data.status=='not found'){
                               alert('No Application Found !!');
                           } else if(data.source == 'bread') {
                               $('#funame').val(data.funame);
                               $('#address').val(data.address);
                               $('#address2').val(data.address2);
                               $('#zip').val(data.zip);
                               $('#city').val(data.city);
                               $('#state').val(data.state);
                               $('#phone').val(data.phone);
                               $('#email').val(data.email);
                               $('#shoppingcart').show();
                           }else if(data.status == 'not supported'){
                               alert(data.msg);
                           }else if(data.additional_info){
                               jQuery("#employment_info").show('slow');
                               jQuery("#bank_info").show('slow');
                               jQuery("#orderNumber").show('slow');
                               jQuery("#initial_check_button").attr('onclick','return runprogressive()');
                           }else{
                               // Proper Alert Message for the usser
                               alert('Applicaiton matches Star world credit criteria. No further action required. Please contact finance department for more update');
                           }
                        });
           }
          function getBreadCheckout() {
              if(items.length>0) {
                  var opts = {
                      buttonId: 'bread-checkout-btn',
                      actAsLabel: false,
                      asLowAs: true,
                      items: items,
                      billingContact: {
                          fullName: $('#funame').val(),
                          address: $('#address').val(),
                          address2: $('#address2').val(),
                          zip: $('#zip').val(),
                          city: $('#city').val(),
                          state: $('#state').val(),
                          phone: $('#phone').val(),
                          email: $('#email').val()
                      }
                  };
                  opts.calculateTax = function(shippingContact, callback) {
                      var total = parseFloat(parseFloat(tax)*100);
                      callback(null, total);
                  };
                  opts.onCustomerClose = function(err, custData) {
                      if (err !== null) {
                          console.error("An error occurred getting customer close data.");
                          return;
                      }
                      var customerEmail = custData.email;
                      var qualState     = custData.state;
                      switch (qualState) {
                          case 'PREQUALIFIED':
                              console.log(customerEmail + " was prequalified for financing.");
                              break;
                          case 'PARTIALLY_PREQUALIFIED':
                              console.log(customerEmail + " was partially prequalified for financing.");
                              break;
                          case 'NOT_PREQUALIFIED':
                              console.log(customerEmail + " was not prequalified for financing."); // Here to add conditional check to send this applicaiton to Progressive
                              jQuery("#employment_info").show('slow');
                              jQuery("#bank_info").show('slow');
                              jQuery("#orderNumber").show('slow');
                              jQuery("#initial_check_button").attr('onclick','return runprogressive()');
                              break;
                          case 'ABANDONED':
                              if (customerEmail === undefined || customerEmail === null) {
                                  console.log("Unknown customer abandoned their prequalification attempt.");
                              } else {
                                  console.log(customerEmail + " abandoned their prequalification attempt.");
                              }
                              break;
                      }
                  }
                  opts.done = function(err, tx_token) {
                      if (err) {
                          alert("There was an error: " + err);
                          return;
                      }
                      if (tx_token !== undefined) {
                          $.get('authorizebread', {order_id:$("#storis_order_number").val(),transaction_id:tx_token},
                                  function(data) {
                                      if(data.success){
                                          alert(data.message)
                                      }else{
                                          alert(data.message);
                                      }
                                      window.location.href = "{{ url('/sales') }}";
                                  });
                          return false;
                      }
                      return;
                  };
                  bread.checkout(opts);

              }else{
                  alert("Please atleast one item to cart before checkout");
              }
          }

          function showcustomernumber() {
              if($("#existing_customer").val()=='yes'){
                  $("#customerNumber").show('slow');
                  $("#credit_source").show('slow');
              }else{
                  $("#customer_check").hide();
                  $("#credit_application").show();
              }
          }
          function checkCustomer() {
              $("#register_link").show();
              $("#registerloading").show();
              $.get('checkapp', {customer_id: $("#customer_number").val(),source: $("#customer_source").val(),language: $("#prefered_language").val()},
                      function(data) {
                          $("#register_link").hide();
                          $("#registerloading").hide();
                          if(data.status=='not found'){
                              alert('No Application Found !!');
                          } else if (data.showapplicaiton){
                              alert('No Data found for the customer number please fill our new application');
                              $("#customer_check").hide();
                              $("#credit_application").show();
                          }else if(data.source == 'bread') {
                              $("#checkout").show();
                              $("#app_id_check").hide();
                              $('#funame').val(data.funame);
                              $('#address').val(data.address);
                              $('#address2').val(data.address2);
                              $('#zip').val(data.zip);
                              $('#city').val(data.city);
                              $('#state').val(data.state);
                              $('#phone').val(data.phone);
                              $('#email').val(data.email);
                              $('#shoppingcart').show();
                          }else if(data.status == 'not supported'){
                              alert(data.msg);
                          }else if(data.additional_info){
                              jQuery("#employment_info").show('slow');
                              jQuery("#bank_info").show('slow');
                              /*if(!data.employer_info){
                                  $(".emp_info").hide();
                              }*/
                              jQuery("#orderNumber").show('slow');
                              jQuery("#initial_check_button").attr('onclick','return runprogressive()');
                          }else{
                              // Proper Alert Message for the usser
                              alert('Applicaiton matches Star world credit criteria. No further action required. Please contact finance department for more update');
                          }
                      });
          }
          function sourceUpdate() {
              if(jQuery("#customer_source").val() == 'progressive'){
                   //jQuery("#employment_info").show('slow');
                   //jQuery("#bank_info").show('slow');
                   //jQuery("#orderNumber").show('slow');
                   //jQuery("#initial_check_button").attr('onclick','return runprogressive()');
              }
          }

           function runprogressive(){
               $("#register_link").show();
               $("#registerloading").show();
               var request = {
                    customer_id: $("#customer_number").val()
                   ,source: $("#customer_source").val()
                   ,language: $("#prefered_language").val()
                   ,orderNumber : $("#orderNumber").val()
                   ,EmployerName : $("#EmployerName").val()
                   ,HireDate : $("#HireDate").val()
                   ,MonthlyGrossIncome : $("#MonthlyGrossIncome").val()
                   ,LastPayDate : $("#LastPayDate").val()
                   ,PayFrequency : $("#PayFrequency").val()
                   ,BankName : $("#BankName").val()
                   ,ABARoutingNumber : $("#ABARoutingNumber").val()
                   ,AccountNumber : $("#AccountNumber").val()
                   ,AccountType : $("#AccountType").val()
                   ,DateAccountOpened : $("#DateAccountOpened").val()
                   ,NumberOfNSFees : $("#NumberOfNSFees").val()
                   ,NumberOfOverDraftFees : $("#NumberOfOverDraftFees").val()
                   ,SocialSecurityNumber : $("#SocialSecurityNumber").val()
                   ,BirthDate : $("#BirthDate").val()
                   ,CreditCardBin : $("#CreditCardBin").val()
               }
               $.get('runprogressive', request,
                   function(data) {
                        if(data.success){
                            $("#progressive_aggreement")
                                    .html('<object data="'+data.result.EsignURL+'" height="600px" width="100%"/>');
                            $("#progressive_aggreement").show('slow')
                            $("#credit_form_data").hide('slow')
                            $("#register_link").hide();
                            $("#registerloading").hide();
                        }else{
                            $("#register_link").hide();
                            $("#registerloading").hide();
                            alert(data.msg);
                        }
                   });
           }
       </script>
@endsection
