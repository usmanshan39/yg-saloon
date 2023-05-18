$(document).ready(function() {
    $('#dataTable').DataTable();

    // for fetch all appontments

    $.ajax({
        url: "functions/functions.php",
        type: "POST",
        data: {action : 'fetchAllAppointments'},
        success: function (response) {
            // Handle success response
            console.log(response);
        },
        error: function (data, status, error) {
            console.log(JSON.parse(data))
        }
    });

});