  function printMetting() {
        var print = document.getElementById('meetting').innerHTML;
        var currentFile = document.body.innerHTML;
        document.body.innerHTML = print;
        window.print();
        document.body.innerHTML = currentFile;
    }
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

$(document).ready(function(){

$.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        $('.send').click(function () {
            $('form').submit(function (e) {
                // e.preventDefault(); in correct function
                e.preventDefault();
                var formdata = $(this).serialize();
                alert(formdata);
                $.ajax({
                    url: 'comment/posts',
                    type: "POST",
                    data: {
                        // you didn't use your 'var formdata'
                        formdata: formdata,
                        '_token': $('input[name=_token]').val()
                    },
                    success: function (response) {
                        alert('works');
                    }
                });
            });
        });
    
});