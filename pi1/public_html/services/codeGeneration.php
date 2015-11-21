<?php
session_start();

?>

<html>
    <head>
        <title>Code Generator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../styles/new.css" rel="stylesheet" type="text/css">
        <script>
            var stopwatch = 0;
            var endTime = 0;

            function start()
            {
                var lockSerial = "<?php echo $_POST['lockSerial']; ?>";  
                
                document.getElementById("lockSerial").value = lockSerial;
                generateCode(lockSerial);
                endTime = new Date().getTime();
                endTime = endTime + 30000;       
                step();
            }

            function step()
            {
                var currentTime = new Date().getTime();	
                var difference = new Date(endTime -currentTime);	
                var result = LeadingZeroSeconds(difference.getUTCSeconds()) + ":" + LeadingZeroMiliSeconds(difference.getUTCMilliseconds());

                document.getElementById('timeLeft').value = result;                                  
                stopwatch = setTimeout("step()",1);       

                if (difference.getSeconds() == 0 && difference.getMilliseconds() < 10)
                {                    
                    clearTimeout(stopwatch);
                    start();
                }  
            }              

            function LeadingZeroSeconds(time) 
            {
                    return (time < 10) ? "0" + time : + time;
            }

            function LeadingZeroMiliSeconds(time) 
            {            
                if (time < 10)
                    return "00" + time;
                else if (time < 100)
                    return "0" + time;
                else
                    return time;
            }     
            
            function generateCode(lockSerial)
            {
                if (lockSerial != null)
                {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() 
                    {
                        if (request.readyState == 4 && request.status == 200)                         
                            document.getElementById("code").value= request.responseText;                                                           
                    }                
                    request.open("GET", "setOwnerCode.php?lockSerial=" + lockSerial, true);
                    request.send();
                }
            }
	</script>
    </head>
    <body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>Brand</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="aboutDevelopersBack.php">Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h1 class="panel-title" id="stopwatch">Code Generator - Stopwatch</h1>
                            </div> 
                            <br>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Lock</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lockSerial" name="lockSerial" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="inputEmail3" class="control-label">Time Left</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="timeLeft" name="timeLeft" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="inputPassword3" class="control-label">Current Code</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" name="code" readonly>
                                    </div>                                        
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <script>            
            window.onload = start;
        </script>
    </body>
</html>
