<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Signature</title>
    <meta name="description" content="Signature">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="/assets/signature_pad/css/signature-pad.css">

    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="/assets/signature_pad/css/ie9.css">
    <![endif]-->


</head>
<body onselectstart="return false">

<div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
        <canvas></canvas>
    </div>
    <div class="signature-pad--footer">
        <div class="description">Sign above</div>

        <form method="post" action="/sig" id="sigForm">
            <input id="image" name="image" type="hidden">
            <input id="student_id" name="student_id" type="hidden" value="{{ $student->id }}">
            {{ csrf_field() }}
            <div class="signature-pad--actions">
                <div>
                    <button type="button" class="button clear" data-action="clear">Clear</button>
                </div>
                <div>
                    <button type="button" class="button save" data-action="save">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="/assets/signature_pad/js/signature_pad.js"></script>
<script src="/assets/signature_pad/js/app.js?v=1.3"></script>
</body>
</html>
