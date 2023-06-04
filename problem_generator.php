<?php
/* 
echo "<pre>";
echo (print_r(storeProblems()));
echo "</pre>";
*/
$game_code = rand(100000, 999999);
$encoded_questionPool = json_encode(storeProblems());
$dir = 'game_files/'.$game_code.'.json';
file_put_contents($dir, $encoded_questionPool);
echo $game_code;
function storeProblems(){
    $i = 0;
    $question_pool = new ArrayObject;
    $mathgen = new ArrayObject;
    while($i <= 30){
        $mathgen = mathGen();
        $question_pool->append(array($mathgen->question, $mathgen->answer));
    $i++;      
    }
    return $question_pool;
}

function mathGen(){
    $first_val = rand(0,50);
    $second_val = rand(0,50);
    $roll = rand(0,3);
    switch($roll){
        case 0:
            $ans = $first_val + $second_val; 
            $question = $first_val." ➕ ".$second_val;
            break;
        case 1:
            $ans = $first_val - $second_val;
            $question = $first_val." ➖ ".$second_val;
            break;
        case 2:
            $mult_val = rand(0,10);
            $ans = $first_val * $mult_val;
            $question = $first_val." ✖️ ".$mult_val;
            break;
        case 3:
            $div_val = rand(0,10);
            $ans = $first_val / $div_val;
            $question = $first_val." ➗ ".$div_val;
            break;
    }
        if (is_float($ans)){
            $ans = number_format($ans, 2);
        }
        $obj_question = (object)[  
            'question' => $question,
            'answer' => $ans
        ];

    return $obj_question;
}

mathGen();
?>
