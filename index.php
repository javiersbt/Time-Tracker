<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Time Tracker</title>
        <meta charset="utf-8" />						
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="header">
            <h2 style="margin: 0px auto;">Time Tracker</h2>
        </div>

        <div class="content">
            <div class="task" > 
                <div class="taskname-div">
                    <label for="taskname">Task Name:</label>
                    <input type="text" id="taskname">
                </div>   
                    <div class="time-div" style="width: 15em">
                        <input type="text" class="input-timer" id="hour" value="00" disabled style="width: 1.5em"> 
                        <input type="text" class="input-timer" id="minute" value="00" disabled style="width: 1.5em"> 
                        <input type="text" class="input-timer" id="second"  value="00" disabled style="width: 1.5em"> 
                        <button id="start">Start >></button>
                    </div>
                <div class="save-div">
                    <button id="save" style="width:100%">Save Task</button>
                </div>
                <div id="result"></div>
            </div>

            <div id="summary" >
                <h2 id="date"></h2>
                <table id="summaryTable">
                    <thead>
                        <th>Task</th>
                        <th>Time</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr style="font-weight: bold">
                            <td >TOTAL: </td>
                            <td id="timetd"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <script src="js/functions.js"></script>
    </body>
</html>
