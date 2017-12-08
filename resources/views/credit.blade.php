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
                <div class="box box-primary">
                    <div class="col-md-6">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="customerNumber">
                                <label for="name" class="col-md-4 control-label">Customer Number: </label>
                                <input id="customer_number" type="text" class="form-control" name="customer_number" value="" required autofocus>
                            </div>
                            <div class="form-group" id="credit_source">
                                <div class="form-group">
                                    <label for="equity" class="col-md-4 control-label">Source </label>
                                    <select class="form-control" name="admin" id="customer_source" disabled="disabled">
                                        <!--option value="sw">Starworld</option-->
                                        <option value="bread">Bread</option>
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
                    <div style="clear: both;"></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right" onclick="return checkCustomer()">Check</button>
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
                <script src="https://checkout.getbread.com/bread.js" data-api-key="02f47c08-5340-4965-b107-e62535231605"></script>
                <!-- Sandbox API for bread -->
                <!--script src="https://checkout-sandbox.getbread.com/bread.js" data-api-key="6e60f090-d169-447d-939b-2cb54941d7aa"></script-->
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
                </form>
            </section>
            <!-- /.content -->
        </div>
        @include('layouts.contentfooter')
        <div class="control-sidebar-bg"></div>
    <!-- ./wrapper -->
       <script type="text/javascript">
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
              $.get('checkapp', {customer_id: $("#customer_number").val(),source: $("#customer_source").val(),language: $("#prefered_language").val()},
                      function(data) {
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
                          }else{
                              // Proper Alert Message for the usser
                              alert('Applicaiton matches Star world credit criteria. No further action required. Please contact finance department for more update');
                          }
                      });
          }
       </script>
@endsection
