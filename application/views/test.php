<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.css">
	<script type="text/javascript" rel="stylesheet">
	$(document).ready(function(){
		var $input = $(".typeahead");
        $input.typeahead({
        source: [
            {id: "someId1", name: "Display name 1"},
            {id: "someId2", name: "Display name 2"}
        ],
        autoSelect: true
        });
        
	});  
	</script>
	
	</head>
	<body>
	<input type="text"  class="typeahead" />
	
	</body>
</html>