var container = document.querySelector('.myForm');

document.querySelector('#selectoption').addEventListener('change', function() {
    if (this.value === 'Doctor') {

        let select = document.createElement('select');
        select.setAttribute('name', 'specialite');
        select.classList.add('specialite');


        window.specialites.forEach(function(specialite) {
            let option = document.createElement('option');
            option.setAttribute('value', specialite['id']);
            option.textContent = specialite['Specialite'];
            select.appendChild(option);
        });
        

        let afterdiv = document.querySelector('#selectoption');
        afterdiv.insertAdjacentElement('afterend',select);

        console.log(window.specialites);
    }
    else {
        document.querySelector('.specialite').remove();
    }
});
