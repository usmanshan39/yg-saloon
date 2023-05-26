// document.getElementById("myButton").addEventListener("click", function() {
//     Swal.fire({
//       title: 'Success!',
//       text: 'Appointment Booked Successfully',
//       icon: 'success',
//       confirmButtonColor: '#3085d6',
//       confirmButtonText: 'OK'
//     });
//   });
$(document).ready(function () {

    $(document).on('submit', '.add-appointment-form', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'addAppointment');
        $.ajax({
            url: "admin/functions/addAppointment.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let result = JSON.parse(response);
                console.log("result " , result);
                if (result.status) {
                    $(this).trigger('reset');
                    $('#appModal').modal('hide');
                    swalAlert('Success!', 'success', result.message);
                } else {
                    swalAlert('Success!', 'error', result.message);
                }
            }
        })
    })

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        padding: 40,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            800: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });

    function swalAlert(title, icon, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
});