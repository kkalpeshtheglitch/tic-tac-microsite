<?php

function paging($total_pages, $get_param = '', $targetpage = '', $limit = '') {
    if ($targetpage == '') {
        $targetpage = getCurrentUrl();
    }
    if ($get_param == '')
        $get_param = 'offset';
    $targetpage = removeqsvar($targetpage, $get_param);
    if (isset($_GET[$get_param]) && $_GET[$get_param] > 0)
        $page = $_GET[$get_param];
    else
        $page = 1;
    if ($limit == '')
        $limit = PER_PAGE;
    $targetpage = addqsvar($targetpage, $get_param, $page);
    $prev = $page - 1;       //previous page is page - 1
    $next = $page + 1;
//next page is page + 1
    $lastpage = ceil($total_pages / $limit);
//lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;      //last page minus 1

    /*
      Now we apply our rules and draw the pagination object.
      We're actually saving the code to a variable in case we want to draw it more than once.
     */
    $adjacents = 3;
    $one = 1;
    $two = 2;
    $pagination = "";
	$hiddenXs   = "";
    if ($lastpage > 1) {
        $pagination .= "<div class=\"text-center\"><ul class=\"pagination\">";
//previous button
        if ($page > 1)
            $pagination.= "<li><a href=\"$targetpage$prev\">&larr; "._l('Prev')."</a></li>";
        else
            $pagination.= "<li><a class=\"disabled\">&larr; "._l('Prev')."</a></li>";

//pages
        if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination.= "<li class=\"active $hiddenXs\"><a>$counter</a></li>";
                else
                    $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$counter\">$counter</a></li>";
            }
        }
        elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
//close to beginning; only hide later pages
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active $hiddenXs\"><a >$counter</a></li>";
                    else
                        $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$counter\">$counter</a></li>";
                }
//$pagination.= "...";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$lpm1\">$lpm1</a></li>";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$lastpage\">$lastpage</a></li>";
            }
//in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$one\">1</a></li>";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$two\">2</a></li>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active $hiddenXs\"><a >$counter</a></li>";
                    else
                        $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$counter\">$counter</a></li>";
                }
//$pagination.= "...";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$lpm1\">$lpm1</a></li>";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$lastpage\">$lastpage</a></li>";
            }
//close to end; only hide early pages
            else {
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$one\">1</a></li>";
                $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$two\">2</a></li>";
//$pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class=\"$hiddenXs\"><a class=\"active\">$counter</a></li>";
                    else
                        $pagination.= "<li class=\"$hiddenXs\"><a href=\"$targetpage$counter\">$counter</a></li>";
                }
            }
        }

//next button
        if ($page < $counter - 1)
            $pagination.= "<li><a href=\"$targetpage$next\">"._l('Next')." &rarr;</a></li>";
        else
            $pagination.= "<li><a class=\"disabled\">"._l('Next')." &rarr;</a></li>";
        $pagination.= "</ul></div>";
        echo $pagination;
    }
}

/* * ******************************************************
 * Function Name: SortColumn
 * Purpose: Displays the sort icons for the column headings 
 * Paramters :
 * 			$column  - field in the database that is merged in the ORDER BY clause of the query.
 * 		$title   - column name to be displayed on the screen.
 * Output : Returns as a Hyperlink with given column and field.
 * ***************************************************** */

function SortColumn($column, $title) {
    $sort_type = 'ASC';
    $sort_image = 'no_sort.gif';
    if (($_SESSION['orderby'] == $column) && ($_SESSION['ordertype'] == 'ASC')) {  //asc
        $sort_type = 'DESC';
        $sort_image = 'asc.gif';
    } elseif (($_SESSION['orderby'] == $column) && ($_SESSION['ordertype'] == 'DESC')) { //desc
        $sort_type = 'ASC';
        $sort_image = 'desc.gif';
    }
    $alt_title = 'Sort by ' . ucfirst(strtolower($title)) . " " . strtolower($sort_type);
    $sort_link = "<a href=\"#\" onclick=\"javascript:setPagingControlValues('" . $column . "','" . $sort_type . "'," . $_SESSION['curpage'] . ");\" alt=\"" . $alt_title . "\" title=\"" . $alt_title . "\" >";
    return $sort_link . '<strong>' . $title . '</strong></a>&nbsp;' . $sort_link . '<img src="' . ADMIN_IMAGE_PATH . $sort_image . '" alt="" border="0"></a>';
}

