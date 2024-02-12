var buttons = document.querySelectorAll('#update');

buttons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        var closetd = e.target.closest('tr').querySelector('.H');
        var specialitename = closetd.textContent;

        var field = e.target.closest('tr').querySelector('.specialitename');

        Swal.fire({
            title: 'Update Specialite',
            input: 'text',
            inputValue: specialitename,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to enter something!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.querySelector('.Myform');
                field.value = result.value; // Corrected variable name
                console.log(field.value);
                form.submit(); 
            }
        });
    });
});



var addform = document.querySelector('#addform');
document.querySelector('#addspecialite').addEventListener('click' , function(e){
    e.preventDefault();

    Swal.fire({
        title: 'Update Specialite',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Cancel',
        inputValidator: (value) => {
            if (!value) {
                return 'You need to enter something!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var holder = document.querySelector('#holder');

            holder.value = result.value;

            addform.submit(); 
        }
    });
})



