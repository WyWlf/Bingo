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
    <link rel="stylesheet" href="node_modules/izimodal/css/iziModal.min.css">
    <script src="node_modules/shake/jquery.ui.shake.min.js"></script>
    <title>Bingo!</title>
</head>
<body>
    <div class="title-header"> 
        <img src="images/music.jpg" id="music" style="height: 50px; width: 50px; position:absolute; right: 0; top: 0; margin: 25px">
        <img src="images/x.png" id="music_x" style="height: 50px; width: 50px; position:absolute; right: 0; top: 0; margin: 25px">     
        <p style="color: white; position:absolute; top: 60px; right: 30px">Music</p>
        <h1 class="title">M</h1>
        <h1 class="title">A</h1>
        <h1 class="title">T</h1>
        <h1 class="title">H</h1>
        <h2 id="second-title" style="display: inline">BINGO</h2>
        <img src="images/dog_tp.gif" id="pet" alt="" style="height: 100px; width: 100px; position:relative; display:block">
    </div>
    <div class="question-and-card-div">
    <div id="question-table">
        <div style="display:block">
            <p style="color:white; float:left; font-size: 1.5em;">Lives:</p>
            <img id="placeholder" style="display:none; height: 85px; width: 85px">
            <img id="hp1" src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img id="hp2" src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img id="hp3" src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img id="hp4" src="images\heart.png" alt="" style="height: 85px; width: 85px">
            <img id="hp5" src="images\heart.png" alt="" style="height: 85px; width: 85px">
        </div>
        <div>
        <p style="font-size: 1.5em; color:white; float:left">Time:</p>
        <img src="images/8bit-hrglass.gif" alt="" style="display:inline; height: 85px; width: 85px;">
        <p id="time" style="display:inline; position:relative; bottom: 1.5rem; font-size: 3rem"></p>
        </div>
        <div>
            <p style="float:left; font-size: 1.5em; color:white;">Combo:</p>
            <p id="combo" style="display:inline; font-size: 3rem;">x0</p>
            <img id="combo_img" src="images/combo.gif" style="display: none; height: 40px; width: 40px;">
        </div>
    <br>
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
    </div>
    <!-- Modal structure -->
    <div id="gameover_screen" data-iziModal-title="Game over"  data-iziModal-subtitle="The card will restart..."  data-iziModal-icon="icon-home">
        <div style="display: flex">
         <button class="homepage-btn" id="restart" style="margin: 50px;">Retry</button>
         <button class="homepage-btn" id="quit" style="margin: 50px; background: linear-gradient(0deg, rgba(0,0,0,1) 21%, rgb(255,0,0) 100%)">Quit</button>
        </div>
    </div>
</body>

<script src="node_modules/shake/jquery.ui.shake.js"></script>
<script src="node_modules/izimodal/js/iziModal.min.js"></script>

<script>
$("#gameover_screen").iziModal();
var time = 120;
let hp = 5
let combo_counter = 0
let wrong_answer = new Audio('audio/wronganswer-37702.mp3')
let correct_answer = new Audio('audio/correct.mp3')
let bg_music = new Audio('audio/deemo.mp3')
let combo_music = new Audio('audio/halozy.mp3')
wrong_answer.volume = 0.5
correct_answer.volume = 0.2
bg_music.volume = 0.3
combo_music.volume = 0.3
bg_music.loop = true
combo_music.loop = true
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

function comboEffects(combo, target, border){
    if (combo == 1){
        bg_music.play()
    }
    if (combo == 3){
        $(target).css({
            "display" : "inline"
        })
    }
    if (combo == 4){
        $(border).toggleClass('special')
    }
    if (combo == 5){
        $(border).toggleClass('special')
        $(border).toggleClass('special2')
        bg_music.pause()
        combo_music.play()
    }
    if (combo == 6){
        $(border).toggleClass('special2')
        $(border).toggleClass('special3')
    }
    if (combo == 7){
        $(border).toggleClass('special3')
        $(border).toggleClass('special4')
    }
    correct_answer.play()
    
}

question_randomizer = shuffles(temparray)
$('#question').text(game_questions[temparray[question_iterator]][0])

$(document).on('click', '#music_x', function(){
    bg_music.play()
    bg_music.volume = 0.3
    $('#music_x').css({
        "display": "none"
    })
})



$(document).on('click', '#music', function(){
    bg_music.pause()
    bg_music.volume = 0
    $('#music_x').css({
        "display": "inline-block"
    })
})

setInterval(() => {
        $('#time').text(time+" s")
        time--
    }, 1000);

$(document).on('click', '.bingo-ans', function (){  
    if(question_randomizer[question_iterator] == $(this).attr('value')){
        $(this).css({
            backgroundColor: "blue",
            color : "white"
        })
        $(this).prop({disabled: true})
        correct_answer.load()
        combo_counter++
        $('#combo').text("x"+combo_counter)
        comboEffects(combo_counter, "#combo_img", "#border-card")
        $('#cat').remove()
        $(this).append("<img src='images/cat_like.png' id='cat'; style='position:absolute; height: 80px; width: 80px'>")
        $('#cat').animate({
            top: '-2000px'
        }, 3000, function(){
            $('#cat').remove()
        })
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
        time = 120

    } else {
        $(this).css('background-color' , 'red')
        setTimeout(() => {
            $(this).css('background-color' , 'rgb(241, 189, 91)')
        }, 300);
        question_iterator++
        wrong_answer.load();
        wrong_answer.play();

        $('#border-card').shake({
            speed: 80
        })
        $('#hp'+hp+'').css({
            "display" : "none"
        })

        hp--
        combo_music.currentTime = 0
        combo_music.pause()
        bg_music.play()
        if (combo_counter == 4){
            $('#border-card').toggleClass('special')
        } else if (combo_counter == 5) {
            $('#border-card').toggleClass('special2')
        } else if (combo_counter == 6){
            $('#border-card').toggleClass('special3')
        } else if (combo_counter >= 7){
            $('#border-card').toggleClass('special4')
        }
        combo_counter = 0
        $('#combo').text(combo_counter)

        $('#combo_img').css({
            "display": "none"
        })
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
       time = 120
    }


    if (hp == 0){
        $('body').css({
            "pointer-events" : "none"
        })
        $('#placeholder').css({
            "display" : "inline"
        })
        $('#gameover_screen').css({
            "pointer-events" : "auto"
        })
        $('#gameover_screen').iziModal('open');
    }
})

$(document).on('click', '#restart', function(){
    location.reload()
})



</script>

</html>