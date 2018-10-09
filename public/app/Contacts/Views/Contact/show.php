<div class="container">

    <? require_once __DIR__ . '/../Layout/_messages.php' ?>

    <div class="card my-3 p-3" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><?= $contact->name ?></h5>
          <p class="card-text"><?= $contact->phone ?></p>
        <form action="/contacts/destroy" method="post" data-js-confirm-submit>
            <input type="hidden" name="id" value="<?= $contact->id ?>">
            <a href="/contacts/edit/<?= $contact->id ?>" class="btn btn-primary">edit</a>
            <!-- <a href="/contacts/index class="btn btn-primary"">back</a> -->
            <input type="submit" class="btn btn-danger" name="" value="delete">
        </form>
      </div>
    </div>

</div>

<script>
    $(document).ready(function() {

        $('[data-js-confirm-submit]').bind('submit', function(event) {
            if (!confirm('Are you sure?')){
                event.preventDefault();
            }
        });

    });
</script>
