<?php
	$dir = realpath(__DIR__);

	// include the helper functions
	require_once $dir . '/lib/helpers.php';

	// Define globals
	weddingplanner_define_globals();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Sigma - test</title>
    
    <style type="text/css">
		html, body, #container { width:100%; height: 100%; margin: auto; }
		body { padding: 2%; box-sizing: border-box;}
	</style>
</head>
<body>

	<div id="container"></div>

	<script src="<?php echo WEDDING_API_URL; ?>/dist/js/sigma.min.js"></script>
	<script>
		// these are just some preliminary settings 
		var g = {
			nodes: [],
			edges: []
		};

		// Create new Sigma instance in graph-container div (use your div name here) 
		s = new sigma({
				graph: g,
				container: 'container',
				renderer: {
				container: document.getElementById('container'),
				type: 'canvas'
			},
			settings: {
				minNodeSize: 1,
				maxNodeSize: 10
			}
		});

		// first you load a json with (important!) s parameter to refer to the sigma instance   

		sigma.parsers.json('http://192.168.99.100/sigma-json.php', s,
		function() {
			// this below adds x, y attributes as well as size = degree of the node 
			var i,
			nodes = s.graph.nodes(),
			len = nodes.length;

			for (i = 0; i < len; i++) {
			nodes[i].x = Math.random();
			nodes[i].y = Math.random();
			nodes[i].size = s.graph.degree(nodes[i].id);
			nodes[i].color = nodes[i].center ? '#000' : '#666';
			}

			// Refresh the display:
			s.refresh();

			// ForceAtlas Layout
			s.startForceAtlas2();
		}
		);
	</script>
</body>
</html>