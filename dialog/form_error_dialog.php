<?php if (!empty($form_error_message)): ?>
    <div class="ps-note warning" id="formErrorDialog"
        style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px;">
        <?php echo $form_error_message; ?>
        <button type="button"
            style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#b71c1c;"
            onclick="
                document.getElementById('formErrorDialog').style.display='none';
                var form = document.querySelector('form');
                if(form) { form.reset(); }
            " title="Close and reload form">&times;</button>
    </div>
<?php endif; ?>