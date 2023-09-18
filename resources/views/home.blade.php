<?php
use App\Models\Config;
$configs = Config::get();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link>
        <title>Quiz</title>
    </head>
    <body>
        <h1>Quiz</h1>
        <div id="quizContent">
            <div id="progressionWrapper">
                <div id="progressionBar">
                    <div id="progression">
                    </div>
                </div>
                <p id="indexQuestion"></p>
            </div>
            <h2 id="question"></h2>
            <div id="responses">
                <button id="a" onclick="userResponse = 'a', pickResponse()"></button>
                <button id="b" onclick="userResponse = 'b', pickResponse()"></button>
                <button id="c" onclick="userResponse = 'c', pickResponse()"></button>
                <button id="d" onclick="userResponse = 'd', pickResponse()"></button>
            </div>
            <p id="message"></p>
            <button onclick="validateResponse()">Valider</button>
        </div>
        
        <a href="{{ route('configs.index')}}" id="linkQuestionDashboard">Gérer les questions</a>
    </body>
</html>



<!-- script quiz dynamique -->
<script >
    
    let elementQuestion = document.getElementById('question');
    let divResponse = document.getElementById('responses');
    let responses = divResponse.querySelectorAll('button');
    let message = document.getElementById('message');
    let indexQuestion = document.getElementById('indexQuestion');
    let quizContent = document.getElementById('quizContent');
    let progressionBar = document.getElementById('progression');

    const configs = {!! json_encode($configs) !!};
    let numberQuestion = configs.length
    let i = 0
    let userResponse = "";
    let score = 0


    //add the title and the answer possibilitys to h2 and button
    function addText(){
        if(configs[i]){
            elementQuestion.textContent = configs[i]['title']
            let possibility = JSON.parse(configs[i]['possibility'])
            responses.forEach(element => {
                element.textContent = possibility[element.id]
                element.style.border = '1px solid #9D9D9D';
            });
            userResponse = ""
            message.textContent = ""
            indexQuestion.textContent = i +"/"+numberQuestion
            progressionBar.style.width = ((i/numberQuestion)*100) + "%";
        }else{
            indexQuestion.textContent = i +"/"+numberQuestion
            quizContent.textContent = "";
            let para = document.createElement("p");
            let text = document.createTextNode("Fin du quiz, votre score est de : "+score+" points.");
            let buttonRetry = document.createElement("button");
            buttonRetry.setAttribute("onclick", "retry()");
            buttonRetry.textContent = "Réessayer";
            para.appendChild(text);
            quizContent.appendChild(para);
            quizContent.appendChild(buttonRetry);

        }
    }
    function pickResponse(){
        let buttonResponse = document.getElementById(userResponse);
        responses.forEach(element => {
                element.style.border = '1px solid #9D9D9D';
            })
        buttonResponse.style.border = '2px solid #5465E5';
    }

    //validate the reponse
    function validateResponse(){
        if(userResponse == ""){
            message.textContent = 'veuillez choisir une réponse';
        }else{
            if(userResponse == configs[i]['answer']){
            message.textContent = 'bonne réponse';
            score ++
            }else{
                message.textContent = 'mauvaise réponse';
            }
        
            setTimeout(() => {
                i++,
                addText()
            }, 1000);
        }
       
    }

    function retry(){
        location.reload();
    }

    addText()
</script>
<!-- <script type="text/javascript" src="{{ asset('quiz.js') }}"></script> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo Black">

<style>
    body{
        margin:0; 
        background-image:url('https://img.freepik.com/photos-gratuite/fond-ecran-colore-flou-artistique_58702-8178.jpg?w=900&t=st=1695034145~exp=1695034745~hmac=eae3fa7f20d0a438fe8ec0367417f9c69288d272d8df10e5194842b256040fbf');
        background-size:cover;
        background-repeat:no-repeat;
        color:white;
        text-align:center;
        font-family: 'Archivo Black', serif;
    }
    h1{
        font-size:64px;
    }
    #quizContent{
        display:flex;
        flex-direction:column;
        align-items:center;
        margin:auto;
        width:60vw;
        height:60vh;
        background: #FFF;
        box-shadow: 20px 20px 2px 0px rgba(0, 0, 0, 0.25), 10px 10px 2px 0px rgba(255, 255, 255, 0.50);
    }
    #progressionWrapper{
        display:flex;
        justify-content:center;
        align-items:center;
        width:100%;
        margin-left:auto;
        margin-right:auto;
        padding-top:10px;
    }
    #progressionBar{
        height:15px;
        width:80%;
        border: 1px solid #9D9D9D;
        background-color:#F9F7FA;
    }
    #progression{
        height:15px;
        background-color:#5465E5;
        transition-duration :1s;
    }
    #indexQuestion{
        color:#787878;
        padding:0px 0px 0px 20px;
    }
    #question{
        padding:0px 20px 0px 20px;
        font-size:24px;
        color:#5465E5;
    }
    #responses{
        display:flex;
        align-items:center;
        justify-content:space-between;
    }
    #responses>button{
        font-family:'Archivo Black', serif;
        border-radius:0px;
        border: 1px solid #9D9D9D;
        background: #F9F7FA;
        color: #787878;
        margin:0px 10px 0px 10px;
        width: 200px;
        height:100px;
    }
    #quizContent>button{
        font-family:'Archivo Black', serif;
        border-radius:0px;
        border: 1px solid #5465E5;
        background: #5465E5;
        color: white;
        width: 100px;
        height:50px;
    }
    #message{
        color:#787878;
    }
    #quizContent>p{
        color:#787878;
    }
    #linkQuestionDashboard{
        display: block;
        padding:50px 0px 0px 0px;
        color:white;
    }

</style>
    