<?php
include 'C:/xampp/htdocs/Forum/controller/questionsC.php';
include 'C:/xampp/htdocs/Forum/Model/questions.php';

$questionController = new questionsC();
$questions = $questionController->listquestion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $updatedquestion = new questions(
        intval($_POST['update_id']),
        $_POST['questions'], 
        new DateTime($_POST['date_creation']), 
        intval($_POST['id']),
        $_POST['type']
    );
    $questionController->updatequestion($updatedquestion, intval($_POST['update_id']));
    header('Location: liste.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./styles/list.css">
    <title>Gestion des Questions</title>
    <style>
        .form-input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
        }
        .btn-edit, .btn-delete {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title manage-users-title">Gestion des Questions</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Date de Création</th>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($questions as $question): ?>
                                    <tr id="question-row-<?= $question['id_question'] ?>">
                                        <form method="POST">
                                            <td>
                                                <input type="text" name="questions" value="<?= htmlspecialchars($question['questions']) ?>" class="form-input" />
                                            </td>
                                            <td>
                                                <input type="datetime-local" name="date_creation" value="<?= htmlspecialchars((new DateTime($question['date_creation']))->format('Y-m-d\TH:i')) ?>" class="form-input" />
                                            </td>
                                            <td>
                                                <input type="number" name="id" value="<?= htmlspecialchars($question['id']) ?>" class="form-input" />
                                            </td>
                                            <td>
                                                <input type="text" name="type" value="<?= htmlspecialchars($question['type']) ?>" class="form-input" />
                                            </td>
                                            <td>
                                                <input type="hidden" name="update_id" value="<?= $question['id_question'] ?>" />
                                                <button type="submit" class="btn-circle btn-edit" aria-label="Update Question">
                                                    <i class="fa fa-save"></i> 
                                                </button>
                                                <a href="deletequestion.php?id=<?= $question['id_question'] ?>" class="btn-circle btn-delete ml-2" aria-label="Delete Question">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
