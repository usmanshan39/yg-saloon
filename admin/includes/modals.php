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