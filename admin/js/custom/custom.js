$(document).ready(function () {
    function loadAppointments() {
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: {
                action: 'fetchAllAppointments'
            },
            success: function (response) {
                let tableData = JSON.parse(response);
                let tableBody = $('#dataTable tbody');
                tableBody.empty();
                $.each(tableData, function (index, rowData) {
                    let rowHtml = '<tr>' +
                        '<td>' + rowData.id + '</td>' +
                        '<td>' + rowData.name + '</td>' +
                        '<td>' + rowData.email + '</td>' +
                        '<td>' + rowData.mobile + '</td>' +
                        '<td>' + rowData.app_date + '</td>' +
                        '<td>' + rowData.app_time + '</td>' +
                        '<td>' + rowData.status + '</td>' +
                        '<td> <button class="btn btn-outline-success btn-sm complete-appointment-btn"><i class="fa fa-check"></i></button>' +
                        '<button class="btn btn-outline-danger mx-2 btn-sm"><i class="fa fa-times"></i></button>' +
                        '<button class="btn btn-outline-primary btn-sm edit-appointment-btn" data-record-id="' + rowData.id + '" data-toggle="modal" data-target="#editAppointmentModal">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(rowHtml);
                });
                $('#dataTable').DataTable();
            },
            error: function (data, status, error) {
                console.log("Fetch Appointments error ", data);
            }
        });
    }
    loadAppointments();

    $(document).on('click', '.edit-appointment-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        let data = {
            id: recordId,
            action: 'getSingleAppointment'
        };
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: data,
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status) {
                    $("#appointmentIdInput").val(recordId);
                    $("#appointmentDateInput").val(result.data.app_date);
                    $("#appointmentTimeInput").val(result.data.app_time);
                }
            }
        })
    });

    $(document).on('submit', '#editAppointmentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'updateAppointment');
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status) {
                    swalAlert('Success!', 'success', result.message);
                    $('#editAppointmentModal').modal('hide');
                    loadAppointments();
                } else {
                    swalAlert('Success!', 'error', result.message);
                }
            }
        })
    });

    $(document).on('click', '.complete-appointment-btn', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete this record?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Complete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("yesssssssssssss");
            }
        });
    })

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