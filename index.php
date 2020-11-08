<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>US Quiz</title>
      
      <!--bootstrap CDN stylesheet-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
      crossorigin="anonymous">
      
      <!--jQuery library-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
      <!--shuffle library-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.11.0/underscore-min.js"></script>
      
      <!--jQuery ready method-->
      <script>
            $(document).ready(function(){
                  
                  //Global Variables
                  var score = 0;
                  var attempts = localStorage.getItem("total_attempts");
                  
                  //event Listeners
                  //"Submit Quiz" button
                  $("button").on("click", gradeQuiz);
                  
                   //Question 5 images
                  $(".q5Choice").on("click", function(){
                        $(".q5Choice").css("background", "");
                        $(this).css("background", "rgb(255, 255, 0)");
                  });
                   
                  // Question 4 shuffler      
                  displayQ4Choices();
                  
                  function displayQ4Choices(){
                        let q4ChoicesArray = ["Maine", "Rhode Island", "Maryland", "Delaware"];
                        q4ChoicesArray = _.shuffle(q4ChoicesArray);
                        for(let i = 0; i <q4ChoicesArray.length; i++){
                              $("#q4Choices").append(` <input type="radio" name="q4" id="${q4ChoicesArray[i]}"
                              value="${q4ChoicesArray[i]}"> <label for="${q4ChoicesArray[i]}"> 
                              ${q4ChoicesArray[i]}</lable>`);
                        }
                  }
                  
                 
                  //functions
                  function isFormValid(){
                        let isValid = true;
                        if ($("#q1").val() == ""){
                              isValid = false;
                              $("#validationFdbk").html("Question 1 was not answered!!!");
                        }
                        return isValid;
                  }
                  
                  function rightAnswer(index){
                        $(`#q${index}Feedback`).html("Correct!");
                        $(`#q${index}Feedback`).attr("class", "bg-success text-white");
                        $(`#markImg${index}`).html("<img src='img/checkmark.png' alt='checkmark'>");
                        score +=10;
                  }
                  
                  function wrongAnswer(index){
                        $(`#q${index}Feedback`).html("Incorrect!");
                        $(`#q${index}Feedback`).attr("class", "bg-danger text-white");
                        $(`#markImg${index}`).html("<img src='img/xmark.png' alt='xmark'>");
                  }
                  
                  function safeZone(){
                        $("#totalScoreMsg").html(`Congratulation!!! You got ${score}.`);
                        $("#totalScoreMsg").attr("class", "bg-success text-white");
                  }
                  
                  function dangerZone(){
                        $("#totalScoreMsg").html(`Oh no!!! You got ${score}.`);
                        $("#totalScoreMsg").attr("class", "bg-danger text-white");
                  }
            
                  
                  function gradeQuiz(){
                        $("#validationFdbk").html(""); //resets validation feedback
                        
                        if(!isFormValid()){
                              return;
                        }
                        
                        //variables
                        score = 0;
                        let q1Response = $("#q1").val().toLowerCase();
                        let q2Response = $("#q2").val();
                        let q4Response = $("input[name=q4]:checked").val();
                        let q6Response = $("#q6").val();
                        let q7Response = $("#q7").val().toLowerCase();
                        let q8Response = $("#q8").val();
                        let q9Response = $("input[name=q9]:checked").val();
                        let q10Response = $("input[name=q10]:checked").val();
                        
                        
                        //Question 1
                        if(q1Response == "sacramento"){
                              rightAnswer(1);
                        }else{
                              wrongAnswer(1);
                        }
                        
                        //Question 2
                        if(q2Response == "mo"){
                              rightAnswer(2);
                        }else{
                              wrongAnswer(2);
                        }
                        
                        //Question 3
                        if($("#Jefferson").is(":checked") && $("#Roosevelt").is(":checked")
                        && !$("#Jackson").is(":checked") && !$("#Franklin").is(":checked")){
                              rightAnswer(3);
                        }else{
                              wrongAnswer(3);
                        }
                        
                        //Question 4
                        if(q4Response == "Rhode Island"){
                              rightAnswer(4);
                        }else{
                              wrongAnswer(4);
                        }
                        
                        //Question 5
                        if($("#seal2").css("background-color") == "rgb(255, 255, 0)"){
                              rightAnswer(5);
                        }else{
                              wrongAnswer(5);
                        }
                        
                        //Question 6
                        if(q6Response == "eq"){
                              rightAnswer(6);
                        }else{
                              wrongAnswer(6);
                        }
                        
                        //Question 7
                        if(q7Response == "yosemite"){
                              rightAnswer(7);
                        }else{
                              wrongAnswer(7);
                        }
                        
                        //Question 8
                        if($("#la").is(":checked") && !$("#ti").is(":checked")
                        && !$("#sd").is(":checked") && !$("#dw").is(":checked")){
                              rightAnswer(8);
                        }else{
                              wrongAnswer(8);
                        }
                        
                        //Question 9
                        if(q9Response == "31st"){
                              rightAnswer(9);
                        }else{
                              wrongAnswer(9);
                        }
                        
                        ///Question 10
                        if($("#gb").is(":checked") && !$("#bay").is(":checked")
                        && (q10Response == "Red")){
                              rightAnswer(10);
                        }else{
                              wrongAnswer(10);
                        }
                        
                        //Total Score Message
                        if(score >= 80){
                              safeZone();
                        }else{
                              dangerZone();
                        }
                        
                        //Submit & total attempts buttons
                        $("#totalScore").html(`Total Score: ${score}`);
                        $("#totalAttempts").html(`Total Attempts: ${++attempts}`);
                        localStorage.setItem("total_attempts", attempts);
                  }
                  
            });//ready
      </script>
