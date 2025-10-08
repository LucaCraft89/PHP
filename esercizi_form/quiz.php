<?php
require_once("../lib/head.html");

$quizes = [
    [
        "question" => "Best function",
        "answers" => ["1", "4"], // correct answers (example)
        1 => "strtolower()",
        2 => "nothing",
        3 => "rand()",
        4 => "randint()",
    ],
    [
        "question" => "Best fdfwefwe",
        "answers" => ["2", "4"],
        1 => "fwefwe()",
        2 => "fwef",
        3 => "werwe()",
        4 => "werwer()",
    ],
    [
        "question" => "Best fdfwefwe",
        "answers" => ["2", "4"],
        1 => "fwefwe()",
        2 => "fwef",
        3 => "werwe()",
        4 => "werwer()",
    ],
    [
        "question" => "Best fdfwefwe",
        "answers" => ["2", "4"],
        1 => "fwefwe()",
        2 => "fwef",
        3 => "werwe()",
        4 => "werwer()",
    ]
];

?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>
    <div class="container py-4">
        <?php
        // Gather submitted answers (if any) and precompute correctness
        $submitted = isset($_POST['submit-quiz']) ? ($_POST['quiz'] ?? []) : [];
        $perQuestionResult = [];
        $totalCorrect = 0;
        if ($submitted) {
            foreach ($quizes as $qi => $quiz) {
                $correct = $quiz['answers']; // already strings in data
                sort($correct);
                $given = $submitted[$qi] ?? [];
                // Normalize to strings for comparison
                $givenNorm = array_map('strval', $given);
                sort($givenNorm);
                $isCorrect = ($givenNorm === $correct);
                if ($isCorrect)
                    $totalCorrect++;
                $perQuestionResult[$qi] = [
                    'given' => $givenNorm,
                    'correct' => $correct,
                    'ok' => $isCorrect,
                ];
            }
        }
        ?>
        <?php if (!isset($_POST['submit-quiz'])): ?>
            <form name="form_quiz" method="post"
                action="<?php echo htmlspecialchars(basename($_SERVER['SCRIPT_FILENAME'])); ?>">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($quizes as $qIndex => $quiz): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Q<?= $qIndex + 1; ?>. <?= ($quiz['question']); ?></h5>
                                    <ul class="list-group list-group-flush rounded">
                                        <?php foreach ($quiz as $key => $value): ?>
                                            <?php if (is_int($key) && $key >= 1 && $key <= 4): ?>
                                                <?php $inputId = 'q' . $qIndex . '-opt' . $key; ?>
                                                <li class="list-group-item bg-dark text-white p-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="quiz[<?= $qIndex; ?>][]" type="checkbox"
                                                            value="<?= $key; ?>" id="<?= $inputId; ?>">
                                                        <label class="form-check-label" for="<?= $inputId; ?>">
                                                            <?= ($value); ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100" name="submit-quiz">Invia Risposte</button>
                </div>
            </form>
        <?php else: ?>
            <div class="row row-cols-2 row-cols-md-4 g-2 mt-2">
                <?php foreach ($quizes as $qIndex => $quiz): ?>
                    <?php $isCorrect = ($perQuestionResult[$qIndex]['ok'] ?? false); ?>
                    <div class="col">
                        <div class="card bg-<?= $isCorrect ? 'success' : 'danger'; ?> text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">QUIZ <?= $qIndex + 1; ?></h5>
                                <p class="card-text fw-bold mb-0"><?= $isCorrect ? 'Correct' : 'Incorrect'; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-4">
                <a href="<?php echo htmlspecialchars(basename($_SERVER['SCRIPT_FILENAME'])); ?>"
                    class="btn btn-outline-light w-100">Ripeti Quiz</a>
            </div>
        <?php endif; ?>
        <?php if (isset($_POST['submit-quiz'])): ?>
            <div class="mt-4">
                <div class="alert alert-info">
                    Hai risposto correttamente a <strong><?= $totalCorrect; ?></strong> su
                    <strong><?= count($quizes); ?></strong> domande.
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>