<?php
class Component
{
    function tableFromQuery($queryName, $class = '', $title = '')
    {
        $conn = $GLOBALS["conn"];

        $query = file_get_contents($GLOBALS["paths"]["sql"] . $queryName . '.sql');

        if (isset($query)) {

            if ($result = $conn->query($query)) {

                // get table column names
                $fieldnr = $result->field_count;
                $tableCols = $result->fetch_fields();
                $tableHeaders = '<thead class="thead-light"><tr>';
                foreach ($tableCols as &$value) {
                    $tableHeaders = $tableHeaders . '<th>' . $value->name . '</th>';
                }
                $tableHeaders = $tableHeaders . '</tr></thead>';

                // get table data
                //$tableRows = $result->fetch_array();
                $tableBody = '<tbody class="table-striped">';

                while ($tableRows = $result->fetch_assoc()) {
                    $tableBody = $tableBody . '<tr>';
                    foreach ($tableRows as &$value) {
                        $tableBody = $tableBody . '<td>' . $value . '</td>';
                    }
                    $tableBody = $tableBody . '</tr>';
                }
                $tableBody = $tableBody . "</tbody>";
                $result->close();

                $table = '';

                if ($title != '') {
                    $table = $table . '
                    <div class="row ' . $class . '">
                        <div class="col">
                        <h2>' . $title . '</h2>
                    ';
                }

                $table = $table . '
                        <table class="table table-light">
                            ' . $tableHeaders . '
                            ' . $tableBody . '
                        </table>
                        </div>
                    </div>
                        ';

                return $table;
            }

        } else {
            return "ERROR: No query defined";
        }
    }

    function itemFromColumn($tableName, $colName, $itemType, $itemLabel = null, $attrib, $class = '', $title = '')
    {

        $conn = $GLOBALS["conn"];

        $query = "SHOW FIELDS FROM $tableName where upper(field) = upper('$colName')";

        if (isset($query)) {

            if ($result = $conn->query($query)) {

                // get item data

                $itemData = $result->fetch_assoc();

                $result->close();

                $type = $itemData['Type'];
                preg_match('#\((.*?)\)#', $type, $maxLength);

                $item = '';

                if ($itemLabel != null) {
                    $item = '<label  for="' . $tableName . '_' . $itemData['Field'] . '">' . $itemLabel . '</label>';
                }

                $item = $item . '<input maxlength="' . $maxLength[1] . '" value="' . $itemData['Default'] . '" type="' . $itemType . '"  class="form-control" id="' . $tableName . '_' . $itemData['Field'] . '" placeholder="' . $itemData['Field'] . '" aria-nullable="' . $itemData['Null'] . '" '.$attrib.' />';

                $item = $item . '<br/>';

                return $item;
            }

        } else {
            return "ERROR: No query defined";
        }
    }

    function hGridRow($contentarr = [], $class = '')
    {
        $hGridRow = '<div class="row ' . $class . '">';
        foreach ($contentarr as &$content) {
            $hGridRow = $hGridRow . '
            <div class="col">
              ' . $content . '
            </div>';
        }
        $hGridRow = $hGridRow . '</div>';

        return $hGridRow;
    }

    function vGridRow($contentarr = [], $class = '')
    {
        $vGridRow = '';
        foreach ($contentarr as &$content) {
            $vGridRow = $vGridRow . '
            <div class="row">
                <div class="col">
                ' . $content . '
                </div>
            </div>';
        }

        return $vGridRow;
    }

    function logo($filename)
    {

        $logo = '
        <div class="row">
            <div class="col">
                <img src="' . $GLOBALS["paths"]["img"] . $filename . '" class="img-fluid">
            </div>
        </div>
        ';

        return $logo;
    }

    function buttonPrimary($text, $class = '')
    {
        return '<button type="button" class="btn btn-primary btn-lg btn-block ' . $class . '">' . $text . '</button>';
    }

    function buttonSecondary($text, $class = '')
    {
        return '<button type="button" class="btn btn-secondary btn-lg btn-block ' . $class . '">' . $text . '</button>';
    }

    function javaScript($js)
    {
        $scriptJs = '<script>' . $js . '</script>';
        return $scriptJs;
    }

    function javaScriptFromFile($jsPath)
    {
        $js = file_get_contents($GLOBALS["paths"]["js"] . $jsPath . '.js');
        $scriptJs = '<script>' . $js . '</script>';
        return $scriptJs;
    }

    function htmlFromFile($htmlPath)
    {
        $html = file_get_contents($GLOBALS["paths"]["html"] . $htmlPath . '.html');
        return $html;
    }
}
?>