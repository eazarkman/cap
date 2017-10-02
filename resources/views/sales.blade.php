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
            <section class="content">
                <div class="row" style="margin-bottom: 15px;">
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
                    <div class="box-body" id="userview">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div style="clear: both;padding: 5px;"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">SKU</label>
                            <div class="col-md-6">
                                <input type="text" id="sku" placeholder="SKU">
                            </div>
                        </div>
                        <div style="clear: both;padding: 5px;"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Price</label>
                            <div class="col-md-6">
                                <input type="text" id="price" placeholder="Price">
                            </div>
                        </div>
                        <div style="clear: both;padding: 5px;"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Quantity</label>
                            <div class="col-md-6">
                                <input type="text" id="quantity" placeholder="Quantity">
                            </div>
                        </div>
                        <div style="clear: both;padding: 5px;"></div>
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-block btn-info btn-lg" onclick="addrow()">Add To Cart</button>
                        </div>
                        <div style="clear: both;padding: 10px;"></div>
                        <table id="cartItems" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-block btn-info btn-lg" onclick="deleteRow()">Remove From Cart</button>
                        </div>
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-block btn-info btn-lg" onclick="getBreadCheckout()">Checkout</button>
                        </div>
                    </div>
                </div>

                <script src="https://checkout-sandbox.getbread.com/bread.js" data-api-key="6e60f090-d169-447d-939b-2cb54941d7aa"></script>
                <form id="bread-checkout-form" action="/confirm" method="POST">
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
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    <!-- ./wrapper -->
       <script type="text/javascript">
           var items = [];
           function addrow() {
                   var record_id = items.length;
                   var name = $("#name").val();
                   var sku = $("#sku").val();
                   var price = $("#price").val();
                   var qty = $("#quantity").val();
               // TODO :: Add More Validation for the cart here
                   if(name != '' &&
                      sku != '' &&
                      price != '' &&
                      qty != '' &&
                      $.isNumeric(price)&&
                      $.isNumeric(qty)
                     )
                   {
                       var markup = "<tr><td><input type='checkbox' name='record' value='" + record_id + "'></td><td>" + name + "</td><td>" + sku + "</td><td>" + price + "</td><td>" + qty + "</td></tr>";
                       $("table#cartItems tbody").append(markup);
                       items.push({
                           name: name,
                           price: parseFloat(price),
                           sku: sku,
                           quantity: parseFloat(qty),
                           detailUrl : '[REPLACEMEWITHAREALURL]'
                       })
                   }else{
                       alert("All the item values should be filled and price and quantity should be positive numbers")
                   }
               };
                function deleteRow(){
                    var strconfirm = confirm("Are you sure you want to delete?");
                    if (strconfirm == true) {
                        // Find and remove selected table rows
                        $("table#cartItems tbody").find('input[name="record"]').each(function () {
                            if ($(this).is(":checked")) {
                                items.splice($(this).val(), 1);
                                $(this).parents("tr").remove();
                            }
                        });
                    }
               };

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
                  console.log(opts);
                  bread.checkout(opts);
              }else{
                  alert("Please atleast one item to cart before checkout");
              }
          }


       </script>
@endsection
