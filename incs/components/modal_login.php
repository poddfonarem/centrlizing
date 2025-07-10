<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content box-shadow-yellow my-rounded">
            <div class="modal-header bg-glass my-rounded">
                <h5 class="modal-title text-white" id="loginModalLabel">ВХІД ДО АКАУНТУ</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Закрити">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/incs/handlers/account/login_handler.php" method="POST">
                    <div class="form-group">
                        <label for="login" class="d-none"></label>
                        <input id="login" type="text" class="form-control" name="login" placeholder="Введіть логін" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password" class="d-none"></label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Введіть пароль" required autocomplete="off">
                    </div>
                    <input type="submit" class="btn text-white btn-primary w-100" value="Увійти">
                </form>
            </div>

        </div>
    </div>
</div>