var canvas;
var stage;

	/**
	 * Init 
	 */
	function init() {
		//alert("canvas");
		canvas = document.getElementById("canvas");
		stage = new createjs.Stage(canvas);

		// Enable touch support
		if (createjs.Touch.isSupported()) { createjs.Touch.enable(stage); }

		//displayLabel();
                displayMoustache();
		displayMonalisa();
		
	}


	/**
	 * Display Label
	 */
	displayLabel = function () {

		// Create a new Text object and a rectangle Shape object, and position them inside a container
		var container = new createjs.Container();
		container.x = 400;
		container.y = 80;
		container.rotation = 45;

		var target1 = new createjs.Shape();
		target1.graphics.beginFill("#F00").drawRect(-10,-10,180,60).beginFill("#FFF");
		container.addChild(target1);



		var txt = new createjs.Text("Monalisa", "36px Arial", "#FFF");
		txt.textBaseline = "top";
		container.addChild(txt);

		stage.addChild(container);

		//Enable drag'n'drop
		enableDrag(container)

	}


        displayMoustache = function () {

		// Create a new Text object and a rectangle Shape object, and position them inside a container
		var container1 = new createjs.Container();
		container1.x = 100;
		container1.y = 80;
                container1.height=50;
                container1.width=50;
		//container.rotation = 180;
                //var  image=new image();
                //image.src="images/moustache2.png";

		var target2 = new createjs.Bitmap("images/tshirt_test.png");

		//target.graphics.beginFill("#F00").drawRect(-10,-10,180,60).beginFill("#FFF");
		container1.addChild(target2);

		//var txt = new createjs.Text("Monalisa", "36px Arial", "#FFF");
		//txt.textBaseline = "top";
		//container.addChild(txt);

		stage.addChild(container1);
                //stage.update();

		// Enable drag'n'drop
		enableDrag(container1)

	} 

        

	/**
	 * Display Monalisa
	 */
	displayMonalisa = function () {

		var image = new Image();
		
		// Invoked when the picture is loaded
		image.onload = function (event) {

			// Display Monalisa
			var monalisa = new createjs.Bitmap(event.target) ;
			stage.addChild(monalisa);
			stage.update();
			
			// Enable drag'n'drop on Picture
			enableDrag(monalisa)

/*var mona1=new createjs.Bitmap(event.target1);
stage.addChild(mona1);
stage.update();
enableDrag(mona1);
*/
			
		}
		image.src = "images/mona.jpg" ;
                image.style.width=500;
                image.style.height=400;

	}


        


	/**
     * Enable drag'n'drop on DisplayObjects
     */
	enableDrag = function (item) {
//alert("enable drag drop");
		// OnPress event handler
		item.onPress = function(evt) {

			var offset = {	x:item.x-evt.stageX, 
							y:item.y-evt.stageY};

			// Bring to front
			stage.addChild(item);

			// Mouse Move event handler
			evt.onMouseMove = function(ev) {
				
				item.x = ev.stageX+offset.x;
				item.y = ev.stageY+offset.y;
				stage.update();
			}
		}
	}

	/**
     * Export and save the canvas as PNG 
     */
	function exportAndSaveCanvas()  {
//alert("export n save");
		// Get the canvas screenshot as PNG
		var screenshot = Canvas2Image.saveAsPNG(canvas, true);

		// This is a little trick to get the SRC attribute from the generated <img> screenshot
		canvas.parentNode.appendChild(screenshot);
		screenshot.id = "canvasimage";	
	        //var name=$('#text').[0].value;
		data = $('#canvasimage').attr('src');
		canvas.parentNode.removeChild(screenshot);


		// Send the screenshot to PHP to save it on the server
		var url = 'upload/export.php';
		$.ajax({ 
		    type: "POST", 
		    url: url,
		    dataType: 'text',
		    data: {
                        //name : name
		        base64data : data
		    }
		});



	}

	/**
     * Export and display the canvas as PNG in a new wind	ow
     */
	function exportAndView()  {
//alert("export n view");
		var screenshot = Canvas2Image.saveAsPNG(canvas, true);
		var win = window.open();
		$(win.document.body).html(screenshot );
	}
