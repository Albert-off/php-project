<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $questionTitle = $_POST['question_title'];
    $question1Text = $_POST['question1_text'];
    $answer1Text = $_POST['answer1_text'];
    $question2Text = $_POST['question2_text'];
    $answer2Text = $_POST['answer2_text'];
    $question3Text = $_POST['question3_text'];
    $answer3Text = $_POST['answer3_text'];
    $question4Text = $_POST['question4_text'];
    $answer4Text = $_POST['answer4_text'];
    $question5Text = $_POST['question5_text'];
    $answer5Text = $_POST['answer5_text'];
    $question6Text = $_POST['question6_text'];
    $answer6Text = $_POST['answer6_text'];


    // Получение соединения с базой данных через PDO
    $pdo = getPDO();

    // SQL-запрос для обновления данных
    $query = 
        "UPDATE home_page_content SET 
            question_title = :question_title, 
            question1_text = :question1_text, 
            answer1_text = :answer1_text, 
            question2_text = :question2_text, 
            answer2_text = :answer2_text, 
            question3_text = :question3_text, 
            answer3_text = :answer3_text, 
            question4_text = :question4_text, 
            answer4_text = :answer4_text,
            question5_text = :question5_text, 
            answer5_text = :answer5_text,
            question6_text = :question6_text, 
            answer6_text = :answer6_text   
        WHERE id = 1";

    $params = [
        'question_title' => $questionTitle,
        'question1_text' => $question1Text,
        'answer1_text' => $answer1Text,
        'question2_text' => $question2Text,
        'answer2_text' => $answer2Text,
        'question3_text' => $question3Text,
        'answer3_text' => $answer3Text,
        'question4_text' => $question4Text,
        'answer4_text' => $answer4Text,
        'question5_text' => $question5Text,
        'answer5_text' => $answer5Text,
        'question6_text' => $question6Text,
        'answer6_text' => $answer6Text
    ];

    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute($params);
        echo json_encode(['status' => 'success']);  // Ответ в формате JSON
    } catch (\Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        die($e->getMessage());
    }
}
