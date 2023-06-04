<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "connection.php";
    date_default_timezone_set('Asia/Manila');
    $dir = 'game_files/'.$_GET['game_id'].'.json';
    $game_file = file_get_contents($dir);
    $game_questions = json_decode($game_file, true);
    $iterator = 0;
    $y = 0;
    $temp_Array = [];
        while ($y < 25){
            $current_iteration = $y;
            $num = rand(0,30);
            $exists = in_array($num, $temp_Array);
            if (!$exists){
                array_push($temp_Array, $num);
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
        <div>
            <p style="color:white; float:left; font-size: 1.5em;">Lives:</p>
            <img src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img src="images\heart.png" alt="" style="height: 85px; width: 85px">
        </div>
    <br>
    <div>
        <p style="float:left; font-size: 1.5em; color:white;">Time:</p>
        <input type="text" style="display: inline; height: 5vh; width: 15vw; border-radius: 10px; justify-items:center;align-items:center; text-align:center" value="">
    </div>
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
let question_randomizer = []
let question_iterator = 0;
let temparray = <?php echo json_encode($temp_Array); ?>;
let game_questions = <?php echo json_encode($game_questions); ?>;

function shuffles(array) {
  var m = array.length, t, i;

    // While there remain elements to shuffle…
    while (m) {

    // Pick a remaining element…
    i = Math.floor(Math.random() * m--);

    // And swap it with the current element.
    t = array[m];
    array[m] = array[i];
    array[i] = t;
  }

  return array;
}

question_randomizer = shuffles(temparray)


$('#question').text(game_questions[temparray[question_iterator]][0])
console.log(temparray)
$(document).on('click', '.bingo-ans', function (){
    if(question_randomizer[question_iterator] == $(this).attr('value')){
        $(this).css({
            backgroundColor: "blue",
            color : "white"
        })
        $(this).prop({disabled: true})
        question_randomizer.splice(question_iterator, 1)
        if (question_iterator < question_randomizer.length){
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        }
        else if (question_iterator == question_randomizer.length){
            question_iterator = 0
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        } else if (question_iterator > question_randomizer.length){
            question_iterator = 0
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        }
        
    } else {
        $(this).css('background-color' , 'red')
        setTimeout(() => {
            $(this).css('background-color' , 'rgb(241, 189, 91)')
        }, 300);
        // question_iterator++
        // $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        console.log(question_iterator)
        console.log(question_randomizer.length)
        question_iterator++
        if (question_iterator < question_randomizer.length){  
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        }
        else if (question_iterator == question_randomizer.length){
            question_iterator = 0
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        } else if (question_iterator > question_randomizer.length){
            question_iterator = 0
            $('#question').text(game_questions[question_randomizer[question_iterator]][0])
        }
    }
})
</script>

</html>