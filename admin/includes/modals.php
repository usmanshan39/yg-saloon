<!-- edit Appointment Modal -->
<div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="editAppointmentForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="appointmentIdInput" name="id">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="appointmentDateInput" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" id="appointmentTimeInput" class="form-control" id="time" name="time">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="updateBtn">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- add blog -->

<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="blogForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add New Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" cols="50"
                            required></textarea>
                    </div>
                    <div class="form-group">
                    <label for="blogStatus">Status:</label>
                    <select class="form-control" id="blogStatus" name="blogStatus" value="0">
                        <option value="1" selected>Publish</option>
                        <option value="0">Pending</option>
                    </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="updateBtn">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="editBlogForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="editBlogIdInput" name="id">
                    <div class="form-group">
                        <label for="editBlogtitle">Title:</label>
                        <input type="text" name="title" id="editBlogtitle" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editBlogdescription">Description:</label>
                        <textarea name="description" id="editBlogdescription" class="form-control" rows="4" cols="50"
                            required></textarea>
                    </div>
                    <div class="form-group">
                    <label for="editBlogStatus">Status:</label>
                    <select class="form-control" id="editBlogStatus" name="editBlogStatus">
                        <option value="1" selected>Publish</option>
                        <option value="2">Pending</option>
                    </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="updateBtn">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>