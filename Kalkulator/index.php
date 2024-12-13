<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <div class="calculator bg-light">
        <div class="card">
            <div class="text-end mb-1">
            
                <label class="form-check-label me-0 col-form-label-sm"></label>
                <div class="form-check form-switch d-inline-block">
                    <input class="form-check-input" type="checkbox" id="themeToggle">
                </div>
            </div>
            <div class="card-header text-center bg-primary text-white">
                <h4>Kalkulator Analog</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <?php
    
                    $current = $_POST['display'] ?? '';
                    $history = $_POST['history'] ?? '';
                    $button = $_POST['buton'] ?? ''; 


                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['clear_history'])) {
                            $history = '';
                            $current = '';
                        } elseif ($button === 'C') {
                            $current = '';
                        } elseif ($button === '=') {
                            try {
                                $result = eval("return $current;"); 
                                $history .= $current . ' = ' . $result . PHP_EOL;
                                $current = $result;
                            } catch (Exception $e) {
                                $current = 'Error';
                            }
                        } else {
                            $current .= $button;
                        }
                    }
                    ?>

                    <input type="text" class="form-control mb-3 display" name="display" id="display" readonly
                           value="<?php echo htmlspecialchars($current, ENT_QUOTES); ?>">

                    <div class="row g-2 mb-3">
                        <?php
                        $buttons = [
                            ['7', '8', '9', '/'],
                            ['4', '5', '6', '*'],
                            ['1', '2', '3', '-'],
                            ['0', 'C', '=', '+']
                        ];

                        foreach ($buttons as $row) {
                            foreach ($row as $button) {
                                $class = 'btn-number'; 
                                if (in_array($button, ['/', '*', '-', '+', '='])) {
                                    $class = 'btn-operator';
                                } elseif ($button === 'C') {
                                    $class = 'btn-clear';
                                }

                                echo '<div class="col-3">';
                                echo '<button type="submit" name="buton" value="' . $button . '" class="btn ' . $class . ' w-100 mb-2">' . $button . '</button>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <textarea class="form-control mb-3" name="history" rows="5" readonly><?php
                        echo htmlspecialchars($history, ENT_QUOTES);
                    ?></textarea>
                    <button type="submit" name="clear_history" class="btn btn-clear-history w-100">Clear History</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
