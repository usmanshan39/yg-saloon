$(document).ready(function () {
    var selectedAppForDelete = [];
    var selectedBlogsForDelete = [];
    var selectedUserForDelete = [];
    var selectedSubForDelete = [];
    var allAppointmentsData;
    var filteredAppointmentsData;



    function loadAppointments() {
        selectedAppForDelete=[];
        $("#btn-bulk-app-delete").addClass('d-none');
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: {
                action: 'fetchAllAppointments'
            },
            success: function (response) {
                let tableData = JSON.parse(response);
                allAppointmentsData = JSON.parse(response);
                loadAppointmentsTable(allAppointmentsData);
            },
            error: function (data, status, error) {
                console.log("Fetch Appointments error ", data);
            }
        });
    }
    loadAppointments();
    function loadAppointmentsTable(tableData) {
        let tableBody = $('#appointmentTable tbody');
        tableBody.empty();
        $.each(tableData, function (index, rowData) {
            let checkboxId = 'checkbox_' + rowData.id;
            let recordStatus;
            if (rowData.status == "Pending") {
                recordStatus = '<span class="badge badge-dark">Pending</span>';
            } else if (rowData.status == "Cancel") {
                recordStatus = '<span class="badge badge-danger">Cancel</span>';
            } else if (rowData.status == "Complete") {
                recordStatus = '<span class="badge badge-success">Complete</span>';
            }
            let rowHtml = '<tr>' +
                '<td><input type="checkbox" id="' + checkboxId + '"> ' + (index + 1) + '</td>' +
                '<td>' + rowData.name + '</td>' +
                '<td>' + rowData.email + '</td>' +
                '<td>' + rowData.mobile + '</td>' +
                '<td>' + rowData.app_date + '</td>' +
                '<td>' + rowData.app_time + '</td>' +
                '<td>' + recordStatus + '</td>' +
                '<td> <button class="m-1 btn btn-outline-success btn-sm complete-appointment-btn" data-record-id="' + rowData.id + '"><i class="fa fa-check"></i></button>' +
                '<button class="m-1 btn btn-outline-warning btn-sm cancel-appointment-btn" data-record-id="' + rowData.id + '"><i class="fa fa-times"></i></button>' +
                '<button class="m-1 btn btn-outline-primary btn-sm edit-appointment-btn" data-record-id="' + rowData.id + '" data-toggle="modal" data-target="#editAppointmentModal">' +
                '<i class="fa fa-edit"></i>' +
                '</button>' +
                '<button class="m-1 btn btn-outline-dark btn-sm send-email-btn" data-record-id="' + rowData.id + '"><i class="fa fa-envelope"></i></button>' +
                '<button class="m-1 btn btn-outline-danger btn-sm delete-appointment-btn" data-record-id="' + rowData.id + '"><i class="fa fa-trash"></i></button>' +
                '</td>' +
                '</tr>';
            tableBody.append(rowHtml);
            $('#' + checkboxId).change(function () {
                if (this.checked) {
                    selectedAppForDelete.push(rowData.id);
                } else {
                    let index = selectedAppForDelete.indexOf(rowData.id);
                    if (index > -1) {
                        selectedAppForDelete.splice(index, 1);
                    }
                }
                if (selectedAppForDelete.length > 0) {
                    $("#btn-bulk-app-delete").removeClass('d-none');
                } else {
                    $("#btn-bulk-app-delete").addClass('d-none');
                }
                console.log("selectedAppForDelete", selectedAppForDelete);
            });
        });
        $('#appointmentTable').DataTable();
    }

    $(document).on('submit', '#addAppointmentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'addAppointment');
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
                    $('#addAppointmentModal').modal('hide');
                    $('#addAppointmentForm')[0].reset();
                    loadAppointments();
                } else {
                    swalAlert('Success!', 'error', result.message);
                }
            }
        })
    });

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
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Complete this Appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "markAppComplete" , id : recordId},
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
            }
        });
    })

    $(document).on('click', '.cancel-appointment-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to cancel this appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "markAppCancel" , id : recordId},
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
            }
        });
    })

    $(document).on('click', '.delete-appointment-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete this appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteAppointment" , id : recordId},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadAppointments();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        });
    })

    // appointments filers
    $(document).on('click' , '#filterAStautsBtn' , function(e){
        e.preventDefault();
        var filterStatusValue = $('#filterStatus').val();
        if(!filterStatusValue || filterStatusValue == ''){
            swalAlert('Error!', 'error', "Please Enter Valid Status");
        }else{
            filteredAppointmentsData = allAppointmentsData.filter(el => filterStatusValue.toLowerCase() === el.status.toLowerCase());
            loadAppointmentsTable(filteredAppointmentsData);
            if(filteredAppointmentsData.length = 0){
                filteredAppointmentsData = allAppointmentsData;
            }
        }
    })
    $(document).on('click' , '#filterADatebtn' , function(e){
        e.preventDefault();
        var filterStatusValue = $('#filterDate').val();
        if(!filterStatusValue || filterStatusValue == ''){
            swalAlert('Error!', 'error', "Please Enter Valid Status");
        }else{
            filteredAppointmentsData = allAppointmentsData.filter(el => filterStatusValue === el.app_date);
            loadAppointmentsTable(filteredAppointmentsData);
            if(filteredAppointmentsData.length = 0){
                filteredAppointmentsData = allAppointmentsData;
            }
        }
    })
    $(document).on('click' , '#filterATimebtn' , function(e){
        e.preventDefault();
        var filterStatusValue = $('#filterTime').val();
        if(!filterStatusValue || filterStatusValue == ''){
            swalAlert('Error!', 'error', "Please Enter Valid Status");
        }else{
            filteredAppointmentsData = allAppointmentsData.filter(el => filterStatusValue === el.app_time);
            loadAppointmentsTable(filteredAppointmentsData);
            if(filteredAppointmentsData.length = 0){
                filteredAppointmentsData = allAppointmentsData;
            }
        }
    })
    $(document).on('click' , '#filterResetBtn' , function(e){
        e.preventDefault();
        $('#filterStatus').val('');
        $('#filterDate').val('');
        $('#filterTime').val('');
        loadAppointmentsTable(allAppointmentsData);
    })

    $(document).on('click' , '#btn-bulk-app-delete' , function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete all these appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                let sendArr = selectedAppForDelete.map(el=> parseInt(el));
                console.log("sendArr", sendArr);
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteMultipleAppointment" , ids : JSON.stringify(sendArr)},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadAppointments();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        })
    })

    $(document).on('click', '.send-email-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Send Email?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "sendEmail" , id : recordId},
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
            }
        });
    })


    // blogs sections start


    function loadBlogs() {
        selectedBlogsForDelete=[];
        $("#btn-bulk-blogs-delete").addClass('d-none');
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: {
                action: 'fetchAllBlogs'
            },
            success: function (response) {
                let tableData = JSON.parse(response);
                let tableBody = $('#blogsTable tbody');
                tableBody.empty();
                $.each(tableData, function (index, rowData) {
                    let recordStatus;
                    let checkboxId = 'checkbox_' + rowData.id;
                    if(rowData.published == 1){
                        recordStatus = '<span class="badge badge-success">Published</span>';
                    }else{
                        recordStatus = '<span class="badge badge-dark">Pending</span>';
                    }
                    let rowHtml = '<tr>' +
                        '<td><input type="checkbox" id="' + checkboxId + '"> ' + (index+1) + '</td>' +
                        '<td>' + rowData.title + '</td>' +
                        '<td> <img src="./uploads/'+rowData.blog_image+'" width="100px"> </td>' +
                        '<td>' + rowData.blog_desc + '</td>' +
                        '<td>' + recordStatus + '</td>' +
                        '<td><button class="btn btn-outline-danger m-1 btn-sm cancel-blog-btn" data-record-id="' + rowData.id + '"><i class="fa fa-trash"></i></button>' +
                        '<button class="btn btn-outline-primary m-1 btn-sm edit-blog-btn" data-record-id="' + rowData.id + '" data-toggle="modal" data-target="#editBlogModal">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(rowHtml);
                    $('#' + checkboxId).change(function () {
                        if (this.checked) {
                          selectedBlogsForDelete.push(rowData.id);
                        } else {
                          let index = selectedBlogsForDelete.indexOf(rowData.id);
                          if (index > -1) {
                            selectedBlogsForDelete.splice(index, 1);
                          }
                        }
                        if(selectedBlogsForDelete.length>0){
                            $("#btn-bulk-blogs-delete").removeClass('d-none');
                        }else{
                            $("#btn-bulk-blogs-delete").addClass('d-none');
                        }
                        console.log("selectedBlogsForDelete" , selectedBlogsForDelete);
                      });
                });
                $('#blogsTable').DataTable();
            },
            error: function (data, status, error) {
                console.log("Fetch Appointments error ", data);
            }
        });
    }
    loadBlogs();


    $('#blogForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'addNewBlog');
        $.ajax({
          url: "functions/functions.php",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            let result = JSON.parse(response);
                if (result.status) {
                    swalAlert('Success!', 'success', result.message);
                    $('#blogModal').modal('hide');
                    loadBlogs();
                    $('#blogForm')[0].reset();
                } else {
                    swalAlert('Error!', 'error', result.message);
                }
          },
          error: function(xhr, status, error) {
            alert('Error occurred while submitting the form.');
            console.log(xhr.responseText);
          }
        });
    });

    $(document).on('click', '.edit-blog-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        let data = {
            id: recordId,
            action: 'getSingleBlog'
        };
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: data,
            success: function (response) {
                let result = JSON.parse(response);
                console.log("response" , result)
                if (result.status) {
                    $("#editBlogIdInput").val(recordId);
                    $("#editBlogtitle").val(result.data.title);
                    // $("#editBlogimage").val(result.data.blog_image);
                    $("#editBlogdescription").val(result.data.blog_desc);
                    $("#editBlogStatus").val(result.data.published);
                    $("#metaTitle").val(result.data.meta_title);
                    $("#metaDesc").val(result.data.meta_desc);

                }
            }
        })
    });

    $('#editBlogForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'updateBlog');
        $.ajax({
          url: "functions/functions.php",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            let result = JSON.parse(response);
                if (result.status) {
                    swalAlert('Success!', 'success', result.message);
                    $('#editBlogModal').modal('hide');
                    loadBlogs();
                } else {
                    swalAlert('Error!', 'error', result.message);
                }
          },
          error: function(xhr, status, error) {
            alert('Error occurred while submitting the form.');
            console.log(xhr.responseText);
          }
        });
    });

    $(document).on('click', '.cancel-blog-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete this Blog?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteBlog" , id : recordId},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadBlogs();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        });
    })
    $(document).on('click' , '#btn-bulk-blogs-delete' , function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete all these Blogs?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                let sendArr = selectedBlogsForDelete.map(el=> parseInt(el));
                console.log("sendArr", sendArr);
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteMultipleBlogs" , ids : JSON.stringify(sendArr)},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadBlogs();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        })
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

    // users section

    function loadUsers() {
        selectedUserForDelete=[];
        $("#btn-bulk-user-delete").addClass('d-none');
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: {
                action: 'fetchAllUsers'
            },
            success: function (response) {
                let tableData = JSON.parse(response);
                let tableBody = $('#usersTable tbody');
                tableBody.empty();
                $.each(tableData, function (index, rowData) {
                    
                    let checkboxId = 'checkbox_' + rowData.id;
                    let userType;
                    if(rowData.user_type == 'super'){
                        userType = '<span class="badge badge-success">Super Admin</span>';
                    }else if(rowData.user_type == 'admin'){
                        userType = '<span class="badge badge-dark">Admin</span>';
                    }
                    let rowHtml = '<tr>' +
                        '<td><input type="checkbox" id="' + checkboxId + '"> ' + (index+1) + '</td>' +
                        '<td>' + rowData.user_name + '</td>' +
                        '<td>'+ rowData.user_email +'</td>' +
                        '<td>*****</td>' +
                        '<td>' + userType + '</td>' +
                        '<td><button class="btn btn-outline-danger mx-2 btn-sm cancel-user-btn" data-record-id="' + rowData.id + '"><i class="fa fa-trash"></i></button>' +
                        '<button class="btn btn-outline-primary btn-sm edit-user-btn" data-record-id="' + rowData.id + '" data-toggle="modal" data-target="#editUserModal">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(rowHtml);
                    $('#' + checkboxId).change(function () {
                        if (this.checked) {
                          selectedUserForDelete.push(rowData.id);
                        } else {
                          let index = selectedUserForDelete.indexOf(rowData.id);
                          if (index > -1) {
                            selectedUserForDelete.splice(index, 1);
                          }
                        }
                        if(selectedUserForDelete.length>0){
                            $("#btn-bulk-user-delete").removeClass('d-none');
                        }else{
                            $("#btn-bulk-user-delete").addClass('d-none');
                        }
                      });
                });
                $('#usersTable').DataTable();
            },
            error: function (data, status, error) {
                console.log("Fetch Appointments error ", data);
            }
        });
    }
    loadUsers();

    $(document).on('submit', '#addUserForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'addUser');
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
                    $('#addUserModal').modal('hide');
                    $('#addUserForm')[0].reset();
                    loadUsers();
                } else {
                    swalAlert('Success!', 'error', result.message);
                }
            }
        })
    });

    $(document).on('click', '.edit-user-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        let data = {
            id: recordId,
            action: 'getSingleUser'
        };
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: data,
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status) {
                    $("#editUserIdInput").val(recordId);
                    $("#editUserName").val(result.data.user_name);
                    $("#editUserEmail").val(result.data.user_email);
                    $('#editUserType').val(result.data.user_type);
                }
            }
        })
    });

    $('#editUserForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'updateUser');
        $.ajax({
          url: "functions/functions.php",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            let result = JSON.parse(response);
                if (result.status) {
                    swalAlert('Success!', 'success', result.message);
                    $('#editUserModal').modal('hide');
                    $('#editUserForm')[0].reset();
                    loadUsers();
                } else {
                    swalAlert('Error!', 'error', result.message);
                }
          },
          error: function(xhr, status, error) {
            alert('Error occurred while submitting the form.');
            console.log(xhr.responseText);
          }
        });
    });

    $(document).on('click', '.cancel-user-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete this User?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteUser" , id : recordId},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadUsers();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        });
    })

    $(document).on('click' , '#btn-bulk-user-delete' , function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete all these Users?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                let sendArr = selectedUserForDelete.map(el=> parseInt(el));
                console.log("sendArr", sendArr);
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteMultipleUsers" , ids : JSON.stringify(sendArr)},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadUsers();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        })
    })


    // login function
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', 'login');
        $.ajax({
            url: "functions/authentication.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status) {
                    window.location.href = './index.php';
                } else {
                    swalAlert('Success!', 'error', result.message);
                }
            }
        })
    });
    

    function loadSubscribers() {
        selectedSubForDelete=[];
        $("#btn-bulk-subs-delete").addClass('d-none');
        $.ajax({
            url: "functions/functions.php",
            type: "POST",
            data: {
                action: 'fetchAllSubscribers'
            },
            success: function (response) {
                let tableData = JSON.parse(response);
                let tableBody = $('#subscriberTable tbody');
                tableBody.empty();
                $.each(tableData, function (index, rowData) {
                    let checkboxId = 'checkbox_' + rowData.id;
                    let userType;
                    if(rowData.user_type == 'super'){
                        userType = '<span class="badge badge-success">Super Admin</span>';
                    }else if(rowData.user_type == 'admin'){
                        userType = '<span class="badge badge-dark">Admin</span>';
                    }
                    let rowHtml = '<tr>' +
                        '<td><input type="checkbox" id="' + checkboxId + '"> ' + (index+1) + '</td>' +
                        '<td>'+ rowData.email +'</td>' +
                        '<td><button class="btn btn-outline-danger mx-2 btn-sm delete-subscriber-btn" data-record-id="' + rowData.id + '"><i class="fa fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(rowHtml);
                    $('#' + checkboxId).change(function () {
                        if (this.checked) {
                          selectedSubForDelete.push(rowData.id);
                        } else {
                          let index = selectedSubForDelete.indexOf(rowData.id);
                          if (index > -1) {
                            selectedSubForDelete.splice(index, 1);
                          }
                        }
                        if(selectedSubForDelete.length>0){
                            $("#btn-bulk-subs-delete").removeClass('d-none');
                        }else{
                            $("#btn-bulk-subs-delete").addClass('d-none');
                        }
                      });
                });
                $('#subscriberTable').DataTable();
            },
            error: function (data, status, error) {
                console.log("Fetch Appointments error ", data);
            }
        });
    }
    loadSubscribers();

    $(document).on('click', '.delete-subscriber-btn', function (e) {
        e.preventDefault();
        var recordId = $(this).data('record-id');
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete this Subscriber?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteSubscriber" , id : recordId},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadSubscribers();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        });
    })
    $(document).on('click' , '#btn-bulk-subs-delete' , function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Confirm',
            text: 'Are you sure you want to Delete all these Subscribers?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                let sendArr = selectedSubForDelete.map(el=> parseInt(el));
                $.ajax({
                    url: "functions/functions.php",
                    type: "POST",
                    data: {action : "deleteMultipleSubs" , ids : JSON.stringify(sendArr)},
                    success: function (response) {
                        let result = JSON.parse(response);
                        if (result.status) {
                            swalAlert('Success!', 'success', result.message);
                            loadSubscribers();
                        } else {
                            swalAlert('Success!', 'error', result.message);
                        }
                    }
                })
            }
        })
    })

});