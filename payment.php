<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet"/>
    <style>
        .inlineimage {
            max-width: 470px;
            margin-right: 8px;
            margin-left: 10px
        }

        .images {
            display: inline-block;
            max-width: 98%;
            height: auto;
            width: 22%;
            margin: 1%;
            left: 20px;
            text-align: center
        }
        .pay{
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container pay">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Payment Details</h3>
                            <div class="inlineimage"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png"> </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="bookingemail.php">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>CARD NUMBER</label>
                                        <div class="input-group"> <input type="tel" class="form-control" placeholder="Valid Card Number" required /> <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input type="tel" class="form-control" placeholder="MM / YY" required/> </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group"> <label>CV CODE</label> <input type="tel" class="form-control" placeholder="CVC" required/> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>CARD OWNER</label> <input type="text" class="form-control" placeholder="Card Owner Name" required/> </div>
                                </div>
                            </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12"><input type="submit" class="btn btn-success btn-lg btn-block" value="Confirm Payment"></div>
                        </div>
                    </div>
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>