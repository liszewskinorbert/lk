<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= !empty($model) ? $model['title'].' - ' : '' ?>My favourite movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="row">
<div class="col-md-4" id="seen"> </div>
<div class="col-md-4" id="new"> </div>
<div class="col-md-4" id="com"> </div>

</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
$(document).ready(function () {
        $.ajax({
            method: 'get',
            url: 'seen.php',
            dataType: 'json',
            success: function(response) {
                $('#seen').html('<h2>pobranych rekordów: ' + response.length + '</h2>');
                $(response).each(function( index, element ) {
                    $('#seen').append('<h3>'+element.title+' (' + element.year + ')</h3>');
                    $('#seen').append('<div>'+element.description+'</div>');
                });
            }
        });

        $.ajax({
            method: 'get',
            url: 'new.php',
            dataType: 'json',
            success: function(response) {
                $('#new').html('<h2>pobranych rekordów: ' + response.length + '</h2>');
                $(response).each(function( index, element ) {
                    $('#new').append('<h3>'+element.title+' (' + element.year + ')</h3>');
                    $('#new').append('<div>'+element.description+'</div>');
                });
            }
        });

        $.ajax({
            method: 'get',
            url: 'coments.php',
            dataType: 'json',
            success: function(response) {
                $('#com').html('<h2>pobranych rekordów: ' + response.length + '</h2>');
                $(response).each(function( index, element ) {
                    //$('#com').append('<h3>'+element.author+' (' + element.author + ')</h3>');
                    $('#com').append('<div>'+element.author+'</div>');
                });
            }
        });

	});

	
	
</script>




</body>
</html>

