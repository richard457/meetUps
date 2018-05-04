function printMetting(reports) {
    var print = document.getElementById(reports).innerHTML;
    var currentFile = document.body.innerHTML;
    document.body.innerHTML = print;
    window.print();
    document.body.innerHTML = currentFile;
}
function exportword(id,title){
    $("#"+id).wordExport(document.getElementById(title).value);
}
function allagenda(){
    var meeting_id=document.getElementById('meeting_ids').value;
    var data = {
        meeting_id: meeting_id,
        _token: document.getElementById('_token').value
    };
    var outputz=document.getElementById('allagenda');
    $.ajax({
        url: '/printallmeetingagenda',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var respz = jqXHR.responseJSON;
            if(respz.status=='ok'){
              
                outputz.innerHTML="";
                for (var i = 0; i < respz.data.length; i++) {
              
                    outputz.innerHTML+=`<li>${respz.data[i].agenda}</li>`;
                }
            }
        }})

  
}

function loadTaskCommets(task_id){

    var data = {
        task_id: task_id,
        _token: document.getElementById('_token').value
    };  
    console.log(task_id);
    var outputa=document.getElementById('taskComments'+task_id);
    outputa.innerHTML="Loading ....";
    $.ajax({
        url: '/loadTaskCommets',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var respa = jqXHR.responseJSON;
            if(respa.status=='ok'){
              
                outputa.innerHTML="";
                for (var i = 0; i < respa.data.length; i++) {
                    outputa.innerHTML+=`
                    <div class="comment-center p-t-10">
                    <div class="comment-body">
                        <div class="user-img">
                            <img src="/images/user.png" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                        </div>
                        <div class="mail-content">
                            <h5>${respa.data[i].comments}
                            </h5>
                            <span class="time">commented ${respa.data[i].created_at}</span>
                            <br/>
                           
                        </div>
                    </div>


                </div>`;
                }
            }else{
                outputa.innerHTML=`<li>none added</li>`;
            }
        }})
}
function allagendacomments(){
    var meeting_id=document.getElementById('meeting_ids').value;
    var data = {
        meeting_id: meeting_id,
        _token: document.getElementById('_token').value
    };
    var outputa=document.getElementById('allagendacomments');
    $.ajax({
        url: '/printallmeetingagendacomments',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var respa = jqXHR.responseJSON;
            if(respa.status=='ok'){
              
                outputa.innerHTML="";
                for (var i = 0; i < respa.data.length; i++) {
              
                    outputa.innerHTML+=`<li>${respa.data[i].agenda}</li>`;
                }
            }else{
                outputa.innerHTML=`<li>none added</li>`;
            }
        }})
}

    
function filterAgenda(input,output,meeting_id){
    var _output=document.getElementById(output);
    var _input=document.getElementById(input).value;
    _output.innerHTML="Loading ...";
    var data = {
        agenda: _input,
        meeting_id: meeting_id,
        _token: document.getElementById('_token').value
    };
    if(_input==''){
        _output.innerHTML="";
    }
    $.ajax({
        url: '/filterAgenda',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var resp = jqXHR.responseJSON;
            if(resp.status=='ok'){
              
                _output.innerHTML="";
                for (var i = 0; i < resp.data.length; i++) {
              
                    _output.innerHTML+=`
                    <div class="comment-center p-t-10"  style="background:#eee; border-bottom:solid 2px gray; padding:3px">
                    <div class="comment-body">
                        <div class="user-img">
                            <img src="/images/agenda.png" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>${resp.data[i].agenda}</h5>
                            <span class="time">${resp.data[i].created_at}</span>
                    
                            <span class="pull-right">
                                <a href="#" data-toggle="modal" data-target="#deleteSlide${resp.data[i].id}" class="btn-rounded btn btn-danger btn-outline">
                                    <i class="ti-close text-danger m-r-5"></i>Delete</a>
                                <a href="#" data-toggle="modal" data-target="#editSlide${resp.data[i].id}" class="btn-rounded btn btn-primary btn-outline">
                                    <i class="ti-close text-primary m-r-5"></i>Edit</a>
                            </span>
                        </div>
                    </div>`;
                
                }
                createDiv(resp.message);
                dispalyMessage();
            }else{
                _output.innerHTML="";
                _output.style.display="none";
                createDiv(resp.message);
                dispalyMessage();
            }
         
           

        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON;

            $.each(errors, function (index, value) {
                createDiv(value);
                dispalyMessage(value);
            });
        }
    });
}
function postTaskComment(){
    var data={
        commenter:document.getElementById('commenter').value,
        task_id:document.getElementById('task_id').value,
        comment:document.getElementById('comment').value,
        _token:document.getElementById('_token').value,

    };
    
    if(data.comment==''){
        alert('You must type samething on comment box to continue');
        return;
    }
    $.ajax({
        url: '/post_task_comment',
        type: 'POST',
        data: data,
        dataType: "json",
        success:  (data, textStatus, jqXHR)=>{
            var resp = jqXHR.responseJSON;
            if(resp.status=='ok'){
               
                document.getElementById('comment').value='';
               return loadTaskCommets(document.getElementById('task_id').value);
               createDiv(resp.message);
               dispalyMessage();
              
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON;

            $.each(errors, function (index, value) {
                console.log(value);
                createDiv(value);
                dispalyMessage(value);
            });
            
        }
    }
);


}

function filterMeeting(input,output){
    var _output=document.getElementById(output);
    var _input=document.getElementById(input).value;
    _output.innerHTML="Loading ...";
    var data = {
        meeting: _input,
        _token: document.getElementById('_token').value
    };
    if(_input==''){
        _output.innerHTML="";
    }
    $.ajax({
        url: '/filterMeeting',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var resp = jqXHR.responseJSON;
            if(resp.status=='ok'){
              
                var s='';
                var c='';
                var dates='';
                _output.innerHTML="";
                for (var i = 0; i < resp.data.length; i++) {
                   // dates=new Date('F d, Y h:i:sa',resp.data[i].date);
                    if(resp.data[i].m_status==0){
                    s=` <button type="text" class="btn-rounded btn btn-warning btn-outline pull-right" id="loadingbtn${resp.data[i].id}" onclick="completeMeeting(${resp.data[i].id})">
                      <i class="ti-close text-success m-r-5"></i>Complete Meeting</button>`;
                 }
                 if(resp.data[i].m_status==1){
                    c=`<a href="#"class="btn-rounded btn btn-success btn-outline pull-right">
                    <i class="fa fa-check m-fa-5"></i></a>`;
                 }

                    _output.innerHTML+=`<hr /><div class="comment-center p-t-10">
                    <div class="comment-body" style="background:#eee; border-bottom:solid 2px gray; padding:3px">
                        <div class="user-img">
                            <img src="/images/meeting.png" style="margin-left:10%;width:70px" alt="user" class="img-circle">
                        </div>
                        <a href="/_meeting/${resp.data[i].id}">
                            <div class="mail-contnet">
                                <h5>${resp.data[i].title}</h5>
                                <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> ${resp.data[i].date}</span>, at <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="text-success">${resp.data[i].venue}</span>
                                <br/>
                               
                                <span class="pull-right">
                                <a href="/_meeting/${resp.data[i].id}" class="btn-rounded btn btn-info btn-outline pull-right">
                                        <i class="ti-close text-danger m-r-5"></i>Open Meeting
                                </a>
                                
                                ${c}
                                ${s}  
                                 </span>

                            </div>
                        </a>
                    </div>
                </div>`
                
                }
                createDiv(resp.message);
                dispalyMessage();
            }else{
                _output.innerHTML="";
                _output.style.display="none";
                createDiv(resp.message);
                dispalyMessage();
            }
         
           

        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON;

            $.each(errors, function (index, value) {
                createDiv(value);
                dispalyMessage(value);
            });
        }
    });
}

