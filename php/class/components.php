<?php
class Component
{
    public function tableFromQuery($queryName, $id, $class = '', $title = '')
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
                    $colName = str_replace('_', ' ', $value->name);
                    $tableHeaders = $tableHeaders . '<th>' . $colName . '</th>';
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
                        <table id="'.$id.'" class="table table-striped table-bordered table-light">
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

    public function selectFromQuery($queryName, $name, $type = 'classic', $label = null, $search = false, $class = '', $title = '')
    {
        // $type ['classic', 'search']
        $conn = $GLOBALS["conn"];

        $query = file_get_contents($GLOBALS["paths"]["sql"] . $queryName . '.sql');

        if (isset($query)) {
            if ($result = $conn->query($query)) {

                // get table data
                $select = '';
                $lovReturn = [];
                $lovDisplay = [];

                if ($label != null) {
                    $select = '<label  for="' . $queryName . '">' . $label . '</label>';
                }

                switch ($type) {
                    case 'classic':
                        $select = $select . '<select class="custom-select" name="'. strtoupper($name) .'" id="'.$queryName.'">';

                    break;
                    case 'search':
                        $select = $select . '<br><select class="selectpicker" name="'. strtoupper($name) .'" data-live-search="true" id="'.$queryName.'">';
                        break;

                }

                while ($tableRows = $result->fetch_array()) {
                    array_push($lovDisplay, $tableRows[0]);
                    array_push($lovReturn, $tableRows[1]);
                }

                $lovValues[0] = $lovDisplay;
                $lovValues[1] = $lovReturn;

                for ($i = 0; $i < count($lovValues[0]); $i++) {
                    $display = $lovValues[0][$i];
                    $return = $lovValues[1][$i];
                    $select = $select . '<option value="' . $return . '">' . $display . '</option>';
                }

                $select = $select . '</select>';

                $result->close();

                return $select;
            }
        } else {
            return "ERROR: No query defined";
        }
    }

    public function itemFromColumn($tableName, $colName, $itemType, $itemDefault = null, $itemLabel = null, $attrib = null, $class = '', $title = '')
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

                if (!isset($maxLength[1])) {
                    $maxLength[1] = '999';
                }

                $item = '';

                if ($itemLabel != null) {
                    $item = '<label  for="' . $tableName . '_' . $itemData['Field'] . '">' . str_replace('_', ' ', $itemLabel) . '</label>';
                }

                if ($itemDefault == null) {
                    if ($itemData['Default'] == 'CURRENT_TIMESTAMP') {
                        $itemDefault = date("Y-m-j");
                    } else {
                        $itemDefault = $itemData['Default'];
                    }
                }

                switch ($itemType) {
                    case 'textarea':
                        $item = $item . '<textarea maxlength="' . $maxLength[1] . '" class="form-control" name="'. strtoupper($itemData['Field']) .'" id="' . $tableName . '_' . $itemData['Field'] . '" placeholder="' . str_replace('_', ' ', $itemData['Field']) . '" aria-nullable="' . $itemData['Null'] . '" ' . $attrib . '>' . $itemDefault . '</textarea>';
                    break;
                    default:
                        $item = $item . '<input maxlength="' . $maxLength[1] . '" value="' . $itemDefault . '" type="' . $itemType . '"  class="form-control" name="'. strtoupper($itemData['Field']) .'" id="' . $tableName . '_' . $itemData['Field'] . '" placeholder="' . str_replace('_', ' ', $itemData['Field']) . '" aria-nullable="' . $itemData['Null'] . '" ' . $attrib . ' />';
                }
                

                $item = $item . '<br/>';

                return $item;
            }
        } else {
            return "ERROR: No query defined";
        }
    }

    public function hGridRow($contentarr = [], $class = '')
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

    public function vGridRow($contentarr = [], $class = '')
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

    public function logo($filename)
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

    public function button($text, $type = 'primary', $page = '', $class = '', $id='')
    {
        if ($page != '') {
            $page = ' onclick="javascript:location.href=\'?p='.$page.'\'"';
        }
        return '<button type="button"'.$page.' id="'.$id.'" class="btn btn-'.$type.' btn-lg btn-block '.$class.'">'.$text.'</button>';
    }

    public function javaScript($js)
    {
        $scriptJs = '<script>' . $js . '</script>';
        return $scriptJs;
    }

    public function javaScriptFromFile($jsPath)
    {
        $js = file_get_contents($GLOBALS["paths"]["js"] . $jsPath . '.js');
        $scriptJs = '<script>' . $js . '</script>';
        return $scriptJs;
    }

    public function htmlFromFile($htmlPath)
    {
        $html = file_get_contents($GLOBALS["paths"]["html"] . $htmlPath . '.html');
        return $html;
    }
    
    public function separator($height)
    {
        $separator = '<br style="margin-top:'.$height.'px">';
        return $separator;
    }
    public function form($contentarr = [], $id, $class = '')
    {
        $form = '<form id="'.$id.'">';
        foreach ($contentarr as &$content) {
            $form = $form . $content;
        }
        $form = $form . '</form>';

        return $form;
    }
}
