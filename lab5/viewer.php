<?php
function getViewer($mysqli, $sort, $page) {
    $per_page = 10;
    $allowed_sorts = ['id', 'lastname', 'birthdate'];
    if (!in_array($sort, $allowed_sorts)) $sort = 'id';

    $offset = ($page - 1) * $per_page;

    $total_result = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM notes");
    $total = mysqli_fetch_assoc($total_result)['total'];
    $total_pages = ceil($total / $per_page);

    $res = mysqli_query($mysqli, "SELECT * FROM notes ORDER BY $sort LIMIT $offset, $per_page");

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
        $html .= "<a href='?elem=menu&page=$i&sort=$sort' class='$class'>$i</a> ";
    }
    $html .= '</div>';

    return $html;
}
?>