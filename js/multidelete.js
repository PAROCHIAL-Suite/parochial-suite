function setupMultiDelete(toggleId, rowChkClass, selectAllId, deleteBtnId) {
    var toggle = document.getElementById(toggleId);
    var selectAll = document.getElementById(selectAllId);
    var deleteBtn = document.getElementById(deleteBtnId);

    if (!toggle) return;

    toggle.addEventListener('change', function () {
        var enabled = this.checked;
        document.querySelectorAll('.' + rowChkClass).forEach(function (chk) {
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
        if (e.target.classList.contains(rowChkClass)) {
            var anyChecked = Array.from(document.querySelectorAll('.' + rowChkClass)).some(chk => chk.checked);
            if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
        }
        if (e.target.id === selectAllId) {
            var enabled = e.target.checked;
            document.querySelectorAll('.' + rowChkClass).forEach(function (chk) {
                chk.checked = enabled;
            });
            var anyChecked = Array.from(document.querySelectorAll('.' + rowChkClass)).some(chk => chk.checked);
            if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
        }
    });
}

function toggleSelectAll(source, rowChkClass, deleteBtnId) {
    document.querySelectorAll('.' + rowChkClass).forEach(function (chk) {
        chk.checked = source.checked;
    });
    var anyChecked = Array.from(document.querySelectorAll('.' + rowChkClass)).some(chk => chk.checked);
    var deleteBtn = document.getElementById(deleteBtnId);
    if (deleteBtn) deleteBtn.style.display = anyChecked ? '' : 'none';
}