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
            <th><?php print $heading; ?><i class="sort fa fa-sort<?php ($heading == $headings[0]) ? print '-up' : print ''; ?>"></i></th>
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
                if ($key == 'username')
                    print "<td><a class=\"table-link\" href=\"view_user.php?uid={$json[$i]['uid']}&username={$json[$i]['username']}\">$value</a></td>";
                else if ($key == 'enabled')
                {
                    $link = '';
                    $text = '';
                    if ($value == 1)
                    {
                        $link = "disable_user.php?uid={$json[$i]['uid']}&username={$json[$i]['username']}";
                        $text = ' enabled';
                    }
                    else if ($value == 0)
                    {
                        $link = "enable_user.php?uid={$json[$i]['uid']}&username={$json[$i]['username']}";
                        $text = ' disabled';
                    }
                    print '<td class="state"><a href="' . $link . '" class="status' . $text . '">' . $text . '</a></td>';
                }
                else
                    print '<td>' . $value . '</td>';
            }
            print '<td><a class="table-edit" href="edit_user.php?uid=' . $json[$i]['uid'] . '&username=' . $json[$i]['username'] . '"><i class="fa fa-fw fa-edit"></i></a>
                    <a class="table-edit table-delete" href="delete_user.php?uid=' . $json[$i]['uid'] . '&username=' . $json[$i]['username'] . '"><i class="fa fa-fw fa-trash"></i></a></td>';
            print '</tr>';
        }
        print '</tbody></table>';
    }

    /*
    * $id = table-id
    * $json = json of table data
    * $title = table title
    * $headings = array of table headings
    * $link = link to use for each row
    * $id_tag = id to pass to link
    * $name_tag = name to pass to link
    */
    function createLinkTable($id, $data, $title, $headings, $link, $id_tag, $name_tag)
    {
        $json = json_decode($data, true);
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
                if ($key == $id_tag)
                    continue;
                
                $str = "";
                if (strpos($link, 'view.php') !== false)
                    $str = '&';
                else
                    $str = '?';

                if ($key == $name_tag)
                    print "<td><a class=\"table-link\" href=\"$link" . $str . "id={$json[$i][$id_tag]}&$name_tag=$value\">$value</a></td>";
                else
                    print "<td>$value</td>";
            }
            print '</tr>';
        }
        print '</tbody></table>';
    }

?>