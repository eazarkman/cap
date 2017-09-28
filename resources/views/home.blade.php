@extends('layouts.page')

@section('content')
    @include('layouts.left')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <div id="chartContainer" style="height: 300px; width: 100%;">
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </section>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
                    {

                        title:{
                            text: "Current Month Sales",
                            fontSize: 30
                        },
                        animationEnabled: true,
                        axisX:{

                            gridColor: "Silver",
                            tickColor: "silver",
                            valueFormatString: "DD/MMM"

                        },
                        toolTip:{
                            shared:true
                        },
                        theme: "theme2",
                        axisY: {
                            gridColor: "Silver",
                            tickColor: "silver"
                        },
                        legend:{
                            verticalAlign: "center",
                            horizontalAlign: "right"
                        },
                        // Fill this data with actual number if needed
                        data: [
                            {
                                type: "line",
                                showInLegend: true,
                                lineThickness: 2,
                                name: "Cash Sale",
                                markerType: "square",
                                color: "#F08080",
                                dataPoints: [
                                    { x: new Date(2010,0,3), y: 650 },
                                    { x: new Date(2010,0,5), y: 700 },
                                    { x: new Date(2010,0,7), y: 710 },
                                    { x: new Date(2010,0,9), y: 658 },
                                    { x: new Date(2010,0,11), y: 734 },
                                    { x: new Date(2010,0,13), y: 963 },
                                    { x: new Date(2010,0,15), y: 847 },
                                    { x: new Date(2010,0,17), y: 853 },
                                    { x: new Date(2010,0,19), y: 869 },
                                    { x: new Date(2010,0,21), y: 943 },
                                    { x: new Date(2010,0,23), y: 970 },
                                    { x: new Date(2010,0,24), y: 853 },
                                    { x: new Date(2010,0,25), y: 869 },
                                    { x: new Date(2010,0,26), y: 943 },
                                    { x: new Date(2010,0,27), y: 970 }
                                ]
                            },
                            {
                                type: "line",
                                showInLegend: true,
                                name: "Credit Sale",
                                color: "#20B2AA",
                                lineThickness: 2,

                                dataPoints: [
                                    { x: new Date(2010,0,3), y: 510 },
                                    { x: new Date(2010,0,5), y: 560 },
                                    { x: new Date(2010,0,7), y: 540 },
                                    { x: new Date(2010,0,9), y: 558 },
                                    { x: new Date(2010,0,11), y: 544 },
                                    { x: new Date(2010,0,13), y: 693 },
                                    { x: new Date(2010,0,15), y: 657 },
                                    { x: new Date(2010,0,17), y: 663 },
                                    { x: new Date(2010,0,19), y: 639 },
                                    { x: new Date(2010,0,21), y: 673 },
                                    { x: new Date(2010,0,23), y: 660 },
                                    { x: new Date(2010,0,24), y: 853 },
                                    { x: new Date(2010,0,25), y: 869 },
                                    { x: new Date(2010,0,26), y: 943 },
                                    { x: new Date(2010,0,27), y: 970 }
                                ]
                            }


                        ],
                        legend:{
                            cursor:"pointer",
                            itemclick:function(e){
                                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                    e.dataSeries.visible = false;
                                }
                                else{
                                    e.dataSeries.visible = true;
                                }
                                chart.render();
                            }
                        }
                    });

            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection
