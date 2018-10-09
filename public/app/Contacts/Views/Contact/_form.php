<?php foreach ($contact->errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
      <?= $error ?>
    </div>
<?php } ?>

<form action="/contacts/<?= isset($contact->id) ? 'update' : 'create' ?>" method="post" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?= $contact->id ?>">
    <div class="form-group">
        <label for="contact_name">Name</label>
        <input type="text" name="name" id="contact_name" value="<?= $contact->name ?>" class="form-control" required>
        <div class="invalid-feedback">
          Must be informed!
        </div>
    </div>
    <div class="form-group">
        <label for="contact_phone">Phone</label>
        <input type="text" name="phone" id="contact_phone" value="<?= $contact->phone ?>" class="form-control" pattern="\(\d{2}\)\s*\d{5}-*\d{4}" title="Invalid format!" data-inputmask="'mask': '(99) 99999-9999'">
        <div class="invalid-feedback">
          Invalid format!
        </div>
    </div>
    <button type="submit" class="btn btn-primary">save</button>
    <a href="/contacts/index" class="btn btn-danger">cancel</a>
</form>

<script>

    (function() {

      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });

        // Adds input masks
        Inputmask().mask(document.querySelectorAll("input"));

      }, false);


    })();
</script>