</head>
<body class="text-center">
      <!--Main header-->
      <h1 class="jumbotron">US Geography Quiz</h1>
      
      <!--Question 1 on the webpage-->
      <h3><span id="markImg1"></span>What is the capital of California?</h3>
      <input type="text" id="q1"/>
      <br /><br />
      
      <div id="q1Feedback"></div>
      <br />
      
      <!--Question 2 on the webpage-->
      <h3><span id="markImg2"></span>What is the longest river?</h3>
      <select id="q2">
            <option value="">Select One</option>
            <option value="ms">Mississippi</option>
            <option value="mo">Missouri</option>
            <option value="co">Colorado</option>
            <option value="de">Delaware</option>
      </select>
      <br /><br />
      <div id="q2Feedback"></div>
      <br />
      
      <!--Question 3 on the webpage-->
      <h3><span id="markImg3"></span>What presidents are carved into mount Rushmore?</h3>
      <input type="checkbox" id="Jackson"/> <label for="Jackson">A. Jackson</label>
      <input type="checkbox" id="Franklin"/> <label for="Franklin">B. Franklin</label>
      <input type="checkbox" id="Jefferson"/> <label for="Jefferson">T. Jefferson</label>
      <input type="checkbox" id="Roosevelt"/> <label for="Roosevelt">T. Roosevelt</label>
      <br /><br />
      
      <div id="q3Feedback"></div>
      <br />
      
      <!--Question 4 on the webpage-->
      <h3><span id="markImg4"></span>What is the smallest US State?</h3>
      <div id="q4Choices"></div>
      <br /><br />
      <div id="q4Feedback"></div>
      <br />
      
      <!--Question 5 on the webpage-->
      <h3><span id="markImg5"></span>What image is in the Great Seal of the State of California?</h3>
      <img src="img/seal1.png" alt="Seal 1" class="q5Choice" id="seal1" />
      <img src="img/seal2.png" alt="Seal 2" class="q5Choice" id="seal2" />
      <img src="img/seal3.png" alt="Seal 3" class="q5Choice" id="seal3" />
      <br /><br />
      <div id="q5Feedback"></div>
      <br />
      
      <!--Question 6 on the webpage-->
      <h3><span id="markImg6"></span>What happened in 1906 in the State of California?</h3>
      <select id="q6">
            <option value="">Select One</option>
            <option value="ts">Tsunami</option>
            <option value="pl">Plague</option>
            <option value="wa">War</option>
            <option value="eq">Earthquake</option>
      </select>
      <br /><br />
      <div id="q6Feedback"></div>
      <br />
      
      <!--Question 7 on the webpage-->
      <h3><span id="markImg7"></span>What national park was opened in 1890 in California?</h3>
      <input type="text" id="q7"/>
      <br /><br />
      <div id="q7Feedback"></div>
      <br />
      
      <!--Question 8 on the webpage-->
      <h3><span id="markImg8"></span>In 1913, What water activity was completed?</h3>
      <input type="checkbox" id="ti"/> <label for="ti">Titanic</label>
      <input type="checkbox" id="sd"/> <label for="sd">San Diego Aquarium</label>
      <input type="checkbox" id="dw"/> <label for="dw">Disney World</label>
      <input type="checkbox" id="la"/> <label for="la">LA Aqueduct</label>
      <br /><br />
      <div id="q8Feedback"></div>
      <br />
      
      <!--Question 9 on the webpage-->
      <h3><span id="markImg9"></span>In 1850, California became the ____ state of the United States?</h3>
      <input type="radio" name="q9" id="1st" value="1st"/> <label for="1st">1st</label>
      <input type="radio" name="q9" id="11st" value="11st"/> <label for="11st">11st</label>
      <input type="radio" name="q9" id="21st" value="21st"/> <label for="21st">21st</label>
      <input type="radio" name="q9" id="31st" value="31st"/> <label for="31st">31st</label>
      <input type="radio" name="q9" id="41st" value="41st"/> <label for="41st">41st</label>
      <br /><br />
      <div id="q9Feedback"></div>
      <br />
      
      <!--Question 10 on the webpage-->
      <h3><span id="markImg10"></span>In 1937, which bridge was finished and opened up for traffice?</h3>
      <input type="checkbox" id="bay"/> <label for="bay">Bay Bridge</label>
      <input type="checkbox" id="gb"/> <label for="gb">Golden Gate Bridge</label> 
      <input type="radio" name="q10" id="Red" value="Red"/> <label for="Red">Red Color Bridge</label>
      <input type="radio" name="q10" id="Rich" value="Rich"/> <label for="Rich">Richmond Bridge</label>
      <br /><br />     
      <div id="q10Feedback"></div>
      <br />
      
      <!--bootstrap button classes-->
      <h3 id="validationFdbk" class="bg-danger text-white"></h3>
      <button type="button" class="btn btn-outline-primary" data-toggle="button" 
      aria-pressed="false">Submit Quiz</button>
      <br />
      <h2 id="totalScore"></h2>
      <div id="totalScoreMsg"></div>
      
      <h3 id="totalAttempts"></h3>
      
</body>
</html>