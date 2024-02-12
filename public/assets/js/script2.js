var buttonsmedic = document.querySelectorAll('#updatemedic');

var form = document.querySelector('#medicform');

buttonsmedic.forEach(button => {
    button.addEventListener('click', function(e) {



        var name = this.closest('tr').querySelector('#nametext');
        var desc = this.closest('tr').querySelector('#descriptiontext');
        var price = this.closest('tr').querySelector('#pricetext');
        var medicamentInput = document.querySelector('#medicamentinput');
        var descinput = document.querySelector('#descriptioninput');
        var priceinput = document.querySelector('#priceinput');
        var idinput = document.querySelector('#id_medicament');

        if (name && medicamentInput) {
            medicamentInput.value = name.textContent;
            descinput.value = desc.textContent;
            var priceText = price.textContent.trim();
            var priceWithoutDH = priceText.replace(' DH', '');
            priceinput.value = priceWithoutDH;
            idinput.value = this.value;
        }
     
    });
});


