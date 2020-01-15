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
        ?>
            <table id="<?php print $id; ?>">
                <thead>
                    <tr>
                <?php
                foreach ($headings as $heading)
                {
                    ?>
                    <th> <?php print $heading; ?><i class="sort fa fa-sort<?php ($heading == $headings[0]) ? print '-up' : print ''; ?>"></i></th>
                    <?php
                } ?>
                    </tr>
                </thead>
                <tbody>
        <?php
        for ($i = 0; $i < count($json); $i++)
        {
            print '<tr>';
            foreach ($json[$i] as $key => $value)
            {
                print '<td>' . $value . '</td>';
            }
            print '</tr>';
        } ?>
                </tbody>
            </table>
        <?php
    }

?>