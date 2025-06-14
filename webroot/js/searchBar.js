document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = tbody.getElementsByTagName('tr');

    const noRecordsRow = document.createElement('tr');
    const noRecordsCell = document.createElement('td');
    noRecordsCell.className = 'noRecordsCell';
    noRecordsCell.colSpan = table.querySelector('thead tr').cells.length;
    noRecordsCell.textContent = 'No records found';
    noRecordsRow.style.display = 'none';
    noRecordsRow.appendChild(noRecordsCell);
    tbody.appendChild(noRecordsRow);

    searchInput.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        let visibleRows = 0;

        for (let row of rows) {
            if (row === noRecordsRow) continue; // Skip the no records row
            
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let cell of cells) {
                if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
                    found = true;
                    break;
                }
            }

            row.style.display = found ? '' : 'none';
            if (found) visibleRows++;
        }

        noRecordsRow.style.display = visibleRows === 0 ? '' : 'none';
    });
});