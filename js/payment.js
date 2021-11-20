new Cleave('.creditcard', {
    creditCard: true,
    onCreditCardTypeChanged: function (type) {
        console.log(type);
        if(type === 'visa'){
            document.querySelector('.fa-cc-visa').classList.add('active'); //4********
        }  else {
            document.querySelector('.fa-cc-visa').classList.remove('active');
        }

        if(type === 'mastercard'){
            document.querySelector('.fa-cc-mastercard').classList.add('active'); //51*****
        } else {
            document.querySelector('.fa-cc-mastercard').classList.remove('active');
        }

        if(type === 'amex'){
            document.querySelector('.fa-cc-amex').classList.add('active'); //34********
        } else {
            document.querySelector('.fa-cc-amex').classList.remove('active');
        }
         
    }
});

new Cleave('.expirydate', {
    date: true,
    datePattern: ['m', 'y']
});

new Cleave('.cvv', {
    numericOnly: true,
    blocks: [3]
});