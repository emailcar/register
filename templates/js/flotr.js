 /**
 * 默认页
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: ascoon
 *$explain: form flotr graph
*/


/*
* d1 is dot
* create line chart
*/
 function lines(d1,x_max){
      (function () {
        var
        container = document.getElementById('editor-render-0'),
        start = (new Date).getTime(),
        data, graph, offset, i,
        //d1 = [[0, 30], [4, 80], [8, 50], [9, 130]], // First data series
    	d2 = [];                                    // Second data series
        // Draw a sine curve at time t
        function animate (t) {
          data = [];
          //offset = 2 * Math.PI * (t - start) / 10000;

          // Sample the sine function
          for (i = 0; i < x_max; i += 10) {
   			 d2.push([i, Math.sin(i)]);
 			 }

          // Draw Graph
          graph = Flotr.draw(container, [ d1, /*, d2 */], {
		    xaxis: {
		      minorTickFreq: 5
		    }, 
		    grid: {
		      minorVerticalLines: true
		    }
		  });

          // Animate
        }
        animate(start);
      })();
  }
/*
* create sin() chart
*/
function sin(){
   (function () {
        var
          container = document.getElementById('editor-render-0'),
          start = (new Date).getTime(),
          data, graph, offset, i;

        // Draw a sine curve at time t
        function animate (t) {

          data = [];
          offset = 2 * Math.PI * (t - start) / 10000;

          // Sample the sine function
          for (i = 0; i < 4 * Math.PI; i += 0.2) {
            data.push([i, Math.sin(i - offset)]);
          }

          // Draw Graph
          graph = Flotr.draw(container, [ data ], {
            yaxis : {
              max : 2,
              min : -2
            }
          });

          // Animate
          setTimeout(function () {
            //animate((new Date).getTime());
          }, 50);
        }

        animate(start);
      })();
  }
  /*
  *
  */
  function bars(d1,d2){
    var
    container = document.getElementById('editor-render-0'),
    horizontal = (horizontal ? true : false),  // Show horizontal bars
    //d1 = [],                                 // First data series
    //d2 = [],                                 // Second data series
    point,                                    // Data point variable declaration
    i;
    
              
  // Draw the graph
  Flotr.draw(
    container,
    [d1, d2],
    {
      bars : {
        show : true,
        horizontal : horizontal,
        shadowSize : 0,
        barWidth : 5
      },
      mouse : {
        track : true,
        relative : true
      },
      yaxis : {
        min : 0,
        autoscaleMargin : 1
      }
    }
    );
  }
//line chart click function
function lines_f(){
  $(document).ready(function(){
      d1 = [[0, 30], [10, 20], [20, 50], [30, 130],[40, 110]];
        x_max = 5;
        lines(d1,x_max);
    });
}
//sin chart click function
function sin_c(){
  sin();
}
//bars click function 
function bars_c(){
  d1 = [[0, 30], [10, 20], [20, 50], [30, 130],[40, 110]];
  d2 = [[5, 10], [15, 15], [25, 30], [35, 100],[45, 110]];
  bars(d1,d2);
}
lines_f();//主页默认图表函数
