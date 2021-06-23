<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Login to iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partial/handlelogin.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="loginemail" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginemail" name="loginemail"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="loginpass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginpass" name="loginpass">
                    </div>

                    <button type="submit" class="btn btn-success">Login
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>