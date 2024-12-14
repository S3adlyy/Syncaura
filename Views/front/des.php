<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Find Your Ideal Pack</title>
    <link rel="shortcut icon" href="imgggg.png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb);
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .quiz-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        h1 {
            color: #007bff;
        }
        .question-box {
            display: none;
        }
        .question-box.active {
            display: block;
        }
        .question {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        button {
            padding: 12px 25px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            display: none;
            margin-top: 30px;
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
            background-color: #f4f4f4;
            text-align: center;
        }
        .pack-promodoro {
            background-color: #cce7ff;
            border-radius: 10px;
            padding: 10px;
        }
        .pack-code-editor {
            background-color: #fff2cc;
            border-radius: 10px;
            padding: 10px;
        }
        .pack-both {
            background: linear-gradient(90deg, #cce7ff 50%, #fff2cc 50%);
            border-radius: 10px;
            padding: 10px;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz: Which Pack is Right for You?</h1>
        <form id="quizForm" method="post">
            <div class="question-box active" data-question="1">
                <p class="question">1. Do you prefer working in a calm environment with music?</p>
                <button type="button" data-answer="promodoro">Yes</button>
                <button type="button" data-answer="code-editor">No</button>
            </div>
            <div class="question-box" data-question="2">
                <p class="question">2. Do you need a tool to organize your thoughts visually?</p>
                <button type="button" data-answer="code-editor">Yes</button>
                <button type="button" data-answer="promodoro">No</button>
            </div>
            <div class="question-box" data-question="3">
                <p class="question">3. Do you find it motivating to work with music?</p>
                <button type="button" data-answer="promodoro">Yes</button>
                <button type="button" data-answer="code-editor">No</button>
            </div>
            <div class="question-box" data-question="4">
                <p class="question">4. Do you prefer organizing your tasks visually?</p>
                <button type="button" data-answer="code-editor">Yes</button>
                <button type="button" data-answer="promodoro">No</button>
            </div>
            <div class="question-box" data-question="5">
                <p class="question">5. Do you enjoy focusing in a calm and immersive atmosphere?</p>
                <button type="button" data-answer="promodoro">Yes</button>
                <button type="button" data-answer="code-editor">No</button>
            </div>
            <div class="question-box" data-question="6">
                <p class="question">6. Do you like using tools to visualize or explain ideas?</p>
                <button type="button" data-answer="code-editor">Yes</button>
                <button type="button" data-answer="promodoro">No</button>
            </div>
            <div class="question-box" data-question="7">
                <p class="question">7. Do you work better when immersed in a musical atmosphere?</p>
                <button type="button" data-answer="promodoro">Yes</button>
                <button type="button" data-answer="code-editor">No</button>
            </div>
            <div class="question-box" data-question="8">
                <p class="question">8. Do you need a platform to jot down and share your ideas visually?</p>
                <button type="button" data-answer="code-editor">Yes</button>
                <button type="button" data-answer="promodoro">No</button>
            </div>
        </form>
        <div class="result" id="resultBox">
            <h2>Your Recommended Pack:</h2>
            <div id="resultText"></div>
            <a href="listPack.php" class="back-button">Back to Packs</a>
        </div>
    </div>

    <script>
        const questions = document.querySelectorAll('.question-box');
        const resultBox = document.getElementById('resultBox');
        const resultText = document.getElementById('resultText');

        let currentQuestion = 0;
        let promodoroCount = 0;
        let codeEditorCount = 0;

        function showNextQuestion() {
            questions[currentQuestion].classList.remove('active');
            currentQuestion++;
            if (currentQuestion < questions.length) {
                questions[currentQuestion].classList.add('active');
            } else {
                showResult();
            }
        }

        function showResult() {
            resultBox.style.display = 'block';
            if (promodoroCount > codeEditorCount) {
                resultText.innerHTML = `<div class="pack-promodoro">Promodoro Pack</div><p>You thrive in an immersive, music-driven workspace.</p>`;
            } else if (codeEditorCount > promodoroCount) {
                resultText.innerHTML = `<div class="pack-code-editor">Code Editor Pack</div><p>Perfect for visually organizing your ideas.</p>`;
            } else {
                resultText.innerHTML = `<div class="pack-both">Both Packs</div><p>Enjoy immersive music and visual tools for your tasks.</p>`;
            }
        }

        document.querySelectorAll('button[data-answer]').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.getAttribute('data-answer');
                if (answer === 'promodoro') {
                    promodoroCount++;
                } else if (answer === 'code-editor') {
                    codeEditorCount++;
                }
                showNextQuestion();
            });
        });
    </script>
</body>
</html>








