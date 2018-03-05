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
                    <script src="https://checkout-sandbox.getbread.com/bread.js" data-api-key="6e60f090-d169-447d-939b-2cb54941d7aa"></script>
                    <form id="frmApplication" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div id="applicant_information">
                    <div class="col-md-6">
                        <div class="box-header with-border">
                            <h3 class="box-title">  Applicant Personal Information  </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Preferred Language:</label>
                                <select name="preferred_language"  class="form-control select2" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option value="English">English</option>
                                    <option value="Spanish">Spanish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name:</label>
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name:</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Address:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Social Security #:</label>
                                <input type="text" class="form-control" name="ssn" placeholder="XXX-XX-XXXX">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of Birth:</label>
                                <input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Home Phone:</label>
                                <input type="text" class="form-control" name="home_phone" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cell Phone:</label>
                                <input type="text" class="form-control" name="cell_phone" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Work Phone:</label>
                                <input type="text" class="form-control" name="work_phone" placeholder="">
                            </div>
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">  Applicant Current Address  </h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Street #:</label>
                                    <input type="text" class="form-control" name="street_number" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Street Name:</label>
                                    <input type="text" class="form-control" name="street_name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Street Type:</label>
                                    <select name="street_type"  class="form-control select2" style="width: 100%;">
                                        <option value="">Select</option>
                                        <option value="Avenue">Avenue</option>
                                        <option value="Boulevard">Boulevard</option>
                                        <option value="Circle">Circle</option>
                                        <option value="Court">Court</option>
                                        <option value="Cove">Cove</option>
                                        <option value="Crescent">Crescent</option>
                                        <option value="Drive">Drive</option>
                                        <option value="Freeway">Freeway</option>
                                        <option value="Highway">Highway</option>
                                        <option value="Lane">Lane</option>
                                        <option value="Park">Park</option>
                                        <option value="Parkway">Parkway</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Path">Path</option>
                                        <option value="Pike">Pike</option>
                                        <option value="Place">Place</option>
                                        <option value="Plaza">Plaza</option>
                                        <option value="Road">Road</option>
                                        <option value="Square">Square</option>
                                        <option value="Street">Street</option>
                                        <option value="Terrace">Terrace</option>
                                        <option value="Trail">Trail</option>
                                        <option value="Turnpike">Turnpike</option>
                                        <option value="Valley">Valley</option>
                                        <option value="Way">Way</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Apt/St #:</label>
                                    <input type="text" class="form-control" name="apt_number" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City:</label>
                                    <input type="text" class="form-control" name="city" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">State:</label>
                                    <select name="state"  class="form-control select2" style="width: 100%;">

                                        <option value="">Select</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Col</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="FM">Federated State</option>
                                        <option value="GU">Guam</option>
                                        <option value="MH">Marshall Island</option>
                                        <option value="MP">Northern Marian</option>
                                        <option value="PW">Palau</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="UM">U.S. Minor Outl</option>
                                        <option value="VI">Virgin Islands</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country Code:</label>
                                    <select name="country_code"  class="form-control select2" style="width: 100%;">
                                        <option value="USA">USA</option>
                                        <option value="CA">CA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Zip Code:</label>
                                    <input type="text" class="form-control" name="zip" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Housing Type:</label>
                                    <select name="house_type"  class="form-control select2" style="width: 100%;">

                                        <option value="">Select</option>
                                        <option value="Family">Family</option>
                                        <option value="Other">Other</option>
                                        <option value="Own">Own</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Years at Current Address:</label>
                                    <input type="text" class="form-control" name="years_at_address" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Months at Current Address:</label>
                                    <input type="text" class="form-control" name="months_at_address" placeholder="">
                                </div>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right" onclick="return savetodbandrunbread()">Next</button>
                        </div>

                    </div>

                        <div class="row" id="shoppingcart" style="display: none;">
                            <div class="col-md-6">
                                <div class="box-body" id="userview">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Customer Number </label>
                                        <input id="customer_id" type="text" class="form-control" name="customer_id" placeholder="customer number" value="">
                                    </div>
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

                        <div id="bread-checkout-btn" data-bread-default-size="true"></div>
                        <input type="hidden" name="hidden_fullname" id="funame">
                        <input type="hidden" name="hidden_address" id="address">
                        <input type="hidden" name="hidden_address2" id="address2">
                        <input type="hidden" name="hidden_zip" id="zip">
                        <input type="hidden" name="hidden_city" id="city">
                        <input type="hidden" name="hidden_state" id="state">
                        <input type="hidden" name="hidden_phone" id="phone">
                        <input type="hidden" name="hidden_email" id="email">

                    </form>
                </div>


            </section>
            <!-- /.content -->
        </div>


        @include('layouts.contentfooter')
        <div class="control-sidebar-bg"></div>

    <!-- ./wrapper -->
    <script type="text/javascript">
        var items = [];
        var tax = 0;
        function savetodbandrunbread() {
            $.post('savecreditapp', $('#frmApplication').serialize(),
                    function(data) {
                        if(data.error){
                            alert(data.msg);
                        } else if(data.result.source == 'bread') {
                            $('#funame').val(data.result.funame);
                            $('#customer_id').val(data.result.customer_id);
                            $('#address').val(data.result.address);
                            $('#address2').val(data.result.address2);
                            $('#zip').val(data.result.zip);
                            $('#city').val(data.result.city);
                            $('#state').val(data.result.state);
                            $('#phone').val(data.result.phone);
                            $('#email').val(data.result.email);
                            $('#shoppingcart').show();
                            $('#applicant_information').hide();
                        }else if(data.status == 'not supported'){
                            alert(data.msg);
                        }else{
                            // Proper Alert Message for the usser
                            alert('Applicaiton matches Star world credit criteria. No further action required. Please contact finance department for more update');
                        }
                    });
            return false;
        }

        function checkOrder(){
            $.get('getorder', {order_id:$("#storis_order_number").val(),customer_id:$("#customer_id").val()},
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
                                    window.location.href = "{{ url('/creditapp') }}";
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
    </script>
@endsection
