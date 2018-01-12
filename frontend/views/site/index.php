               

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Dashboard</h1>                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body" >
                            
                            <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['current_level'] ?></strong></h4>
                                                <span>User Level</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['current_user'] ?></strong></h4>
                                                <span>Total User</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['user_remning'] ?></strong></h4>
                                                <span>Remaning User</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['current_stock'] ?></strong></h4>
                                                <span>Current Stock</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End .row -->    
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['current_profit'] ?></strong></h4>
                                                <span>PROFIT</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['total_order'] ?></strong></h4>
                                                <span>Total Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['pending_order'] ?></strong></h4>
                                                <span>Pending Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
                                            <div class="stats">
                                                <h4><strong><?= $all_status['approved_order'] ?></strong></h4>
                                                <span>Approved Order</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End .row -->   
                                <div class="row">

                                    <div class="col-md-3 col-sm-5 col-xs-12">

                                        <div class="r1_graph1 db_box">
                                            <span class='bold'>98.95%</span>
                                            <span class='pull-right'><small>SERVER UP</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_dynamicbar">Loading...</span>
                                        </div>


                                        <div class="r1_graph2 db_box">
                                            <span class='bold'>2332</span>
                                            <span class='pull-right'><small>USERS ONLINE</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_linesparkline">Loading...</span>
                                        </div>


                                        <div class="r1_graph3 db_box hidden-xs">
                                            <span class='bold'>342/123</span>
                                            <span class='pull-right'><small>ORDERS / SALES</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_compositebar">Loading...</span>
                                        </div>

                                    </div>



                                    <div class="col-md-9 col-sm-7 col-xs-12">
                                        <div class="r1_maingraph db_box">
                                            <span class='pull-left'>
                                                <i class='icon-purple fa fa-square icon-xs'></i>&nbsp;<small>PAGE VIEWS</small>&nbsp; &nbsp;<i class='fa fa-square icon-xs icon-primary'></i>&nbsp;<small>UNIQUE VISITORS</small>
                                            </span>
                                            <span class='pull-right switch'>
                                                <i class='icon-default fa fa-line-chart icon-xs'></i>&nbsp; &nbsp;<i class='icon-secondary fa fa-bar-chart icon-xs'></i>&nbsp; &nbsp;<i class='icon-secondary fa fa-area-chart icon-xs'></i>
                                            </span>

                                            <div id="db_morris_line_graph" style="height:272px;width:95%;"></div>
                                            <div id="db_morris_area_graph" style="height:272px;width:90%;display:none;"></div>
                                            <div id="db_morris_bar_graph" style="height:272px;width:90%;display:none;"></div>
                                        </div>
                                    </div>

                             

                                </div> <!-- End .row -->


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="wid-vectormap">
                                            <h4>Visitor's Statistics</h4>
                                            <div class="row">
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <figure>
                                                        <div id="db-world-map-markers" style="width: 100%; height: 300px"></div>        
                                                    </figure>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-12 map_progress">
                                                    <h4>Unique Visitors</h4>
                                                    <span class='text-muted'><small>Last Week Rise by 62%</small></span>
                                                    <div class="progress"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div></div>
                                                    <br>
                                                    <h4>Registrations</h4>
                                                    <span class='text-muted'><small>Up by 57% last 7 days</small></span>
                                                    <div class="progress"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%"></div></div>
                                                    <br>
                                                    <h4>Direct Sales</h4>
                                                    <span class='text-muted'><small>Last Month Rise by 22%</small></span>
                                                    <div class="progress"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%"></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      

                                 

                                        </div>
                                        <!-- 
                                                                        <div class="r2_counter1 db_box">
                                                                                counter 1
                                                                        </div>
                                        
                                                                        <div class="r2_counter2 db_box">
                                                                                counter 2
                                                                        </div> -->

                                    </div>      

                                </div> <!-- End .row -->








                                


                            </div>
                        </section></div>



               