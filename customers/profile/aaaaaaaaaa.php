<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="font-size: 16px; padding-left :24px; padding-right: 24px">
    Cancel order
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Confirm cancellation</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you really want to cancel this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="font-size: 16px;"
                >Close
                </button>
                <button type="button" class="btn btn-danger"
                        style="font-size: 16px;"
                >Cancel order
                </button>
            </div>
        </div>
    </div>
</div>
<!--               end modal -->

<!--modal cancel-->
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>