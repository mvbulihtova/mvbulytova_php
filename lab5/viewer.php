<?php
function getViewer($mysqli, $sort, $page, $order = 'asc') {
    $per_page = 10;
    $allowed_sorts = ['id', 'lastname', 'birthdate'];
    $allowed_orders = ['asc', 'desc'];

    if (!in_array($sort, $allowed_sorts)) $sort = 'id';
    if (!in_array(strtolower($order), $allowed_orders)) $order = 'asc';

    $offset = ($page - 1) * $per_page;

    $total_result = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM notes");
    $total = mysqli_fetch_assoc($total_result)['total'];
    $total_pages = ceil($total / $per_page);

    $res = mysqli_query($mysqli, "SELECT * FROM notes ORDER BY $sort $order LIMIT $offset, $per_page");

    $html = '<table border="1" cellpadding="5"><tr>';
    $headers = ['ID', 'Фамилия', 'Имя', 'Отчество', 'Пол', 'Дата рождения', 'Телефон', 'Адрес', 'Email', 'Комментарий'];
    foreach ($headers as $head) $html .= "<th>$head</th>";
    $html .= '</tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr>';
        foreach ($row as $val) $html .= "<td>" . htmlspecialchars($val) . "</td>";
        $html .= '</tr>';
    }
    $html .= '</table>';

    $html .= '<div class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $class = ($i == $page) ? 'active-page' : '';
        $html .= "<a href='?elem=menu&page=$i&sort=$sort&order=$order' class='$class'>$i</a> ";
    }
    $html .= '</div>';

    $html .= '<div class="sort-controls"><p>Сортировка: ';
    foreach ($allowed_sorts as $field) {
        $html .= "<a href='?elem=menu&sort=$field&order=asc'>" . strtoupper($field) . " ↑</a> ";
        $html .= "<a href='?elem=menu&sort=$field&order=desc'>" . strtoupper($field) . " ↓</a> &nbsp;&nbsp;";
    }
    $html .= '</p></div>';

    return $html;
}
?>
