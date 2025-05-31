<?php 
    $mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
    if(!mysqli_connect_errno()) echo mysqli_connect_error();

    $per_page = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($page < 1) $page = 1;

    $sort = $_GET['sort'] ?? 'id';
    $order = $_GET['order'] ?? 'ASC';

    $allowed_sorts = ['id', 'lastname', 'date'];
    if(!in_array($sort, $allowed_sorts)) {
        $sort = 'id';
    }

    if(isset($_GET['sort']) && $_GET['sort'] == $sort) {
        $order = ($order == 'ASC') ? 'DESC' : 'ASC';
    }

    $count_result = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM `notes`");
    $total_rows = mysqli_fetch_assoc($count_result)['total'];
    $total_pages = ceil($total_rows / $per_page);

    if($page > $total_pages && $total_pages > 0) {
        $page = $total_pages;
    }

    $offset = ($page - 1) * $per_page;

    $sql = "SELECT * FROM `notes` ORDER BY `$sort` $order LIMIT $offset, $per_page";
    $res = mysqli_query($mysqli, $sql);
    if(!mysqli_errno($mysqli)) echo mysqli_error($mysqli);
?>


<div class="mb-3">
    <span class="me-2">Сортировать по:</span>
    <a href="index.php?elem=menu&sort=id&order=<?= $sort == 'id' ? ($order == 'ASC' ? 'DESC' : 'ASC') : 'ASC' ?>" 
       class="btn btn-sm btn-<?= $sort == 'id' ? 'primary' : 'outline-primary' ?> me-2">
        ID <?= $sort == 'id' ? ($order == 'ASC' ? '↑' : '↓') : '' ?>
    </a>
    
    <a href="index.php?elem=menu&sort=lastname&order=<?= $sort == 'lastname' ? ($order == 'ASC' ? 'DESC' : 'ASC') : 'ASC' ?>" 
       class="btn btn-sm btn-<?= $sort == 'lastname' ? 'primary' : 'outline-primary' ?> me-2">
        Фамилии <?= $sort == 'lastname' ? ($order == 'ASC' ? '↑' : '↓') : '' ?>
    </a>
    
    <a href="index.php?elem=menu&sort=date&order=<?= $sort == 'date' ? ($order == 'ASC' ? 'DESC' : 'ASC') : 'ASC' ?>" 
       class="btn btn-sm btn-<?= $sort == 'date' ? 'primary' : 'outline-primary' ?>">
        Дате рождения <?= $sort == 'date' ? ($order == 'ASC' ? '↑' : '↓') : '' ?>
    </a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Отчество</th>
      <th scope="col">Дата рождения</th>
      <th scope="col">Email</th>
      <th scope="col">Телефон</th>
      <th scope="col">Комментарий</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = mysqli_fetch_assoc($res)): ?>
    <tr>
      <th scope="row"><?= $row['id']; ?></th>
      <td><a href="edit.php?id=<?= $row['id']; ?>"><?= $row['firstname']; ?></a></td>
      <td><?= $row['name']; ?></td>
      <td><?= $row['lastname']; ?></td>
      <td><?= $row['date']; ?></td>
      <td><?= $row['email']; ?></td>
      <td><?= $row['phone']; ?></td>
      <td><?= $row['comment']; ?></td>
    </tr>
  <?php endwhile; ?>  
  </tbody>
</table>

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <?php if($page > 1): ?>
      <li class="page-item">
        <a class="page-link" href="index.php?elem=menu&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $page-1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php endif; ?>

    <?php 

    $start = max(1, $page - 2);
    $end = min($total_pages, $page + 2);
    
    for($i = $start; $i <= $end; $i++): ?>
      <li class="page-item <?= $i == $page ? 'active' : '' ?>">
        <a class="page-link" href="index.php?elem=menu&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>

    <?php if($page < $total_pages): ?>
      <li class="page-item">
        <a class="page-link" href="index.php?elem=menu&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $page+1 ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</nav>

<div class="text-center text-muted">
  Страница <?= $page ?> из <?= $total_pages ?> | Всего записей: <?= $total_rows ?>
</div>