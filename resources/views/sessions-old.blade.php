<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Sessions</title>
    <style type="text/css">
        .session {
            margin: 50px;
            padding: 20px;
            background-color: #407bcc;
            color: white;
            text-align: left;
            width:60%;
            font-size: 30px;
            cursor: pointer;
        }
        .description {
            width:80%;
            display: inline-block;
        }
        .contact {
            width:10%;
            display: inline-block;
        }
        .button {
            background-color: #407bcc;
            color: white;
            margin: 10px;
            padding: 10px;
            font-size: 30px;
            cursor: pointer;
        }
    </style>


    <!-- jQuery -->
    <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
</head>

<body>


<script>
    $(document).ready(function() {
        $(".session").click(function () {
            window.location.href = "/" + this.id + "/user/create";
        });
    });
</script>

@foreach($sessions as $session)
    <div class="session" id="{{ $session->id }}">
        <div class="description">
            {{ $session->getDate() }} - {{ $session->description }} ({{ $session->freePlaces() ?: 'posti disponibili' }})
        </div>
        <div class="contact">
            <button class="button">Contattaci</button>
        </div>
    </div>
@endforeach



</body>
</html>