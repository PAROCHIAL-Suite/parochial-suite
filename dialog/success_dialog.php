<?php
function show_success_dialog($success_message, $form_id = null)
{
    if (!empty($success_message)): ?>
        <div class="ps-note success" id="formSuccessDialog"
            style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px; background:#e6f9ea; color:#256029; border:1px solid #b2dfdb;">
            <?php echo $success_message; ?>
            <button type="button"
                style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#256029;"
                onclick="
                    document.getElementById('formSuccessDialog').style.display='none';
                    <?php if ($form_id): ?>
                        var form = document.getElementById('<?php echo addslashes($form_id); ?>');
                        if(form) { form.reset(); }
                    <?php endif; ?>
                " title="Close and reload form">&times;</button>
        </div>
    <?php endif;
}
?>