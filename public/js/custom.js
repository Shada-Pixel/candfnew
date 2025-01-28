
// Ajax csrf token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Only number in text
$('input.onlynumber').keyup(function(e){
    if (/\D/g.test(this.value)){
      this.value = this.value.replace(/\D/g, '');
    }
});


// success notification
setTimeout(function () { $("#notificationflush").fadeOut(1000) }, 3000);

function hideflash() {
    setTimeout(function () { $("#notificationflush").fadeOut(150) });
}

$('input[required], textarea[required], select[required]').each(function () {
    $(this).prev('label').append('<span class="text-red-500">*</span>');
});



// This function is to make product slug
function slugify(string){
    return string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
}

const toggleButton = document.querySelector('#menu-button');
const menu = document.querySelector('#menu');


// toggleButton.addEventListener('click', () => {
//   menu.classList.toggle('hidden');
// });
