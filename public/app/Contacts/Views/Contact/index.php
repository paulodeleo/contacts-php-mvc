<div class="container">

    <? require_once __DIR__ . '/../Layout/_messages.php' ?>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <?php foreach ($contacts as $contact) { ?>
            <div class="media text-muted pt-3">
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">
                        <a href="/contacts/show/<?= $contact->id ?>">
                            <?= $contact->name ?>
                        </a>
                    </strong>
                </p>
            </div>
        <?php } ?>
    </div>
</div>
