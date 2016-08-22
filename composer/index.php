<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoConsoleComposer</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            check();
        });

        function url() {
            return 'main.php';
        }

        function call(func) {
            $("#output").append("\n<span class='text-info'>please wait...\n");
            $("#output").append("\n<span class='text-info'>===================================================================\n");
            $("#output").append("<span class='text-info'>Executing Started");
            $("#output").append("\n<span class='text-info'>===================================================================\n");
            $.post('main.php', {
                    "path": $("#path").val(),
                    "command": func,
                    "function": "command"
                },
                function(data) {
                    $("#output").append(data);
                    $("#output").append("\n<span class='text-info'>===================================================================\n");
                    $("#output").append("<span class='text-info'>Execution Ended");
                    $("#output").append("\n<span class='text-info'>===================================================================\n");
                }
            );
        }

        function check() {
            $("#output").append('\nloading...\n');
            $.post(url(), {
                    "function": "getStatus",
                    "password": $("#password").val()
                },
                function(data) {
                    if (data.composer_extracted) {
                        $("#output").html("Ready. All commands are available.\n");
                        $("button").removeClass('disabled');
                    }
                    else if (data.composer) {
                        $.post(url(), {
                                "password": $("#password").val(),
                                "function": "extractComposer",
                            },
                            function(data) {
                                $("#output").append(data);
                                window.location.reload();
                            }, 'text');
                    }
                    else {
                        $("#output").html("Please wait till composer is being installed...\n");
                        $.post(url(), {
                                "password": $("#password").val(),
                                "function": "downloadComposer",
                            },
                            function(data) {
                                $("#output").append(data);
                                check();
                            }, 'text');
                    }
                });
        }

        function clearConsole() {
            $('#output').empty();
        }

        function requirePackage() {
            pack = $('#package');
            if (pack.val().length != 0) {
                call('require ' + pack);
                pack.val('');
            }
        }
    </script>
    <style>
        #output {
            width: 100%;
            height: 350px;
            overflow: auto;
            background: #000;
            color: green;
        }
        
        ::-webkit-scrollbar {
            visible: hidden;
            display: none;
        }
        
        .buttons button {
            margin-top: 5px;
        }
        
        warning {
            color: #CCBF28;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h1>NoConsoleComposer</h1>
                <hr/>
                <h3>Commands:</h3>
                <button id="self-update" onclick="del()" class="btn btn-default disabled">Update Composer</button><br /><br />
                <div class="input-group">
                    <span class="input-group-addon">Path</span>
                    <input type="text" id="path" class="form-control disabled" placeholder="absolute path to project directory" value="<?=realpath(dirname(__DIR__))?>" />
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Package</span>
                    <input id="package" type="text" class="form-control disabled" placeholder="vendor/package">
                    <span class="input-group-btn">
                        <button id="require" onclick="requirePackage()" class="btn btn-success">require</button>
                    </span>
                </div>
                <h4>List available commands:</h4>
                <div class="buttons" role="commands">
                    <button id="install" onclick="call('install')" class="btn btn-success disabled">install</button>
                    <button id="update" onclick="call('update')" class="btn btn-warning disabled">update</button>
                    <button id="dump-autoload" onclick="call('dump-autoload')" class="btn btn-danger disabled">dump-autoload</button>
                    <button id="list" onclick="call('list')" class="btn btn-primary disabled">list</button>
                    <button id="clear" onclick="clearConsole()" class="btn btn-danger disabled">clear</button>
                </div>
                <h3>Console Output:</h3>
                <pre id="output" class="well"></pre>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</body>

</html>
