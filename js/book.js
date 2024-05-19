function init(){}

$(document).ready(function(){

    const minusBtn = document.querySelector('.minus-btn');
    const plusBtn = document.querySelector('.plus-btn');
    const guestsSelect = document.querySelector('#guests');
    
    minusBtn.addEventListener('click', () => {
      if (guestsSelect.value > 1) {
        guestsSelect.value--;
      }
    });
    
    plusBtn.addEventListener('click', () => {
      if (guestsSelect.value < guestsSelect.options.length - 1) {
        guestsSelect.value++;
      }
    });



    
});


