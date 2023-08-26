<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('invoice/bootstrap.min.css')}}">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('invoice/style.css')}}">
    <!-- Font Awesome -->
    <script src="{{asset('invoice/fontAwesome.js')}}"></script>
</head>
<body>
<div class="invoice-1 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row g-0">
                                <h1 class="text-center inv-header-1 invoice_text">Invoice</h1>
                                <div class="col-6">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <h2>Tiles</h2>
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-6 invoice-id">
                                    <div class="info">
                                        <h1 class="color-white inv-header-1 invoice_text_none">Invoice</h1>
                                        <p class="color-white mb-1">Invoice <span>#{{$invoice->invoice_no}}</span></p>
                                        <p class="color-white mb-0">Date <span>{{date('d-m-Y', strtotime($invoice->created_at))}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-6">
                                    <div class="invoice-number mb-30">
                                        <h4 class="inv-title-1">Invoice To</h4>
                                        <h2 class="name mb-10">{{$invoice->customer->name}}</h2>
                                        <p class="invo-addr-1">
                                            {{$invoice->customer->phone}} <br>
                                            {{$invoice->customer->address}} <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invoice-number mb-30">
                                        <div class="invoice-number-inner">
                                            <h4 class="inv-title-1">Invoice From</h4>
                                            <h2 class="name mb-10">Creative Tilescapes</h2>
                                            <p class="invo-addr-1">
                                                creative@tilescapes.com <br>
                                                Dhaka 1216, Bangladesh <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table mb-0 table-striped invoice-table">
                                    <thead class="bg-active">
                                    <tr class="tr">
                                        <th>No.</th>
                                        <th class="text-center">Product Code</th>
                                        <th class="text-center">Product Model</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="tr">
                                        <td>
                                            <div class="item-desc-1">
                                                <span>01</span>
                                            </div>
                                        </td>
                                        <td class="text-center">{{$invoice->product->product_code}}</td>
                                        <td class="text-center">{{$invoice->product->model_no}}</td>
                                        <td class="text-center">৳{{$invoice->product->unit_price}}</td>
                                        <td class="text-center">{{$invoice->sell_qty}}</td>
                                        <td class="text-end">৳{{$invoice->product->unit_price*$invoice->sell_qty}}</td>
                                    </tr>

                                    <tr class="tr2">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center f-w-600 active-color">Grand Total</td>
                                        <td class="f-w-600 text-end active-color">৳{{$invoice->product->unit_price*$invoice->sell_qty}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-bottom">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-30 dear-client">
                                        <h3 class="inv-title-1">Terms &amp; Conditions</h3>
                                        <p>If more than one (1) sample of the same tile item code is ordered, the Company reserves the right to send only one (1) sample of that tile in the delivery.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="invoice-contact clearfix">
                            <div class="row g-0">
                                <div class="col-lg-9 col-md-11 col-sm-12">
                                    <div class="contact-info">
                                        <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +880xxxxxxxxxx</a>
                                        <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i> creative@tilescapes.com</a>
                                        <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> Dhaka 1216, Bangladesh</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i> Print Invoice
                        </a>
                        <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                            <i class="fa fa-download"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('invoice/jquery.min.js')}}"></script>
<script src="{{asset('invoice/jspdf.min.js')}}"></script>
<script src="{{asset('invoice/html2canvas.js')}}"></script>
<script src="{{asset('invoice/app.js')}}"></script>
</body>
</html>
