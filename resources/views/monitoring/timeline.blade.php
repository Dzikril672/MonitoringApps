<!-- Modal edit data Departemen -->
<div class="modal modal-blur fade" id="modal-timeline" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modalTimelineLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTimelineLabel">Timeline</h5>   
            </div>
            <div class="modal-body">
                <div class="py-2">
                    <h2 class="font-weight-light text-center text-muted py-3" id="judulTimeline"></h2>
                </div>
                <ul id="loadTimeline" class="timeline">
                    <!-- Timeline items will be dynamically added here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="bulantahun" id="bulantahun" value="{{date('Y-m', strtotime(date('Y-m-d') . '- 1 month' ))}}">