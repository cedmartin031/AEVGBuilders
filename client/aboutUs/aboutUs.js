$(document).ready(function () {

    $("#alertsched").hide();
    $("#scheduleForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "../schedule/scheduleProcess.php",
            //C:\xampp\htdocs\AEVGBuilders\client\schedule\scheduleProcess.php
            type: "POST",
            //dataType: "json",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);
                window.location.href = "../aboutUs/aboutUs.php";
                $('#scheduleForm').trigger("reset");
            }
        });
    });

    // $("#date").change(function (event) {
    //     $("#time9amTo10am").prop("disabled", false);
    //     $("#time10amTo11am").prop("disabled", false);
    //     $("#time11amTo12nn").prop("disabled", false);
    //     $("#time1pmTo2pm").prop("disabled", false);
    //     event.preventDefault();
    //     $.ajax({
    //         url: "scheduleProcess.php",
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             dateChanged: true,
    //             date: $('#date').val()
    //         },
    //         success: function (result) {
                // for (var i = 0; i < result.length; i++) {
                //     if (result[i] == $("#time9amTo10am").val()) {
                //         $("#time9amTo10am").prop("disabled", true);
                //     } else if (result[i] == $("#time10amTo11am").val()) {
                //         $("#time10amTo11am").prop("disabled", true);
                //     } else if (result[i] == $("#time11amTo12nn").val()) {
                //         $("#time11amTo12nn").prop("disabled", true);
                //     } else if (result[i] == $("#time1pmTo2pm").val()) {
                //         $("#time1pmTo2pm").prop("disabled", true);
                //     }
                // }

    //         }
    //     });

    // });

});
