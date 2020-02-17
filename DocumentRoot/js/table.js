function init(table) {
    for (var i = 0; i < table.rows[0].cells.length; i++)
    {
        var tag = table.rows[0].cells[i].getElementsByTagName('i')[0];
        if (typeof(tag) != 'undefined')
        {
            tag.i = i;
            tag.onclick = function() {
                sortTable(table, this.i);
            }
        }
    }
}

function sortTable(table, column) {
    var tag = table.rows[0].cells[column].getElementsByTagName('i')[0];
    var num = false;
    resetTags(table);
    var rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName('td')[column];
            y = rows[i + 1].getElementsByTagName('td')[column];
            (isNaN(x.innerHTML) && isNaN(y.innerHTML)) ? num = false : num = true;
            if (dir == 'asc') {
                tag.className = "sort fa fa-sort-up";
                if (num) {
                    if (Number(x.innerHTML) > Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else {
                    if (x.innerHTML.startsWith("$") && y.innerHTML.startsWith("$")) {
                        var sx = x.innerHTML.substring(1);
                        sx = sx.split(',').join('');
                        var sy = y.innerHTML.substring(1);
                        sy = sy.split(',').join('');
                        if (Number(sx) > Number(sy)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    else if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else if (dir == 'desc') {
                tag.className = "sort fa fa-sort-down";
                if (num) {
                    if (Number(x.innerHTML) < Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else {
                    if (x.innerHTML.startsWith("$") && y.innerHTML.startsWith("$")) {
                        var sx = x.innerHTML.substring(1);
                        sx = sx.split(',').join('');
                        var sy = y.innerHTML.substring(1);
                        sy = sy.split(',').join('');
                        if (Number(sx) < Number(sy)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    else if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchCount++;
        } else {
            if (switchCount == 0 && dir == 'asc') {
                dir = 'desc';
                switching = true;
            }
        }
    }
}

function resetTags(table) {
    for (i = 0; i < table.rows[0].cells.length; i++)
    {
        var tag = table.rows[0].cells[i].getElementsByTagName('i')[0];
        if (typeof(tag) != 'undefined')
            tag.className = "sort fa fa-sort";
    }
}
