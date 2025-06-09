<?php
// filepath: c:\xampp\htdocs\parochial-suite\packages\bulk-delete.php
// Usage: 
// $bulkDeleteTableSelector = 'table.data-table'; // or any valid CSS selector for your table
// $user_role must be set in the parent file
?>

<style>
    #bulkDeleteContainer {
        width: 98%;
        margin: auto;
        margin-top: 25px;
        padding: 15px 20px 15px 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: rgb(232, 235, 241);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #bulkDeleteAlert {
        position: relative;
        padding: 12px;
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 4px;
        margin-bottom: 18px;
        display: none;
    }

    #multiDeleteControls {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        gap: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div id="bulkDeleteContainer">
    <div id="bulkDeleteAlert" class="ps-note warning">
        <span id="bulkDeleteAlertMsg"></span>
        <button type="button"
            style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#b71c1c;"
            onclick="document.getElementById('bulkDeleteAlert').style.display='none';" title="Close">&times;</button>
    </div>
    <?php if (isset($user_role) && $user_role === 'administrator'): ?>
        <div id="multiDeleteControls" style="display:none;">
            <label style="font-weight:normal; display: flex; align-items: center; margin: 0;">
                <input type="checkbox" id="multiDeleteToggle" style="transform:scale(1.2);margin-right:8px;">
                Enable Multi Delete
            </label>
            <form method="post" id="multiDeleteForm"
                onsubmit="return confirm('Are you sure you want to delete the selected records?');"
                style="margin: 0; display: flex; align-items: center;">
                <input type="hidden" name="bulk_delete_table"
                    value="<?php echo htmlspecialchars($bulkDeleteDbTable ?? ''); ?>">
                <button type="submit" id="deleteSelectedBtn" name="delete_selected" class="btn btn-primary"
                    style="margin-left: 12px; display: none;">
                    <i class="fas fa-trash"></i> Delete Selected
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>

<script>
    <?php if (isset($user_role) && $user_role === 'administrator'): ?>
        document.addEventListener('DOMContentLoaded', function () {
            // Use the selector passed from the parent file, fallback to 'table.data-table'
            var tableSelector = <?php echo json_encode($bulkDeleteTableSelector ?? 'table.data-table'); ?>;
            var table = document.querySelector(tableSelector);
            var alertDiv = document.getElementById('bulkDeleteAlert');
            var alertMsg = document.getElementById('bulkDeleteAlertMsg');
            var controlsDiv = document.getElementById('multiDeleteControls');
            var deleteBtn = document.getElementById('deleteSelectedBtn');

            if (!table) {
                alertMsg.textContent = "No table found on this page to enable bulk delete.";
                alertDiv.style.display = "block";
                if (controlsDiv) controlsDiv.style.display = "none";
                return;
            } else {
                if (controlsDiv) controlsDiv.style.display = "";
            }

            // Add checkbox column if not already present
            if (!table.querySelector('.rowDeleteChk')) {
                // Add header checkbox
                var thead = table.querySelector('thead tr');
                if (thead) {
                    var th = document.createElement('th');
                    th.innerHTML = '<input type="checkbox" id="selectAll" style="display:none;">';
                    thead.insertBefore(th, thead.firstElementChild);
                }
                // Add row checkboxes
                table.querySelectorAll('tbody tr').forEach(function (row) {
                    var td = document.createElement('td');
                    td.innerHTML = '<input type="checkbox" name="delete_ids[]" class="rowDeleteChk" style="display:none;">';
                    row.insertBefore(td, row.firstElementChild);
                });
            }

            // Multi-delete logic
            var toggle = document.getElementById('multiDeleteToggle');
            var selectAll = document.getElementById('selectAll');

            if (!toggle) return;

            toggle.addEventListener('change', function () {
                var enabled = this.checked;
                document.querySelectorAll('.rowDeleteChk').forEach(function (chk) {
                    chk.style.display = enabled ? '' : 'none';
                    chk.checked = false;
                });
                if (selectAll) {
                    selectAll.style.display = enabled ? '' : 'none';
                    selectAll.checked = false;
                }
                if (deleteBtn) deleteBtn.style.display = 'none';
            });

            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('rowDeleteChk')) {
                    var anyChecked = Array.from(document.querySelectorAll('.rowDeleteChk')).some(chk => chk.checked);
                    if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
                }
                if (e.target.id === 'selectAll') {
                    var enabled = e.target.checked;
                    document.querySelectorAll('.rowDeleteChk').forEach(function (chk) {
                        chk.checked = enabled;
                    });
                    var anyChecked = Array.from(document.querySelectorAll('.rowDeleteChk')).some(chk => chk.checked);
                    if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
                }
            });

            window.toggleSelectAll = function (source) {
                document.querySelectorAll('.rowDeleteChk').forEach(function (chk) {
                    chk.checked = source.checked;
                });
                var anyChecked = Array.from(document.querySelectorAll('.rowDeleteChk')).some(chk => chk.checked);
                if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
            };

            // Show selectAll checkbox click handler
            if (selectAll) {
                selectAll.onclick = function () {
                    window.toggleSelectAll(this);
                };
            }
        });
    <?php endif; ?>
</script>

<?php
if (isset($_POST['delete_selected']) && !empty($_POST['delete_ids']) && !empty($_POST['bulk_delete_table'])) {
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['bulk_delete_table']); // sanitize!
    $ids = array_map('intval', $_POST['delete_ids']); // or use your reg_no logic
    $ids_list = implode(',', $ids);
    $sql = "DELETE FROM `$table` WHERE reg_no IN ($ids_list)";
    // ...run your query...
}
?>