<?php

    session_start();
    

    if (isset($_POST['submit'])) {
        $cardName = $_POST['cardName'];
        $cardNum = $_POST['creditcard'];
        $cardNum2 = preg_replace('/\s+/', '', $_POST['creditcard']);
        $cardNumLen = strlen((string)$cardNum2);
        $date_now = date("mm/YY"); // this format is string comparable
        $date = $_POST['expirydate'];
        $cvv = $_POST['cvv'];
        $address = $_POST['address'];
        $postalCode = $_POST['postalCode'];

        if (is_numeric($cardName)) {
            $_SESSION["error1"] = "Value must be alphabet characters only";
        }
        
        if ($_POST['cc_type'] == 'unknown') {
            $_SESSION["error2"] = "Please enter a valid credit card number.<br />Credit card value must be 16 digits(Visa/Mastercard) or 15 digits(American Express).";
        }
        
        if ($cardNumLen < 15) {
            $_SESSION["error3"] = "Please enter a valid credit card number.<br />Credit card value must be 16 digits(Visa/Mastercard) or 15 digits(American Express).";
        }

        if ($date < $date_now) {
            $_SESSION["error4"] = "The expiry date is invalid";
        }
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
        <title>Payment Page</title>
        <style>
            .errorText {
                color: red;
            }
            .form {
                color: black;
            }
            .form j {
                font-size: 1em;
            }
            .form i {
                font-size: 3em;
                margin: 0 0 15px;
                opacity: 0.3;
            }
            .form i.active {
                color: #1a1e5a;
                opacity: 1;
                transform: scale(1.3);
            }
        </style>
    </head>    

    <body>
        <div class="form">
            <form action="payment.php" method="POST">
                <h1>Payment Using Debit/Credit Card</h1>

                <h2>Card Details</h2>
                <label>Name on Card</label><br />
                <input type="text" placeholder="" name="cardName" id="cardName" value="<?php echo isset($_POST['cardName']) ? $_POST['cardName'] : '' ?>" onkeyup="toUpperCase()" required /><br />
                <?php
                    if(isset($_SESSION["error1"])){
                        $error = $_SESSION["error1"];
                        echo "<span>$error</span><br />";
                    }
                ?>  
                <br />
                <label>Card Number</label><br />
                <div>
                <input type="text" placeholder="0000 0000 0000 0000" class="creditcard" name="creditcard" id="creditcard" value="<?php echo isset($_POST['creditcard']) ? $_POST['creditcard'] : '' ?>" required />
                <j class="fa fa-credit-card"></j>
                </div>
                <?php
                    if(isset($_SESSION["error2"])){
                        $error = $_SESSION["error2"];
                        echo "<span>$error</span><br />";
                    } else if(isset($_SESSION["error3"])){
                        $error = $_SESSION["error3"];
                        echo "<span>$error</span><br />";
                    }
                ?>
                <i class="fab fa-cc-visa"></i>&nbsp;&nbsp;
                <i class="fab fa-cc-mastercard"></i>&nbsp;&nbsp;
                <i class="fab fa-cc-amex"></i> <br />
                <label>Expiry Date</label><br />
                <input type="text" placeholder="MM/YY" class="expirydate" name="expirydate" id="expirydate" value="<?php echo isset($_POST['expirydate']) ? $_POST['expirydate'] : '' ?>" required /> <br /> 
                <?php
                    if(isset($_SESSION["error4"])){
                        $error = $_SESSION["error4"];
                        echo "<span>$error</span><br />";
                    }
                ?> <br />
                <label>CVV</label><br />
                <input type="password" class="cvv" placeholder="CVV" name="cvv" id="cvv" value="<?php echo isset($_POST['cvv']) ? $_POST['cvv'] : '' ?>" required />

                <h2>Billing address</h2>
                <input type="text" placeholder="Enter Billing Address" name="address" id="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required> <br />
                <label>Postal Code</label>
                <input type="text" placeholder="" name="postalCode" id="postalCode" value="<?php echo isset($_POST['postalCode']) ? $_POST['postalCode'] : '' ?>" required />

                <h2>Order Information</h2>
                (Subject) (Fee) <br />
                Total Payment $ <br />

                <script>
                    function toUpperCase() {
                        var x = document.getElementById("cardName");
                        x.value = x.value.toUpperCase();
                    }

                    function ccCheck() {
                        if (document.querySelector('.fa-cc-visa').classList.contains('active')) {
                            document.getElementById("cc_type").value = 'visa';
                        } else if (document.querySelector('.fa-cc-mastercard').classList.contains('active')) {
                            document.getElementById("cc_type").value = 'mastercard';
                        } else if (document.querySelector('.fa-cc-amex').classList.contains('active')) {
                            document.getElementById("cc_type").value = 'amex';
                        } else {
                            document.getElementById("cc_type").value = 'unknown';
                        }
                    }
                </script>
                <?php
                    unset ($_SESSION["error1"]);
                    unset ($_SESSION["error2"]);
                    unset ($_SESSION["error3"]);
                    unset ($_SESSION["error4"]);
                ?>
                <input type="hidden" name="cc_type" id="cc_type" />
                <button name="submit" onclick="ccCheck()">Pay</button>
                <script src="js/cleave.js"></script>
                <script src="js/payment.js"></script>
            </form>
        </div>
    </body>
</html>