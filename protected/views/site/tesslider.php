<script>
	$(function() {
		var options = {
            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
            $AutoPlaySteps: 4,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
            $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
            $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

            $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
            $SlideDuration: 160,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
            $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
            $SlideWidth: 157,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
            //$SlideHeight: 150,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
            $SlideSpacing: 20, 					                //[Optional] Space between each slide in pixels, default value is 0
            $DisplayPieces: 4,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
            $ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
            $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
            $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
            $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

		
				
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                $Steps: 4                                       //[Optional] Steps to go for each navigation request, default value is 1
            }
        };
        var jssor_slider = new $JssorSlider$("slider_container1", options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var bodyWidth = document.body.clientWidth;
            if (bodyWidth)
                jssor_slider.$ScaleWidth(Math.min(bodyWidth, 768));
            else
                window.setTimeout(ScaleSlider, 30);
        }
        ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end
	});
</script>
<style>
            
            .jssora03l, .jssora03r
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(../img/a03.png) no-repeat;
                overflow:hidden;
            }
            
            
        </style>
<div id="slider_container1" style="position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 809px; height: 150px; overflow: hidden;">
            <div><img u="image" src="../img/ancient-lady/005.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/006.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/011.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/013.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/014.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/019.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/020.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/021.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/022.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/024.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/025.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/027.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/029.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/030.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/031.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/032.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/034.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/038.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/039.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/043.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/044.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/047.jpg" /></div>
            <div><img u="image" src="../img/ancient-lady/050.jpg" /></div>
        </div>
        
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora03l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora03r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
    </div>