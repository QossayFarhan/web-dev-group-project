<?php include "sidebar.php";?>

<div class="container">
    <h1>Code Generator</h1>
    <div class="card text-center border-dark mb-3">
        <div class="card-header">
            Check IN/OUT Code
        </div>
        <div class="card-body">
            <i class="bi bi-stopwatch fa-fw"></i>
            <span id="timer">60</span>
            <h1 id="code"></h1>
        </div>
    </div>
</div>

<script>
    function newCode(){
        $.ajax({
            url: 'code',
            type: 'get',
            success: function(response){
                var code = document.getElementById('code');
                response = JSON.parse(response);
                code.innerHTML = response.new_code;
            }
        });
    }
    function timer(){
        var timer = document.getElementById('timer');
        if(timer.innerHTML > 1){
            timer.innerHTML = timer.innerHTML - 1;
        }
        else{
            newCode();
            timer.innerHTML = 60;
        }
    }
    $(document).ready(function(){
        newCode();
        setInterval(timer,1000);
    });
</script>