<?php

    /*
     * $id = table-id
     * $json = json of table data
     * $title = table title
     * $headings = array of table headings
     */
    function printTableFromJSON($id, $json, $title, $headings)
    {
        $json = json_decode($json, true);
        print "<h2 class=\"table-heading\">$title</h2>";
        print "<table id=\"$id\">";
        print '<thead><tr>';

        foreach ($headings as $heading)
        {
            ?>
            <th> <?php print $heading; ?><i class="sort fa fa-sort<?php ($heading == $headings[0]) ? print '-up' : print ''; ?>"></i></th>
            <?php
        }

        print '</tr></thead><tbody>';
        for ($i = 0; $i < count($json); $i++)
        {
            print '<tr>';
            foreach ($json[$i] as $key => $value)
            {
                print '<td>' . $value . '</td>';
            }
            print '</tr>';
        }
        print '</tbody></table>';
    }

    function printFunctionTable($id, $json, $title, $headings)
    {
        $json = json_decode($json, true);
        print "<h2 class=\"table-heading\">$title</h2>";
        print "<table id=\"$id\"><thead><tr>";
        foreach ($headings as $heading)
        {
            ?>
            <th> <?php print $heading; ?><i class="sort fa fa-sort<?php ($heading == $headings[0]) ? print '-up' : print ''; ?>"></i></th>
            <?php
        }
        print '<th>Functions</th>';
        print '</tr></thead><tbody>';
        for ($i = 0; $i < count($json); $i++)
        {
            $current = $json[$i];
            print '<tr>';
            foreach ($json[$i] as $key => $value)
            {
                print '<td>' . $value . '</td>';
            }
            print '<td><a class="table-edit" href="edit_user.php?uid=' . $json[$i]['uid'] . '&username=' . $json[$i]['username'] . '"><i class="fa fa-fw fa-edit"></i></a></td>';
            print '</tr>';
        }
        print '</tbody></table>';
    }

?>