function removeqsvar($url, $varname) {
    list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
    parse_str($qspart, $qsvars);
    unset($qsvars[$varname]);
    $newqs = http_build_query($qsvars);
    $url = trim($urlpart . '?' . $newqs, '?');
    return $url;
}

function addqsvar($url, $varname, $value) {
    if (strpos($url, '?') && count($_GET) > 0)
        return $url . '&' . $varname . '=';
    return $url . '?' . $varname . '=';
}

function getCurrentUrl() {

    return $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function stripString($string, $length = 50) {

    if (strlen($string) <= $length) {
//	$string = $string; //do nothing
        return $string;
    } else {
//$string = substr($string, 0, strpos(wordwrap($string, $length), "\n")).' ...';
        $string = substr($string, 0, $length) . ' ...';
    }

    return $string;
}

function dateFormat($date, $format = 'd/m/Y', $dmy = 0) {
    if ($date == '1970-01-01' || $date == '0000-00-00' || $date == '0000-00-00 00:00:00')
        return '';

    if ($dmy == 1) {

        $date_temp = explode('/', $date);

        $date = $date_temp[1] . '/' . $date_temp[0] . '/' . $date_temp[2];
    }
    return $date = date($format, strtotime($date));
}

function lableName($name) {
    $name = str_replace('_id', ' ', $name);
    $name = str_replace('fk_', ' ', $name);
    $name = str_replace('_', ' ', $name);
    $name = ucWords($name);
    return $name;
}

function escapeSlashes($data) {
    return $data;
}

function numberformat($number) {

    return number_format($number, 2, '.', ',');
}

function trimOrder($order) {

    $order = str_replace('_asc', '', $order);
    $order = str_replace('_desc', '', $order);
    return $order;
}

function getOrderClause($order, $orderby, $field_array = array()) {
    if (count($field_array) <= 0)
        return;

    if (isset($field_array[$order])) {
        $field_order = $field_array[$order];
        $order_clause = " ORDER BY " . $order . " " . $orderby;
    } else {
        $order_clause = '';
    }
    return $order_clause;
}

function getOrderBy($order) {
    $desc = strpos($order, 'desc', strlen($order) - 4);
    if ($desc !== false) {
        $orderby = 'desc';
    } else {
        $orderby = 'asc';
    }

    return $orderby;
}

function displayOrderClause($order = '', $orderby = '', $key_order) {
    $by = '';

    if ($order == $key_order) {

        if ($orderby == 'asc') {
            $by = '_desc';
        } else {
            $by = '_asc';
        }
    }

    return $by;
} 
function displayValue($obj_array, $obj) {
    if (isset($obj_array->$obj)) {
        return trim($obj_array->$obj);
    } else {
        return '';
    }
}
        

function displayID($id) {
    $id = 'PVM1000' . $id;
    return $id;
}
 
function alert($session_val, $class = '') {

    if (isset($_SESSION[$session_val])) {
        $html = '<div class="alert ' . $class . '">';
        $html .= $_SESSION[$session_val];
        $html .= '</div>';

        unset($_SESSION[$session_val]);
        return $html;
    }
}

function getswissdate($res2) {
    $res1 = dateFormat($res2,'Y-m-d');
        $mc = array(
            '01' => 'Januar',
            '02' => 'Februar',
            '03' => 'M&auml;rz',
            '04' => 'April',
            '05' => 'Mai',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'August',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Dezember'
        );

        $new_date_array = explode('-', $res1);
        $new_date[0] = $new_date_array[2] . '.';

        $new_date[1] = $mc[strtolower($new_date_array[1])];
        $new_date[2] = $new_date_array[0];

        $new_date = implode(' ', $new_date);
       $time = dateFormat($res2,'H:i');
        return $new_date.' '.$time;
    }