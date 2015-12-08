$('.ableToDeleteMyAccount').click(function () {
    if (confirm('This will delete all your user activity on the site. Are you sure to delete your account?')) {
        var url = $(this).attr('url');
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    window.location = response.redirectUrl;
                } else {
                    alert(response.message);
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while requesting to delete your account. Please try again');
            }
        });
    }
});


function ableToChangeStatus(recordId) {
    if (confirm('Are you sure ?')) {
        var id = 'ableToChangeStatus' + recordId;
        var url = $('#ableToChangeStatus' + recordId).attr('url');
        $.ajax({
            url: url,
            type: "POST",
            data: 'id=' + recordId,
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    if (response.recordStatus == 1) {
                        $('#' + id + ' span').attr('class', 'glyphicon glyphicon-ok');
                        $('#' + id).attr('title', 'Make Inactive');
                        $('#status_td' + recordId).html('Active');
                        $('#rowId' + recordId).attr('class', 'success');
                    } else {
                        $('#' + id + ' span').attr('class', 'glyphicon glyphicon-ban-circle');
                        $('#status_td' + recordId).html('Inactive');
                        $('#rowId' + recordId).attr('class', 'danger');
                        $('#' + id).attr('title', 'Make Active');
                    }
                } else {
                    alert('Status not updated successfully');
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while requesting to change status. Please try again');
            }
        });
    }
}

$('.ableToDelete').click(function () {
    if (confirm('Are you sure ?')) {
        var id = $(this).attr('id');
        var url = $(this).attr('url');
        var recordId = id.split('ableToDelete')[1];
        $.ajax({
            url: url,
            type: "POST",
            data: 'id=' + recordId,
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success' && response.recordDeleted == 1) {
                    $('#rowId' + recordId).fadeOut();
                } else {
                    alert('Deletion not successful');
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while requesting to delete the record. Please try again');
            }
        });
    }
});

function ableToDeleteRole(recordId) {
    if (confirm('Are you sure to delete this role?')) {
        var obj = $('#ableToDeleteRole' + recordId);
        deleteRole(obj);
    }
}
function deleteRole(obj, confirmed) {
    var id = obj.attr('id');
    var url = obj.attr('url');
    var recordId = id.split('ableToDeleteRole')[1];
    var data = confirmed ? 'id=' + recordId + '&confirmed=1' : 'id=' + recordId;
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        beforeSend: function () {
            $('#window_progress').show();
        },
        success: function (response) {
            if (response.status == 'blocked') {
                alert(response.message);
            } else if (response.status == 'staged') {
                if (response.childOrParent == false) {
                    deleteRole(obj, 1);
                } else if (response.childOrParent == true) {
                    if (confirm('This Role has ' + response.children + ' child role(s) and ' + response.parent + ' parent role(s).\n Do you really want to proceed?')) {
                        deleteRole(obj, true);
                    }
                }
            } else if (response.status == 'success' && response.recordDeleted == 1) {
                $('#rowId' + recordId).fadeOut();
            } else {
                alert('Deletion not successful');
            }
        },
        complete: function () {
            $('#window_progress').hide();
        },
        error: function () {
            alert('There was a problem while requesting to delete the record. Please try again');
        }
    });
}

$("#userRoleParent").change(function () {
    var id = $(this).val();
    var url = $(this).attr('url');
    $.ajax({
        url: url,
        type: "POST",
        data: 'id=' + id,
        //dataType:'json',
        //beforeSend:function(){   $('#window_progress').show();  },
        success: function (response) {
            $("#userRoleChild").html(response);
            var url = $("#userRoleChild").attr('url');
            var allControllerMode = $("#allControllerMode").val();
            var controller = $("#allControllerFilter").val();
            $.ajax({
                url: url,
                type: "POST",
                data: 'id=' + id + '&controllerMode=' + allControllerMode + '&controller=' + controller,
                //dataType:'json',
                beforeSend: function () {
                    $('#window_progress').show();
                },
                success: function (response) {
                    $("#permissionSectionBody").html(response);
                },
                complete: function () {
                    $('#window_progress').hide();
                },
                error: function () {
                    alert('There was a problem while requesting to delete the record. Please try again');
                }
            });
        },
        complete: function () {
            //$('#window_progress').hide();   
        },
        error: function () {
            alert('There was a problem while requesting to delete the record. Please try again');
        }
    });
});

$("#userRoleChild").click(function () {
    var parentId = $("#userRoleParent").val();
    var childId = $(this).val();
    var controller = $("#allControllerFilter").val();
    var allControllerMode = $("#allControllerMode").val();
    var url = $(this).attr('url');
    $.ajax({
        url: url,
        type: "POST",
        data: 'id=' + parentId + '&child=' + childId + '&controllerMode=' + allControllerMode + '&controller=' + controller,
        //dataType:'json',
        beforeSend: function () {
            $('#window_progress').show();
        },
        success: function (response) {
            $("#permissionSectionBody").html(response);
        },
        complete: function () {
            $('#window_progress').hide();
        },
        error: function () {
            alert('There was a problem while requesting to delete the record. Please try again');
        }
    });
});

