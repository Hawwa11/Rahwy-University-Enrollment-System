<?php
    
    if (isset($_POST['submit'])) {
        $cardName = $_POST['cardName'];
        $cardNum = $_POST['creditcard'];
        $cardNum2 = preg_replace('/\s+/', '', $_POST['creditcard']);
        $cardNumLen = strlen((string)$cardNum2);
        $date_now = date("y/m");
        $date = $_POST['expirydate'];
        $month = substr($date, 0, 2);
        $year = substr($date, 3, 2);
        $expiry_date = $year . '/' . $month;
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

        if ($expiry_date <= $date_now) {
            $_SESSION["error4"] = "The expiry date is invalid";
        }

        if(!isset($_SESSION["error1"]) && !isset($_SESSION["error2"]) && !isset($_SESSION["error3"]) && !isset($_SESSION["error4"])){
            echo "test";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="form.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
        <title>Payment Page</title>
        <style>
            .errorText {
                color: red;
            }
            .form {
                color: black;
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
        <div>
            <form class="signup-form" action="payment.php" method="POST">
                <div class="form-header">
                    <h1>Payment Using Debit / Credit Card</h1>
                    <?php
                    echo date("d/m/y");
                    ?>
                </div>
                <div class="form-body">
    
                <table border="0" width=100%>
                    <tr>
                        <td colspan="4">
                            <div style="padding: 10px 40px; font-size: 20px; font-weight: bold;">
                                <center><label class="label-title">Card Details</label></center>
                            </div>
                            <hr />
                        </td>
                    </tr>
                        
                    <tr>
                        <td>
                            <div>
                                <label class="label-title">Name on Card</label><br />
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;">
                                <input type="text" placeholder="" name="cardName" id="cardName" value="<?php echo isset($_POST['cardName']) ? $_POST['cardName'] : '' ?>" onkeyup="toUpperCase()" required /><br />
                                <?php
                                    if(isset($_SESSION["error1"])){
                                        $error = $_SESSION["error1"];
                                        echo "<span class='errorText'>$error</span>";
                                    }
                                ?>  
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div >
                                <label class="label-title">Card Number</label><br />
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;  color: rgba(59, 76, 117, 0.9);">
                            <input type="text" placeholder="0000 0000 0000 0000" class="creditcard" name="creditcard" id="creditcard" value="<?php echo isset($_POST['creditcard']) ? $_POST['creditcard'] : '' ?>" required />
                                <label class="fa fa-credit-card"></label>
                                <?php
                                    if(isset($_SESSION["error2"])){
                                        $error = $_SESSION["error2"];
                                        echo "<span class='errorText'>$error</span>";
                                    } else if(isset($_SESSION["error3"])){
                                        $error = $_SESSION["error3"];
                                        echo "<span class='errorText'>$error</span>";
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>  
                    
                    <tr>
                        <td>
                            <div style="padding: 20px 40px; font-weight: bold;">
                                
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;  color: rgba(59, 76, 117, 0.9);">
                                <i class="fab fa-cc-visa"></i>&nbsp;&nbsp;
                                <i class="fab fa-cc-mastercard"></i>&nbsp;&nbsp;
                                <i class="fab fa-cc-amex"></i>
                            </div>
                        </td>
                    </tr> 

                    <tr>
                        <td>
                            <div>
                                <label class="label-title">Expiry Date</label>
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;">
                                <input type="text" placeholder="MM/YY" class="expirydate" size="4" name="expirydate" id="expirydate" value="<?php echo isset($_POST['expirydate']) ? $_POST['expirydate'] : '' ?>" required /> <br /> 
                                <?php
                                    if(isset($_SESSION["error4"])){
                                        $error = $_SESSION["error4"];
                                        echo "<span class='errorText'>$error</span>";
                                    }
                                ?>
                            </div>
                        </td>
                    </tr> 

                    <tr>
                        <td>
                            <div>
                                <label class="label-title">CVV</label>
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;">
                                <input type="password" class="cvv" size="4" placeholder="CVV" name="cvv" id="cvv" value="<?php echo isset($_POST['cvv']) ? $_POST['cvv'] : '' ?>" required />
                            </div>
                        </td>
                    </tr> 

                    <tr>
                        <td>
                            <div >
                                <label class="label-title">Billing address</label>
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;">
                                <input type="text" size="45" placeholder="Enter Billing Address" name="address" id="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required>
                            </div>
                        </td>
                    </tr> 

                    <tr>
                        <td>
                            <div >
                                <label class="label-title">Postal Code</label>
                            </div>
                        </td>
                        <td>
                            <div style="padding: 10px 40px;">
                                <input type="text" size="7" placeholder="" name="postalCode" id="postalCode" value="<?php echo isset($_POST['postalCode']) ? $_POST['postalCode'] : '' ?>" required />
                            </div>
                        </td>
                    </tr> 

                    <tr>
                    </tr>

                    <tr>
                        <td colspan="4">
                        <div style="padding: 10px 40px; font-size: 20px; font-weight: bold;">
                                <center><label class="label-title">Selected Subjects</label></center>
                            </div>
                    
                            <hr />
                        </td>
                    </tr> 

                    <tr>
                        <td colspan="2">
                            <div style="padding: 20px 40px; font-weight: bold;  color: rgba(59, 76, 117, 0.9);">
                                (Subject) (Fee)
                            </div>
                        </td>
                    </tr> 

                    <tr>
                        <td colspan="2">
                            <div style="padding: 20px 40px; font-weight: bold; float: right;  color: rgba(59, 76, 117, 0.9);">
                                Total Payment $
                            </div>
                        </td>
                    </tr> 
                </table>

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
                    </div>
                    <div class="form-footer">
                        <button name="submit" class="btn" onclick="ccCheck()">Pay</button>
                    </div>
                </div>
                
                <script src="js/cleave.js"></script>
                <script src="js/payment.js"></script>
            </form>
        </div>
    </body>
</html>