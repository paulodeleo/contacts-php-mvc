<?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-warning my-3 p-3" role="alert">
        <?= $_SESSION['message'] ?>
    </div>
<?php } ?>