function completeMeeting(id){

    var loading = document.getElementById('loadingbtn'+id);
    loading.style.innerHTML = "Loading...";
    var data = {
        id: id,
        _token: document.getElementById('_token').value
    };
    $.ajax({
        url: '/meeting_complete',
        type: 'POST',
        data: data,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var resp = jqXHR.responseJSON;
            if(resp.status=='ok'){

                loading.style.display = "none";
                createDiv(resp.message);
                dispalyMessage();
               return window.location.href="/meeting";
            }else{
                loading.style.innerHTML = "Try again.."; 
            }
           

        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON;

            $.each(errors, function (index, value) {
                createDiv(value);
                dispalyMessage(value);
            });
        }
    });

}
function getDynamicDatepicker(id){
    $('#datepicker'+id).datetimepicker({daysOfWeekDisabled: [0, 6]});
}
function getDetails() {
    //var id=document.getElementById('agenda_id').value.a;
    var form = $('#getform');
    var type = form.attr('method');
    var action = form.attr('action');
    var data = form.serializeArray();
    for (var x = 1; x < data.length; x++) {

        $.ajax({
            url: action,
            type: type,
            data: data[x],
            dataType: "json",
            success: function (datas, textStatus, jqXHR) {
                var row = jqXHR.responseJSON;
                var data = row['data'].length;
                var alldata = '';
                if (data > 0) {

                    for (var i = 0; i < data; i++) {

                        gets = document.getElementById('getdetails' + row['data'][i].agenda_id);

                        if (row['data'][i]) {
                            gets.innerHTML += '<tr class="row" style="border-bottom:solid thin;width:100%;min-width:100%;max-width:100%;"><td  class="col-md-3" style="text-align:left">' + row['data'][i].matters + '</td><td  class="col-md-3" style="text-align:center">' + row['data'][i].action + '</td> <td  class="col-md-3" style="text-align:center">' + row['data'][i].responsible + '</td><td  class="col-md-3" style="text-align:right">' + row['data'][i].deadline + '</td></tr>';

                        }

                    }
                    gets.innerHTML += '<tr class="row" style="border-bottom:none;width:100%;min-width:100%;max-width:100%;"><td  class="col-md-3"></td><td  class="col-md-3"></td> <td  class="col-md-3"></td><td  class="col-md-3"></td></tr>';
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
 
    var ids = document.getElementsByClassName("agendaid");

    for (var i = 0; i < ids.length; i++) {
        var id_val = ids[i];
        var realvalue_id = id_val.value;

        var getagendadata = document.querySelector("#collapsed" + realvalue_id);

        getagendadata.addEventListener("load", loadData(realvalue_id));
        loadMemberOption(realvalue_id);
        getDynamicDatepicker(realvalue_id);
    }

    allagenda();
    allagendacomments();
    loadTaskCommets();

});


function removeagendaDetails(id, agenda) {

    if (confirm('are sure u want to delete this item')) {
        var loading = document.getElementById('wait' + agenda);
        loading.style.display = "block";
        var data = {
            id: id,
            _token: document.getElementById('_token').value
        };
        $.ajax({
            url: '/removeagendaitem',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                var message = jqXHR.responseJSON;

                loading.style.display = "none";
                createDiv(message['message']);
                dispalyMessage();
                document.getElementById('trdata' + id).remove();

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
    }
}

function editAgendaDetails(id){

    var mydata = {
        _token: document.getElementById('_token').value,
        id:id,
        matters:document.getElementById('matters'+id).value,
        action:document.getElementById('action'+id).value,
        agenda_id:document.getElementById('agenda_id'+id).value,
        responsible:document.getElementById('responsible'+id).value,
        deadline:document.getElementById('date'+id).value,
};
   $('#wait' +id).show();


    $.ajax({
        url: '/editagendaDetails',
        type: 'POST',
        data: mydata,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var message = jqXHR.responseJSON;
            $('#wait' + id).hide();
           createDiv(message['message']);
            dispalyMessage();
            return loadData(mydata.agenda_id);
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
}
function loadMemberOption(agenda_id){
    var data = {
        _token: document.getElementById('_token').value
    };
    $.ajax({
        url: '/getMemberOption',
        type: 'GET',
        data: data,
        dataType: "json",
        success:(datas, textStatus, jqXHR)=> {
        
            if (datas['data'].length > 0) {


                for (var i = 0; i < datas['data'].length; i++) {
                    var data = datas['data'][i];
                    getmber = document.getElementById('option_'+agenda_id);
                    getmber1 = document.getElementById('responsible'+agenda_id);
                    if (data) {
                        getmber.innerHTML += `<option value="${data.fullname}#${data.email}">${data.fullname}</option>`;
                        getmber1.innerHTML += `<option value="${data.fullname}#${data.email}">${data.fullname}</option>`;
                    }
                }
            }
        }
    });
    }

    
function loadData(realvalue_id) {
    var loading = document.getElementById('wait' + realvalue_id);
    loading.style.display = "block";
    var data = {
        value: realvalue_id,
        _token: document.getElementById('_token').value
    };

    $.ajax({
        url: '/board',
        type: 'GET',
        data: data,
        dataType: "json",
        success: function (datas, textStatus, jqXHR) {
            loading.style.display = "none";
            if (datas['data'].length > 0) {


                for (var i = 0; i < datas['data'].length; i++) {
                    var data = datas['data'][i];
                    getss = document.getElementById('getagendadata' + data.agenda_id);
                    if (data) {
                        var responsble=data.responsible.split('#');
                        if(responsble){
                            
                        responsble.pop();
                        responsble.join();
                        }
                        // <button type="button"  data-toggle="modal" data-target="#editSlides${data.id}" class="btn btn-sm btn-default fa fa-pencil"></button>
                        getss.innerHTML += `<tr id="trdata${data.id}"><td class="col-md-4">${data.matters}</td>
                            <td class="col-md-3">${data.action}</td>
                            <td class="col-md-2">${data.responsible}</td>
                            <td class="col-md-2">${data.deadline}</td>
                            <td class="col-md-1">
                           
                            <button type="button" style="padding:2px" onclick="removeagendaDetails(${data.id},${data.agenda_id})" class="col-md-12 btn btn-sm btn-danger">-</button>
                            </td></tr>
                            
                            
                            <div class="modal fade" id="editSlides${data.id}" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document" style="background:#fff">
                                <div class="modal-content" style="background:#fff">
                                
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                 </div>
                                 <div class="model-body row clearfix">
                                 <center><wait id="waits${data.id}}" style="display:none">
                                 <svg class="circular" viewBox="25 25 50 50">
                                     <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                                 </svg>
                             </wait>
                          </center>
                                      <input type="hidden" value="${data.agenda_id}" id="agenda_id${data.id}" name="agenda_id">
                                      
                                      <div class="col-md-4">
                                      Matters arising during the Meeting</div>
                                      <div class="col-md-8"> 
                                         <textarea type="text" class="col-md-12"  placeholder="Enter Matters arising during the Meeting" style="overflow-y:hidden;"
                                        id="matters${data.id}">${data.matters}</textarea>
                                       </div>
                                       <br />
                                       <div class="col-md-4">
                                       Action to be taken</div>
                                       <div class="col-md-8">
                                         <textarea type="text" class="col-md-12" placeholder="Enter Action to be taken" style="overflow-y:hidden;"
                                    id="action${data.id}">${data.action}</textarea>
                                       </div>
                                       <div class="clearfix"></div>
                                        <div class="col-md-4">
                                        Select user responsible from member list</div>
                                        <div class="col-md-8">
                                    <select type="text" id="responsible${data.agenda_id}" class="col-md-12 form-control"  placeholder="Enter Responsible Person" style="overflow-y:hidden;" id="responsible" name="responsible">
                                    
                                   </select>
                                       </div>
                                       <br />
                                        <div class="col-md-12"> 
                                            <div class='col-md-12 input-group date' id='datepicker'>
                                                        <input type='text' value="${data.deadline}" id="date${data.id}" class="form-control" placeholder="Choose Deadline date" required>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-12">
                                        <button type="button" onclick="editAgendaDetails(${data.id})" class="col-md-12 btn btn-info">Edit</button>
                                        </div>
                                   
                                  </div> 
                                </div>

                            </div>
                        </div>
                            `;


                    } else {
                        getss.innerHTML = "";
                        getss.remove();
                    }

                }

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

function createDiv(msg) {
    var div = document.createElement('div');
    div.id = 'snackbar';
    document.getElementsByTagName('body')[0].appendChild(div);
    var x = document.getElementById("snackbar")
    x.innerHTML = msg;
}

function dispalyMessage() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
}

function loadallmembers(id){
    var data = {
        _token: document.getElementById('_token').value
    };
    
    var getmembertable=document.getElementById('getmembertable'+id);
    $.ajax({
        url: '/getAllMembers',
        type: 'GET',
        data: data,
        dataType: "json",
        success:(datas, textStatus, jqXHR)=> {
       
            if (datas['data'].length > 0) {
                document.getElementById('submitall'+id).style.display='block';
                getmembertable.innerHTML="";
                for (var i = 0; i < datas['data'].length; i++) {
                    var data = datas['data'][i];

                    // getmber = document.getElementById('option_'+agenda_id);
                    // getmber1 = document.getElementById('responsible'+agenda_id);
                   // if (data) {
                        getmembertable.innerHTML += ` <table class="table">
                                                        <tr><tr>
                                                     <a href="javascript:void(0)">
                                                        <span>
                                                        <input type="checkbox" onclick="checkboxresponsible(${data.id},'${data.email}','${data.fullname}')" id="checkboxresponsible" value="${data.id}">
                                                        ${data.fullname}
                                                            <small class="text-success">${data.email} > ${data.phone} > ${data.address}</small>
                                                      
                                                        </span>
                                                     
                                                    </a>
                                                    <td></tr>
                                                    </table>`;
                      
                   // }
                }
            }
        }
    });
}
var tmp = [];
var tmp_email = [];
var tmp_name = [];
var pushagendaDetails={};
function checkboxresponsible(id,email,name){

    var index  = tmp.indexOf(id);
    var _email = tmp_email.indexOf(email);
    var _name  = tmp_name.indexOf(name);

    if(index != -1){
        tmp.splice(index,1);
        tmp_email.splice(_email,1);
        tmp_name.splice(_name,1);
    }else{
        tmp.push(id);
        tmp_email.push(email);
        tmp_name.push(name);
    } 

}

function finalsaveAgendaDetails(id){
    pushagendaDetails= {
        _token: document.getElementById('_token').value,
        id:id,
        matters:document.getElementById('getmatter'+id).value,
        action:document.getElementById('getaction'+id).value,
        agenda_id:id,
        responsible:tmp_name,
        responsible_id:tmp,
        responsible_email:tmp_email,
        deadline:document.getElementById('getdeadline'+id).value,
};
//


var type = $('#saveAgendaDetailsForm' + id).attr('method');
var action = $('#saveAgendaDetailsForm' + id).attr('action');
$('#wait' + id).show();
 $.ajax({
        url: '/saveAgendaBoard',
        type: 'POST',
        data: pushagendaDetails,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            var message = jqXHR.responseJSON;
            if(data.status == 200){
            //    document.getElementById("resposibleModal"+id).style.display="none";
               pushagendaDetails={};
               document.getElementById('getmatter'+id).value='';
               document.getElementById('getdeadline'+id).value= '';
               document.getElementById('getaction'+id).value= '';
               document.getElementById('closable'+id).click();
              

            }
            $('#wait' + id).hide();
            createDiv(message['message']);
            dispalyMessage();


            $('#Form' + id).trigger('reset');
            
             loadData(mydata[1]['value']);
             setTimeout(function () {
                location.reload()
            }, 100);
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
}

function saveAgendaDetails(id) {
  document.getElementById('getmatter'+id).value= document.getElementById('matter'+id).value;
  document.getElementById('getdeadline'+id).value= document.getElementById('deadline'+id).value;
  document.getElementById('getaction'+id).value= document.getElementById('action'+id).value;

  if(document.getElementById('matter'+id).value=='' || document.getElementById('action'+id).value=='' || document.getElementById('action'+id).value==''){
      alert('Please fill the missing input');

      document.getElementById('getmembertable'+id).innerHTML="<div class='alert alert-info'>Please before submit, make sure that no empty input</div>";
      document.getElementById('submitall'+id).style.display='none';
      return;
  }
  loadallmembers(id);
   

}

$(document).ready(function () {
    "use strict";



    function createDiv(msg) {
        var div = document.createElement('div');
        div.id = 'snackbar';
        document.getElementsByTagName('body')[0].appendChild(div);
        var x = document.getElementById("snackbar")
        x.innerHTML = msg;
    }

    function dispalyMessage() {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar")
        // Add the "show" class to DIV
        x.className = "show";
        // After 3 seconds, remove the show class from DIV
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    }

    function checkempty(reviewForm) {
        if ($(reviewForm).find('input, select, textarea').filter(function () {
                return $(this).val() == '';
            }).length > 0) {
            return true;;
        } else {
            return false;;
        }
    }

    $("#wordexport").click(function (event) {
        $("#reports").wordExport(document.getElementById("title").value);

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
                var message = jqXHR.responseJSON;

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

    $('#_testForm').submit(function (event) {
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
                var message = jqXHR.responseJSON;

                waitingDialog.hide();
                createDiv(message['message']);
                dispalyMessage();
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




    $(function () { /* to make sure the script runs after page load */



        $('#datepicker').datetimepicker({
            daysOfWeekDisabled: [0, 6]
        });

        $('.itemlist').each(function (event) { /* select all divs with the item class */

            var max_length = 148; /* set the max content length before a read more link will be added */

            if ($(this).html().length > max_length) { /* check for content length */

                var short_content = $(this).html().substr(0, max_length); /* split the content in two parts */
                var long_content = $(this).html().substr(max_length);

                $(this).html(short_content +
                    '<a href="#" class="read_more"><br/>Read More</a>' +
                    '<span class="more_text" style="display:none;">' + long_content + '</span>'); /* Alter the html to allow the read more functionality */

                $(this).find('a.read_more').click(function (event) { /* find the a.read_more element within the new html and bind the following code to it */

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
            [5, 2, 7, 4, 5, 3, 5, 4],
            [2, 5, 2, 6, 2, 5, 2, 4]
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