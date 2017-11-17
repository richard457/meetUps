// var room = 1;

// function education_fields() {
 
//     room= room ++;
//     var tr;
//     var objTo = document.getElementById('education_fields');
//     tr= document.createElement("tr");
//     tr.setAttribute("class", "tr removeclass"+room);
//     var rdiv = 'removeclass'+room;
//     tr.innerHTML = '<tr class="tr"> <td style="width: 3.5%;"><button class="col-md-12 btn btn-lg btn-default" style="background:#fff;border:none" type="button" onclick="remove_education_fields('+ room +');"> - </button></td><td class="input_table_cell"><textarea type="text"  onkeydown="autoResize(event)" style="overflow-y:hidden;"  id="agenda" name="agenda[]" value=""></textarea></td><td class="input_table_cell"><textarea type="text" onkeydown="autoResize(event)" style="overflow-y:hidden;"  id="comments" name="comments[]"></textarea></td><td class="input_table_cell"><textarea type="text" type="text" onkeydown="autoResize(event)" style="overflow-y:hidden;"  id="issues" name="issues[]" ></textarea></td><td class="input_table_cell"><textarea type="text" type="text" onkeydown="autoResize(event)" style="overflow-y:hidden;"  id="resposinble" name="resposinble[]"></textarea></td><td class="input_table_cell"><div class="input-group date" id="deadlines'+room+'"><input type="text" id="deadline" name="deadline[]" pacehohder="choose date and time" class="form-control"/> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span> </div></td></tr>';
    
//     objTo.appendChild(tr);


// }
//    function remove_education_fields(rid) {
//        $('.removeclass'+rid).remove();
//    }
function printMetting() {
    var print = document.getElementById('reports').innerHTML;
    var currentFile = document.body.innerHTML;
    document.body.innerHTML = print;
    window.print();
    document.body.innerHTML = currentFile;
}

  var size=0;
   function autoResize(e,id){
      
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13) { //Enter keycode
        var ele=e.target;                          //get the text field
        var t=ele.scrollTop;                       //use scroll top to determine if
        ele.scrollTop=0;
        var tr=document.getElementById('tr'+id); 
        size=ele.offsetHeight+t+t;                            //space is enough
        if(t>0){                                       //If it needs more space....
            tr.style.height=(size)+"px";  //Then add space for it!
        }

        console.log(size);
    }
   
}
function getDetails(){
//var id=document.getElementById('agenda_id').value.a;
var form=$('#getform');
var type = form.attr('method');
var action = form.attr('action');
var data = form.serializeArray();
for(var x=1;x<data.length;x++){
   
    $.ajax({
        url: action,
        type: type,
        data: data[x],
        dataType: "json",
        success: function (datas, textStatus, jqXHR) {
            var row=jqXHR.responseJSON;
           var data=row['data'].length;
           var alldata='';
           if(data > 0){
       
            for(var i=0; i<data;i++){
              
                gets=document.getElementById('getdetails'+row['data'][i].agenda_id);
              
                    if(row['data'][i]){
                        gets.innerHTML+='<tr class="row" style="border-bottom:solid thin;"><td  class="col-md-4">'+row['data'][i].matters+'</td><td  class="col-md-4">'+row['data'][i].action+'</td> <td  class="col-md-2">'+row['data'][i].responsible+'</td><td  class="col-md-2">'+row['data'][i].deadline+'</td></tr>';
                        
                    }
              
               }
               gets.innerHTML+='<tr class="row" style="border-bottom:none;"><td  class="col-md-5"></td><td  class="col-md-3"></td> <td  class="col-md-2"></td><td  class="col-md-2"></td></tr>';
           }
         
                
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON;
           
            $.each(errors, function (index, value) {

                console.log(value);
            });
        }
    });

}
}


window.addEventListener('load', function (e) {
    getDetails();
              
                           
                    });
    

 $(document).ready(function () {
    "use strict";


    
    
     
        function createDiv(msg){
            var div = document.createElement('div');
            div.id='snackbar';
            document.getElementsByTagName('body')[0].appendChild(div);
            var x = document.getElementById("snackbar")
                x.innerHTML =msg;
        }
        function dispalyMessage() {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar")
            // Add the "show" class to DIV
            x.className = "show";
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }

        function checkempty(reviewForm){
            if($(reviewForm).find('input, select, textarea').filter(function(){
                return $(this).val() == '';
             }).length > 0){
                return true;;
          }
          else{
            return false;;
          }
        }

        $("#wordexport").click(function(event) {
            
            $("#reports").wordExport(document.getElementById("title").value);
            
            });


            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };
            
            $('#pdfexport').click(function () {   
                doc.fromHTML($("#reports").html(), 15, 15, {
                    'width': 170,
                        'elementHandlers': specialElementHandlers
                });
                doc.save(document.getElementById("title").value+'.pdf');
            });

        $('#testForm').submit(function (event) {
            event.preventDefault();
            var type = $(this).attr('method');
            var action = $(this).attr('action');
            var data = $(this).serializeArray();
       

            waitingDialog.show();
            $.ajax({
                url: action,
                type: type,
                data: data,
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    var message=jqXHR.responseJSON;
                   
                        waitingDialog.hide();
                        createDiv(message['message']);
                        dispalyMessage();
                        
                   
                    $('#testForm').trigger('reset');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var errors = jqXHR.responseJSON;
                   
                    $.each(errors, function (index, value) {
                        waitingDialog.hide();
                        createDiv(value);
                        dispalyMessage(value);
                    });
                }
            });
       
        });

        $('#quote-carousel').carousel({
          pause: true,
          interval: 4000,
        });
      
           
     

        $(function(){ /* to make sure the script runs after page load */
          
                $("#education_fields").colResizable({
                    liveDrag:true,
                    gripInnerHtml:"<div class='grip'></div>", 
                    draggingClass:"dragging" 
                });
            
             

            $('#datepicker').datetimepicker({
                daysOfWeekDisabled: [0, 6]
            });
          
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


     var waitingDialog = waitingDialog || (function ($) {
        'use strict';
    
        // Creating modal dialog's DOM
        var $dialog = $(
            '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
            '<div class="modal-dialog modal-m">' +
            '<div class="modal-content">' +
                '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                '<div class="modal-body">' +
                    '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                '</div>' +
            '</div></div></div>');
    
        return {
            /**
             * Opens our dialog
             * @param message Custom message
             * @param options Custom options:
             * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
             * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
             */
            show: function (message, options) {
                // Assigning defaults
                if (typeof options === 'undefined') {
                    options = {};
                }
                if (typeof message === 'undefined') {
                    message = 'Loading';
                }
                var settings = $.extend({
                    dialogSize: 'm',
                    progressType: '',
                    onHide: null // This callback runs after the dialog was hidden
                }, options);
    
                // Configuring dialog
                $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                $dialog.find('.progress-bar').attr('class', 'progress-bar');
                if (settings.progressType) {
                    $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                }
                $dialog.find('h3').text(message);
                // Adding callbacks
                if (typeof settings.onHide === 'function') {
                    $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                        settings.onHide.call($dialog);
                    });
                }
                // Opening dialog
                $dialog.modal();
            },
            /**
             * Closes dialog
             */
            hide: function () {
                $dialog.modal('hide');
            }
        };
    
    })(jQuery);

 });
