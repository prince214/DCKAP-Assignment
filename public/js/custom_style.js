$(document).ready(function() {
    // $('#user-list').DataTable();

    $('#dob_datepicker').datetimepicker({
        format: 'L'
    });

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        cache: false,
    });

} );

$('#country-list').change(function (){
    let countryID = $(this).val();
    let url = BASE_URL+"getCities/"+countryID;
    loadCities(url);
})

function loadCities(url){
    $.ajax({
        type: "get",
        dataType: "json",
        url: url,
        async: false,
        statusCode: {500: function () {toastr.error('ERROR: Something Went Wrong !');}},
        cache: false,
        beforeSend: function () {$('#cover-spin').show(0);},
        complete: function () {$('#cover-spin').hide(0);},
        success: function (res) {
            if (res.status === true) {
                $('#city-list').html(res.data);
            }else{
                toastr.error(res.data);
            }
        },
    });
}

$('#country-list').change(function (){
    let countryID = $(this).val();
    let url = BASE_URL+"getCities/"+countryID;
    $.ajax({
        type: "get",
        dataType: "json",
        url: url,
        statusCode: {500: function () {toastr.error('ERROR: Something Went Wrong !');}},
        cache: false,
        beforeSend: function () {$('#cover-spin').show(0);},
        complete: function () {$('#cover-spin').hide(0);},
        success: function (res) {
            if (res.status === true) {
                $('#city-list').html(res.data);
            }else{
                toastr.error(res.data);
            }
        },
    });
})

// $.validator.setDefaults( {
//     submitHandler: function () {
//         registerForm();
//     }
// } );

$.validator.addMethod("regex", function(value, element, regexpr) {
    return regexpr.test(value);
}, "Please enter a valid email address.");

$.validator.addMethod("minAge", function(value, element, min) {
    console.log(value)
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();

    if (age > min+1) { return true; }

    var m = today.getMonth() - birthDate.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }

    return age >= min;
}, "You need to be atleast 3 Years Old !");

$( document ).ready( function () {
    $( "#user-create-form" ).validate( {
        rules: {
            name: {
                required: true,
                maxlength: 25
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 25
            },
            email: {
                required: true,
                regex: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            dob: {
                required: true,
                minAge: 3,
            },
            country: {
                required: true,
            },
            city: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name.",
                maxlength: "Your name must be at less than 25 characters long."
            },
            password: {
                required: "Please enter your Password.",
                minlength: "Your password must be at least 5 characters long.",
                maxlength: "Your password can be max 25 characters long."
            },
            email: {
                required: "Please enter E-mail address.",
                regex: "Please enter a valid E-mail address."
            },
            dob: {
                required: "Please enter DOB."
            },
            country: {
                required: "Please select Country."
            },
            city: {
                required: "Please select City."
            },
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `invalid-feedback` class to the error element
            error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.next( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
    } );

} );



