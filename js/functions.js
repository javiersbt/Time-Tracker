
var seconds = 0;
var minutes = 0;
var hours = 0;
var running = 0;


/* Function for the timer */
$("#start").click(function(){
    if ( running === 0){
        running = 1;   
        $("#start").text("Stop");
        timer = setInterval(function(){
                    seconds++;
                    if (seconds > 59){
                        seconds = 0;
                        minutes++;
                    }
                    if(minutes > 59){
                        minutes = 0;
                        hours++;  
                    }

            $("#hour").val(hours < 10 ? '0' + hours : hours);
            $("#minute").val(minutes < 10 ? '0' + minutes : minutes);
            $("#second").val(seconds < 10 ? '0' + seconds : seconds);

        }, 1000);
    }
    else {
        running = 0;
        $("#start").text("Resume");
        clearInterval(timer);
    }
});




 /* Function to convert and format the time  */
function secondsToHMS(seconds) {
    var hours = Math.floor(seconds/3600); 
    seconds -= hours*3600;
    var minutes = Math.floor(seconds/60);
    seconds -= minutes*60;
    return (hours < 10 ? '0'+hours : hours)+"h "+(minutes < 10 ? '0'+minutes : minutes)+"m "+(seconds < 10 ? '0'+seconds : seconds)+"s"; 
}


/* Function to get the summary of the tasks of today */
function getSummary(){
    $.ajax({
        url: 'controller.php',
        type: "POST",
        dataType:'json', 
        data: {action: "summary"},
        success: function(response){
            var len = response.length;
            var total = 0;
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth()+1; 
            var year = today.getFullYear();
            today = day + '/' + month + '/' + year;

            $("#summaryTable").find('tbody').html("");

            for( var i=0; i<len; i++ ){
                var task = response[i].taskname;
                var time = response[i].time;

                  $("#summaryTable").find('tbody')
                    .append($('<tr>')
                        .append($('<td>').text(task))
                        .append($('<td>').text(secondsToHMS(time)))

                );

                total = total + Number(response[i].time);
            }
            $("#date").text("Summary of today: " + today);    
            $("#timetd").text(secondsToHMS(total)); 
        }
    });
}


/* Function to save the task */
$("#save").click(function(){
    var hour = $("#hour").val() * 60; 
    var minute = $("#minute").val() * 60;
    var second = $("#second").val();
    var time = Number(hour) + Number(minute) + Number(second); //Convert the time to seconds and sum 
    var taskname = $("#taskname").val();

    if (!taskname){
        $("#result").text("Task name is empty"); //Checks that the task name is not empty
    } else {
        $.ajax({
        url: 'controller.php',
        type: "POST",
        dataType:'text', 
        data: {action: "save", time: time, taskname: taskname},
        success: function(response){
            $("#save").hide();
            $("#start").hide();
            $("#result").text(response);
            getSummary(); //Call to getSummary function to update the table with the new task
        }
    });
    } 
});


/* Load the summary in the table*/
$("#summaryTable").text(getSummary);



