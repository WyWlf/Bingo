<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "connection.php";
    date_default_timezone_set('Asia/Manila');
    $dir = 'game_files/'.$_GET['game_id'].'.json';
    $game_file = file_get_contents($dir);
    $game_questions = json_decode($game_file, true);
    $question_iterator = 0;
    $y = 0;
    $temp_Array = [];
    $randomize_question = [];
        while ($y < 30){
            $current_iteration = $y;
            $question_randomizer = rand(0,30);
            $num = rand(0,30);
            $exists = in_array($num, $temp_Array);
            $quest_exists = in_array($question_randomizer, $randomize_question);
            if (!$exists && !$quest_exists){
                array_push($temp_Array, $num);
                array_push($randomize_question, $question_randomizer);
                $y++;
            } else {
                $y = $current_iteration;
                continue;
            }       
        }
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sigmar+One&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <title>Bingo!</title>
</head>
<body>
    <div class="title-header">
        <h1 class="title">M</h1>
        <h1 class="title">A</h1>
        <h1 class="title">T</h1>
        <h1 class="title">H</h1>
        <h2 id="second-title" style="display: inline">BINGO</h2>
    </div>
    <div id="question-table">
        <p style="font-size: 1.5em; color:white">Time:</p> <input type="text" style="height: 5vh; width: 15vw; border-radius: 10px; justify-items:center;align-items:center; text-align:center" value="<?= date('h:i:s a'); ?>">
        <div id="question-board">
            <div id="top-div">
                <p style="font-weight:bold">Question</p>
                <p id="question"></p>
        </div>
    </div>
</div>
        <table id="border-card">
            <th>
            B
            </th>
            <th>
            I
            </th>
            <th>
            N
            </th>
            <th>
            G
            </th>
            <th>
            O
            </th>
        <?php
            $x = 0;
            while ($x < 25){
            $x+=5;
            echo"  
            <tr>
            <td class='bingo-ans' value=".$temp_Array[$x-1].">".$game_questions[$temp_Array[$x-1]][1]."</td>
            <td class='bingo-ans' value=".$temp_Array[$x-2].">".$game_questions[$temp_Array[$x-2]][1]."</td>
            <td class='bingo-ans' value=".$temp_Array[$x-3].">".$game_questions[$temp_Array[$x-3]][1]."</td>
            <td class='bingo-ans' value=".$temp_Array[$x-4].">".$game_questions[$temp_Array[$x-4]][1]."</td>
            <td class='bingo-ans' value=".$temp_Array[$x-5].">".$game_questions[$temp_Array[$x-5]][1]."</td>
            </tr>";
        }
    ?>  
    </table>
</body>

<script>
let question_iterator = 0;
let temparray = <?php echo json_encode($temp_Array); ?>;
let question_randomizer = <?php echo json_encode($randomize_question); ?>;
let game_questions = <?php echo json_encode($game_questions); ?>;

$('#question').text(game_questions[temparray[question_iterator]][0])

$(document).on('click', '.bingo-ans', function (){
    if(question_randomizer[question_iterator] == $(this).attr('value')){
        console.log('correct')
        $(this).css({
            backgroundColor: "blue",
            color : "white"
        })
        $(this).prop({disabled: true})
        question_iterator++
        $('#question').text(game_questions[question_randomizer[question_iterator]][0])
    } else {
        console.log('wrong')
        $(this).css('background-color' , 'red')
        setTimeout(() => {
            $(this).css('background-color' , 'rgb(241, 189, 91)')
        }, 300);
        question_iterator++
        $('#question').text(game_questions[question_randomizer[question_iterator]][0])
    }
})
</script>

</html>