<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>
    <section class="content">
        <?php echo $dashboard_alert_file_install; ?>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today's Order</span>
                        <span class="info-box-number"><?php echo $todayorder ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-signal"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today's Sale</span>
                        <span class="info-box-number"><?php echo $todaysale->totalAmt+$todaysale->totalShip ?></span>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-hand-right"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Orders</span>
                        <span class="info-box-number"><?php echo $totalorder ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Active Products</span>
                        <span class="info-box-number"><?php echo $activeproducts ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12 ">
                <div class="info-box">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center" colspan='4'>Populer Products</th>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>   
                            <?php foreach($populerproducts as $populerproduct){ ?>
                            <tr>
                                <td><a href="<?php echo base_url('admin/products/create/'.$populerproduct->id)?>"><?php echo $populerproduct->title ?></a></td>
                                <td><img src="<?php echo getThumb($populerproduct->image) ?>" /></td>
                                <td><?php echo $populerproduct->price ?></td>
                                <td><?php echo $populerproduct->qty ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
               </div>
            </div>
            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12 ">
                <div class="info-box">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center" colspan='4'>Out of Stock Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>   
                            <?php foreach($outofstock as $out){ ?>
                            <tr>
                                <td><a href="<?php echo base_url('admin/products/create/'.$out->id)?>"><?php echo $out->title ?></a></td>
                                <td><img src="<?php echo getThumb($populerproduct->image) ?>" /></td>
                                <td><?php echo $out->price ?></td>
                                <td><?php echo $out->qty ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="info-box">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center" colspan='5'> Recent Orders </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Invoice Id</th>
                                <th>Order No</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                            </tr>
                            <?php foreach($recentorder as $recent){ ?>
                            <tr>
                                <td><?php echo $recent->invoice_id ?></td>
                                <td><a href="<?php echo base_url('admin/orders/viewdetails/'.$recent->id)?>"><?php echo $recent->order_no ?></a></td>
                                <td><?php echo $recent->ord_total_amount ?></td>
                                <td><?php echo $recent->order_method ?></td>
                                <td><?php echo $recent->order_date ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </section>
</div>