$("#allControllerMode").change(function () {
    var id = $(this).val();
    var controller = $("#allControllerFilter").val();
    var childRole = $("#userRoleChild").val();
    var parentId = $("#userRoleParent").val();
    var url = $("#userRoleChild").attr('url');
    $.ajax({
        url: url,
        type: "POST",
        data: 'controllerMode=' + id + '&controller=' + controller + '&child=' + childRole + '&id=' + parentId,
        //dataType:'json',
        beforeSend: function () {
            $('#window_progress').show();
        },
        success: function (response) {
            $("#permissionSectionBody").html(response);
        },
        complete: function () {
            $('#window_progress').hide();
        },
        error: function () {
            alert('There was a problem while requesting to delete the record. Please try again');
        }
    });
});

$("#allControllerFilter").change(function () {
    var id = $(this).val();
    var mode = $("#allControllerMode").val();
    var childRole = $("#userRoleChild").val();
    var parentId = $("#userRoleParent").val();
    var url = $("#userRoleChild").attr('url');
    $.ajax({
        url: url,
        type: "POST",
        data: 'controller=' + id + '&controllerMode=' + mode + '&child=' + childRole + '&id=' + parentId,
        //dataType:'json',
        beforeSend: function () {
            $('#window_progress').show();
        },
        success: function (response) {
            $("#permissionSectionBody").html(response);
        },
        complete: function () {
            $('#window_progress').hide();
        },
        error: function () {
            alert('There was a problem while requesting to delete the record. Please try again');
        }
    });
});

$('.ableToLogoutUser').click(function () {
    if (confirm('This user will be logged out from the moment. Are you sure ?')) {
        var id = $(this).attr('id');
        var url = $(this).attr('url');
        var recordId = id.split('ableToLogoutUser')[1];
        var rowId = recordId.split('.').join("");
        $.ajax({
            url: url,
            type: "POST",
            data: 'ip=' + recordId,
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    if (response.recordLoggedout == 1) {
                        $('#rowId' + rowId).fadeOut();
                    }
                } else {
                    alert('User has been logged out successfully');
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while logging out the user. Please try again');
            }
        });
    }
});

function ableToVerifyEmail(recordId) {
    if (confirm('Are you sure ?')) {
        var id = 'ableToVerifyEmail' + recordId;
        $.ajax({
            url: SITE_URL + '/usermgmt/user/verify-email?id=' + recordId,
            type: "POST",
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    if (response.recordEmailVerified == 1) {
                        $('#' + id).fadeOut();
                        $('#email_verified_td' + recordId).html('Yes');
                    }
                } else {
                    alert('verification status not updated successfully');
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while requesting to verify email. Please try again');
            }
        });
    }
}
$('#select_all').click(function () {
    ($(this).prop('checked') == true) ? $('.select_me').prop('checked', true) : $('.select_me').prop('checked', false);
});
$('.datepicker').datepicker({dateFormat: "dd-mm-yy"});
$('.payment-date').datepicker({dateFormat: "yy-mm-dd"});

$('#user-dob, .user-dob-datepicker').datepicker({
    maxDate: "-18Y",
    dateFormat: 'dd-mm-yy',
    changeYear: true,
    changeMonth: true,
    yearRange: "-100:-18",
});
function ableToUpdateValue(recordId) {
    if (confirm('Are you sure to update this setting?')) {
        var value = $('#setting-' + recordId).is(':checkbox') ? (($('#setting-' + recordId).is(':checked') == true) ? 1 : 0) : $('#setting-' + recordId).val();
        $.ajax({
            url: SITE_URL + '/usermgmt/setting/edit',
            type: "POST",
            data: 'id=' + recordId + '&value=' + value,
            dataType: 'json',
            beforeSend: function () {
                $('#window_progress').show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    alert('Successfully Updated');
                }
            },
            complete: function () {
                $('#window_progress').hide();
            },
            error: function () {
                alert('There was a problem while updating setting. Please try again');
            }
        });
    }
}

$(".states").change(function () {
    var state = $(this).val();
    $.ajax({
        url: SITE_URL + "generic/cities?id=" + state,
        type: "POST",
        success: function (data) {
            $(".cities").html("<option value=''>Please Select</option>");
            $.each(data, function (key, value) {
                $(".cities").append("<option value=" + value.index + ">" + value.name + "</option>");
            });
        },
        beforeSend: function () {
            $('#window_progress').show();
        },
        complete: function () {
            $('#window_progress').hide();
        },
        error: function () {
            alert('There was an error while requesting to cities for the selected states. Please try again');
        }
    });
});
$(document).ready(function () {
    $(".profile_wrapper").mouseover(function () {
        $(".pro_caption22").addClass("pro_caption223");
        $(".rg_pro_txt").addClass("rg_pro_txt23");
    });
    $(".profile_wrapper").mouseleave(function () {
        $(".pro_caption22").removeClass("pro_caption223");
        $(".rg_pro_txt").removeClass("rg_pro_txt23");
    });
});
function open_term_conditions() {
    var url = SITE_URL + "/Terms-and-Conditions";
    window.open(
            url,
            'popUpWindow',
            'height=600,width=900,left=100,top=100,resizable=1,scrollbars=1,toolbar=1,menubar=0,location=1,directories=0,status=1'
            );
}
