<?php
// Correct the relative paths based on the actual structure of your directories
include '../../../configg.php';  // Going up two levels to access the root folder
include '../../../models/questions.php';  // Going up two levels to access the 'model' folder
include '../../../controller/questionsC.php';  // Going up two levels to access the 'controller' folder

// Process the form when submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $questionText = $_POST['question'] ?? '';  // Use null coalescing operator to avoid undefined index
    $dateCreation = $_POST['date_creation'] ?? '';
    $type = $_POST['type'] ?? '';

    // Validate the form fields
    if (!empty($questionText) && !empty($dateCreation) && !empty($type)) {
        // Create DateTime object
        $dateCreationObj = DateTime::createFromFormat('Y-m-d', $dateCreation);

        // Check if DateTime object creation was successful
        if ($dateCreationObj === false) {
            echo "Error: Invalid date format.";
            exit();
        }

        // Create a new question object (pass null for id_question since it is auto-incremented)
        $question = new questions(null, $questionText, $dateCreationObj, 1, $type);

        // Instantiate the controller
        $questionsC = new questionsC();

        // Add the question using the controller
        $success = $questionsC->addquestion($question);

        if ($success) {
            echo "Question added successfully.";
            header("Location: supportClient.php"); // Redirect to the table view
            exit();
        } else {
            echo "Error: Could not add the question.";
        }
    } else {
        echo "All fields must be filled.";
    }
}
?>
