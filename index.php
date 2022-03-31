<?php

require_once "Connection.php";
$connection = new Connection();
$notes = $connection->getNotes();
//echo '<pre>';
//var_dump($notes);
//echo '</pre>';

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => '',
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes App</title>
</head>
<body>
<form action="save.php" method="post">
    <input type="hidden" name="id" value="<?= $currentNote['id'] ?>">
    <input type="text" name="title" placeholder="Note title" value="<?= $currentNote['title'] ?>">
    <textarea name="description" cols="30" rows="4"
              placeholder="Note Description"><?= $currentNote['description'] ?></textarea>
    <button>
        <?php if ($currentNote['id']): ?>
            Update Note
        <?php else: ?>
            New Note
        <?php endif; ?>
    </button>
</form>

<div class="notes">
    <?php foreach ($notes as $note): ?>
        <div class="note">
            <div class="title">
                <a href="?id=<?= $note['id']; ?>"><?= $note['title']; ?></a>
            </div>
            <div class="description">
                <?= $note['description']; ?>
            </div>
            <small>
                <?= $note['create_date']; ?>
            </small>
            <form action="delete.php" method="post">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button class="close">X</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>


</body>
</html>
