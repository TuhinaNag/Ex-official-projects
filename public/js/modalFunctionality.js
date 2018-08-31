// Script for the edit bot modal functionality
$('.editBtn').on("click", function (event) {
    event.preventDefault();
    $('#editBotModal').modal('show');

    //Table cell selector
    var botId               = $(this).parent().parent().find(".botId").attr('botID');
    var botName             = $(this).parent().parent().find(".botName");
    var chatfuelBotId       = $(this).parent().parent().find(".chatfuelBotId");
    var broadcastApiToken   = $(this).parent().parent().find(".broadcastApiToken");

    //Populate those values of cell in the modal text area
    $('#editBotName').val($.trim(botName.text()));
    $('#editChatfuelBotId').val($.trim(chatfuelBotId.text()));
    $('#editApiToken').val($.trim(broadcastApiToken.text()));

    //Url for Ajax to hit
    var makeUrl = '/update/'+botId;

    //Submitting the form
    $('#updateBotForm').submit(function (e) {
        var form = $(this);
        e.preventDefault();

        //Serializing all the input.
        var formData = $('#updateBotForm').serialize();


        //Storing updated value from modal in a variable for future reference
        var updatedBotNameFromModal = $('#editBotName').val();
        var updatedBotIdFromModal = $('#editChatfuelBotId').val();
        var updatedBroadcastApiTokenFromModal = $('#editApiToken').val();

        //Ajax to send request to the server and update the values without pageload
        $.ajax({
            method: 'POST',
            url: makeUrl,
            data: formData
        })
        .done(function (res) {
            form.unbind('submit').submit();
            botName.html(updatedBotNameFromModal);
            chatfuelBotId.html(updatedBotIdFromModal);
            broadcastApiToken.html(updatedBroadcastApiTokenFromModal);
            $('#editBotModal').modal('hide');

            //Sweet alert after update
            swal({
                title: "Done!",
                text: "The bot details updated successfully",
                icon: "success",
                button: "Okay"
            });
        });
    });
});

//Sweet alert after delete
$('.deleteBtn').on('click',function(e) {
    swal({
        title: "Done!",
        text: "The bot deleted successfully",
        icon: "success",
        button: "Okay"
    });
});

//Sweet alert after add the bot
$('#addBot').on('click', function (e) {
    swal({
        title: "Done!",
        text: "The bot added successfully",
        icon: "success",
        button: "Okay"
    });
});

var objedit;
var makeVarUrl;
// Script for the edit variable modal functionality
$('.editVar').on("click", function (event) {
    event.preventDefault();
    $('#editVarModal').modal('show');
    objedit =$(this);

    //Table cell selector
    var varId             = $(this).parent().parent().find(".varId").attr('varId');
    var varName           = $(this).parent().parent().find(".varName").attr('varName');
    var botName           = $(this).parent().parent().find(".botName").attr('botName');
    var dataType          = $(this).parent().parent().find(".dataType").find('span').attr('datatype');
    var datatypeText      = $(this).parent().parent().find(".dataType").find('span').attr('datatypeText');
    var initialValue      = $(this).parent().parent().find(".initialValue").attr('initialValue');
    var currentValue      = $(this).parent().parent().find(".currentValue").attr('currentValue');
    var defaultValue      = $(this).parent().parent().find(".defaultValue").attr('defaultValue');

    //Populate those values of cell in the modal text area
    $('#editvarId').val(varId);
    $('#updateVarName').val(varName);
    $('#updateDataType').val(dataType);
    $('#editVarName').text(varName);
    $('#editDataType').text(datatypeText);
    $('#editBotName').val(botName);
    $('#editInitialVal').val(initialValue);
    $('#editCurrentVal').val(currentValue);
    $('#editDefaultVal').val(defaultValue);
    //Url for Ajax to hit

    makeVarUrl = '/updatevar/'+varId;
  
});

    //Submitting the form
$('#updateVarForm').submit(function (e) {
    var form = $(this);
    e.preventDefault();

    //Serializing all the input.
    var formData = $('#updateVarForm').serialize(); 

    //Storing updated value from modal in a variable for future reference
    var updatedInitialValFromModal = $('#editInitialVal').val();
    var updatedDefaultValFromModal = $('#editDefaultVal').val();
    var updatedCurrentValFromModal = $('#editCurrentVal').val();
    //Ajax to send request to the server and update the values without pageload
    $.ajax({
        method: 'POST',
        url: makeVarUrl,
        data: formData
    })
    .done(function (res) {
        console.log(res);
        //form.unbind('submit').submit();
        var initialValue = objedit.parent().parent().find(".initialValue");
        var defaultValue = objedit.parent().parent().find(".defaultValue");
        var currentValue = objedit.parent().parent().find(".currentValue");
        initialValue.html(updatedInitialValFromModal);
        defaultValue.html(updatedDefaultValFromModal);
        currentValue.html(updatedCurrentValFromModal);
        $('#editVarModal').modal('hide');

        //Sweet alert after update
        swal({
            title: "Done!",
            text: "The variable details updated successfully",
            icon: "success",
            button: "Okay"
        });

        objedit = '';
        makeVarUrl = '';
    });
});


//Sweet alert after delete
$('.deleteVar').on('click',function(e) {
    swal({
        title: "Done!",
        text: "The bot deleted successfully",
        icon: "success",
        button: "Okay"
    });
});

//Sweet alert after add the bot
$('#addGlobalVarform').submit(function (e) {
    var form = $(this);
    e.preventDefault();

    //Serializing all the input.
    var formData = $('#addGlobalVarform').serialize(); 
    var formsubmiturl = $(this).attr('action');

    //Ajax to send request to the server and update the values without pageload
    $.ajax({
        method: 'POST',
        url: formsubmiturl,
        data: formData
    })
    .done(function (res) {
        //form.unbind('submit').submit();
        var obj  = JSON.parse(res);
        if(obj.status == 1){
            //Sweet alert after update
            swal({
                title: "Done!",
                text: "The veriable added successfully",
                icon: "success",
                button: "Okay"
            });
            location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: "The variable already exist",
                icon: "error",
                button: "Okay"
            }); 
        }

    });
});

