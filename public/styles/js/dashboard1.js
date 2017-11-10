 $(document).ready(function () {
     "use strict";
     // toat popup js
    //  $.toast({
    //      heading: 'Welcome to Ample admin',
    //      text: 'Use the predefined ones, or specify a custom position object.',
    //      position: 'top-right',
    //      loaderBg: '#fff',
    //      icon: 'warning',
    //      hideAfter: 3500,
    //      stack: 6
    //  })

        //Set the carousel options
        $('#quote-carousel').carousel({
          pause: true,
          interval: 4000,
        });
      
     

        $(function(){ /* to make sure the script runs after page load */
            
                $('.itemlist').each(function(event){ /* select all divs with the item class */
                
                    var max_length = 148; /* set the max content length before a read more link will be added */
                    
                    if($(this).html().length > max_length){ /* check for content length */
                        
                        var short_content 	= $(this).html().substr(0,max_length); /* split the content in two parts */
                        var long_content	= $(this).html().substr(max_length);
                        
                        $(this).html(short_content+
                                     '<a href="#" class="read_more"><br/>Read More</a>'+
                                     '<span class="more_text" style="display:none;">'+long_content+'</span>'); /* Alter the html to allow the read more functionality */
                                     
                        $(this).find('a.read_more').click(function(event){ /* find the a.read_more element within the new html and bind the following code to it */
             
                            event.preventDefault(); /* prevent the a from changing the url */
                            $(this).hide(); /* hide the read more button */
                            $(this).parents('.itemlist').find('.more_text').show(); /* show the .more_text span */
                     
                        });
                        
                    }
                    
                });
             
             
            });
     //ct-visits
     new Chartist.Line('#ct-visits', {
         labels: ['2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015'],
         series: [
    [5, 2, 7, 4, 5, 3, 5, 4]
    , [2, 5, 2, 6, 2, 5, 2, 4]
  ]
     }, {
         top: 0,
         low: 1,
         showPoint: true,
         fullWidth: true,
         plugins: [
    Chartist.plugins.tooltip()
  ],
         axisY: {
             labelInterpolationFnc: function (value) {
                 return (value / 1) + 'k';
             }
         },
         showArea: true
     });
     // counter
     $(".counter").counterUp({
         delay: 100,
         time: 1200
     });

     var sparklineLogin = function () {
         $('#sparklinedash').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
             type: 'bar',
             height: '30',
             barWidth: '4',
             resize: true,
             barSpacing: '5',
             barColor: '#7ace4c'
         });
         $('#sparklinedash2').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
             type: 'bar',
             height: '30',
             barWidth: '4',
             resize: true,
             barSpacing: '5',
             barColor: '#7460ee'
         });
         $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
             type: 'bar',
             height: '30',
             barWidth: '4',
             resize: true,
             barSpacing: '5',
             barColor: '#11a0f8'
         });
         $('#sparklinedash4').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
             type: 'bar',
             height: '30',
             barWidth: '4',
             resize: true,
             barSpacing: '5',
             barColor: '#f33155'
         });
     }
     var sparkResize;
     $(window).on("resize", function (e) {
         clearTimeout(sparkResize);
         sparkResize = setTimeout(sparklineLogin, 500);
     });
     sparklineLogin();
 });
