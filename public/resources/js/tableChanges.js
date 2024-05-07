function moveRow(button) {
    var row = button.parentNode.parentNode;
    var sourceTable = row.closest('table');
    var targetTableId = sourceTable.id === 'left-table' ? 'right-table' : 'left-table';
    var targetTable = document.getElementById(targetTableId);

    row.parentNode.removeChild(row);
    targetTable.querySelector('tbody').appendChild(row);

    updateHiddenFields();
}

function updateHiddenFields() {
    var usersWithTrainer = document.getElementById('left-table-form');
    var usersWithoutTrainer = document.getElementById('right-table-form');

    usersWithTrainer.value = getTableData('left-table');
    usersWithoutTrainer.value = getTableData('right-table');
}

function getTableData(tableId) {
    var data = [];
    var rows = document.getElementById(tableId).getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            data.push(cells[0].textContent.trim());
        }
    }

    return data.join(';');
}