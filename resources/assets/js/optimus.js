$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Login form check
// $(function () {
//     $('input').iCheck({
//         checkboxClass: 'icheckbox_square-blue',
//         radioClass: 'iradio_square-blue',
//         increaseArea: '20%' // optional
//     });
// });

// Write page specific


function postSave(data) {
    // $.ajax({
    //     type: 'post',
    //     url: 'postwrite',
    //     data: {
    //         'title': title,
    //         'postId': $('#postId').val(),
    //         'data': data
    //     },
    //     success: function (data) {
    //         alert(data);
    //     }
    // });
}

var fbId, twId, tuId, wpId;
var count = 0;
$("#fbCheck").change(function () {
    if (this.checked) {
        $('#fbl').show(400);
        $('#fbPages').show(400);
        count = count + 1;
    }
    else {
        $('#fbl').hide(400);
        $('#fbPages').hide(400);
        count = count - 1;
    }
});

$("#fbgCheck").change(function () {
    if (this.checked) {
        $('#fblg').show(400);
        $('#fbGroupsSection').show(400);
        count = count + 1;
    }
    else {
        $('#fblg').hide(400);
        $('#fbGroupsSection').hide(400);
        count = count - 1;
    }
});


$("#twCheck").change(function () {
    if (this.checked) {
        $('#twl').show(400);
        count = count + 1;
    }
    else {
        $('#twl').hide(400);
        count = count - 1;
    }
});

$("#wpCheck").change(function () {
    if (this.checked) {
        $('#wpl').show(400);
        count = count + 1;
    }
    else {
        $('#wpl').hide(400);
        count = count - 1;
    }
});

$("#skypeCheck").change(function () {
    if (this.checked) {
        $('#skypel').show(400);
        count = count + 1;
    }
    else {
        $('#skypel').hide(400);
        count = count - 1;
    }
});


$("#wpCheck").change(function () {
    if (this.checked) {
        $('#wpl').show(400);
        count = count + 1;
    }
    else {
        $('#wpl').hide(400);
        count = count - 1;
    }
});

$("#tuCheck").change(function () {
    if (this.checked) {
        $('#tul').show(400);
        count = count + 1;
        $('#tuBlog').show(400);

    }
    else {
        $('#tul').hide(400);
        count = count - 1;
        $('#tuBlog').hide(400);
    }
});

$("#linkedinCheck").change(function () {
    if (this.checked) {
        $('#linkedinl').show(400);
        $('#liCompanySelection').show(400);
        count = count + 1;

    } else {
        $('#linkedinl').hide(400);
        $('#liCompanySelection').hide(400);
        count = count - 1;
    }
});


$('#write').click(function () {


    var pageId = $('#fbPages option:selected').attr('id');
    var groupId = $('#fbgroups').val();
    var accesstoken = $('#fbPages option:selected').attr('value');
    var postId = $('#postId').val();
    var imagepost = "no";
    var sharepost = "no";
    var textpost = "no";
    var title = $('#dataTitle').val();
    var caption = $('#imgCaption').val();
    var link = $('#link').val();
    var image = $('#image').val();
    var description = $('#description').val();
    var status = $('#status').val();
    var postId = $('#postId').val();
    var type = $('#type').val();
    // if ($('[id="sharetype"]').is(':checked')){
    //     sharepost = "yes";
    // }


    if ($('#imagetype').is(':checked')) {
        if (image == "") {
            return swal("You must have upload an image file for image post")
        }
        imagepost = "yes";
    }

    if ($('#sharetype').is(':checked')) {
        sharepost = "yes";
    }

    if ($('#textpost').is(':checked')) {
        textpost = "yes";
    }

    randomNumber();

    $('#fbMsgSu').hide();
    $('#fbMsgEr').hide();
    $('#fbgMsgEr').hide();
    $('#fbgMsgSu').hide();
    $('#twMsgSu').hide();
    $('#twMsgEr').hide();
    $('#tuMsgSu').hide();
    $('#tuMsgEr').hide();
    $('#wpMsgSu').hide();
    $('#wpMsgEr').hide();


    var msgBox = $('#msgBox').show(400);
    var data = $('#status').val();
    var title = $('#dataTitle').val();
    var loading = $('#loading');
    loading.show(200);
    var msg = $('#returnMsg');
    $.ajax({
        type: 'POST',
        url: 'post/save',
        data: {
            'title': title,
            'data': data,
            'postId': postId
        },
        success: function (data) {
            if(data=="success"){
                notify(appPath()+"/images/optimus/social/logopadding.png","Saved","Post saved to draft","#");
            }
            else{
                notify(appPath()+"/images/optimus/social/logopadding.png","Error",data,"#");
            }

        }
    });

    if ($('#fbCheck').is(":checked")) {


        $.ajax({
            type: 'post',
            url: 'fbwrite',
            data: {
                'data': status,
                'title': title,
                'caption': caption,
                'description': description,
                'link': link,
                'image': image,
                'pageId': pageId,
                'accessToken': accesstoken,
                'postId': postId,
                'imagepost': imagepost,
                'sharepost': sharepost
            },
            success: function (data) {

                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                }


                if (data == 'success') {
                    $('#fbMsgSu').show(300);
                }
                else {
                    $('#fbMsgEr').html(data);
                    $('#fbMsgEr').show(300);
                }
                console.log(data);
                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                    var sentData = fbId + '_' + twId + '_' + tuId + '_' + wpId;
                    postSave(sentData);
                    $('#final').val(sentData);
                }
            }
        });
    }

    if ($('#fbgCheck').is(':checked')) {

        $.ajax({
            type: 'post',
            url: 'fbgwrite',
            data: {
                'data': data,
                'title': title,
                'caption': caption,
                'description': description,
                'link': link,
                'image': image,
                'groupId': groupId,
                'accessToken': accesstoken,
                'postId': postId,
                'imagepost': imagepost,
                'sharepost': sharepost
            },
            success: function (data) {

                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                }


                if (data == 'success') {
                    $('#fbgMsgSu').show(300);
                }
                else {
                    $('#fbgMsgEr').html(data);
                    $('#fbgMsgEr').show(300);
                }
                console.log(data);
                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                    var sentData = fbId + '_' + twId + '_' + tuId + '_' + wpId;
                    postSave(sentData);
                    $('#final').val(sentData);
                }
            }
        });
    }

    if ($('#twCheck').is(":checked")) {
        $.ajax({
            type: 'post',
            url: 'twwrite',
            data: {
                'data': data,
                'postId': postId,
                'image': $('#image').val(),
                'imagepost': imagepost
            },
            success: function (data) {

                if (data == 'success') {
                    twId = data;
                    $('#twMsgSu').show(300);
                }
                else {
                    $('#twMsgEr').html(data);
                    $('#twMsgEr').show(300);
                }
                console.log(data);

                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                    var sentData = fbId + '_' + twId + '_' + tuId + '_' + wpId;
                    postSave(sentData);
                    $('#final').val(sentData);
                }

            }
        });
    }

    if ($('#wpCheck').is(":checked")) {
        $.ajax({
            type: 'post',
            url: 'wpwrite',
            data: {
                'title': title,
                'postId': postId,
                'data': data,
                'imagepost': imagepost,
                'image': image
            },
            success: function (data) {


                if (data != 'error') {
                    wpId = data;
                    $('#wpMsgSu').show(300);
                }
                else {
                    $('#wpMsgEr').show(300);
                }
                console.log(data);
                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                    var sentData = fbId + '_' + twId + '_' + tuId + '_' + wpId;
                    postSave(sentData);
                    $('#final').val(sentData);
                }
            }
        });
    }

    if ($('#tuCheck').is(":checked")) {
        $.ajax({
            type: 'post',
            url: 'tuwrite',
            data: {
                'blogName': $('#tuBlogName').val(),
                'title': title,
                'postId': postId,
                'data': data,
                'caption': caption,
                'image': image,
                'imagepost': imagepost
            },
            success: function (data) {
                if (data == 'success') {
                    tuId = data;
                    $('#tuMsgSu').html(data);
                    $('#tuMsgSu').show(300);
                }
                else {
                    $('#tuMsgEr').html(data);
                    $('#tuMsgEr').show(300);
                }
                console.log(data);
                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                    var sentData = fbId + '_' + twId + '_' + tuId + '_' + wpId;
                    postSave(sentData);
                    $('#final').val(sentData);
                }
            }
        });
    }

    if ($('#skypeCheck').is(":checked")) {
        $.ajax({
            type: 'POST',
            url: appPath()+'/skype/masssend',
            data: {
                'message': data

            },
            success: function (data) {

                if (data == 'success') {
                    $('#skypeMsgsu').html(data);
                    $('#skypeMsgsu').show(300);
                }
                else {
                    $('#skypeMsger').html(data);
                    $('#skypeMsger').show(300);
                }
                console.log(data);
                count = count - 1;
                if (count == 0) {
                    loading.hide(100);
                }
            }
        });
    }

    if ($('#linkedinCheck').is(":checked")) {
        var to = [];

        $('#liCompanies :selected').each(function(i, selected){
            to[i] = $(selected).val();
        });

        $.ajax({
            type: 'POST',
            url: appPath() + '/linkedin/share',
            data: {
                'content': data,
                'titleForImage': caption,
                'descriptionOfLink': description,
                'linkOfContent': link,
                'image': image,
                'companies': JSON.stringify(to),
                'sharepost': sharepost
            },
            success: function (response) {
                if (response.status === 'error') {
                    var error = $.isArray(response.error) ? response.error[0] : response.error;

                    $('#liMsgSu').hide(300);
                    $('#liMsgEr').html(error).hide(300).show(300);
                } else {
                    $('#liMsgEr').hide(300)
                    $('#liMsgSu').hide(300).show(300);
                }

                count = count - 1;

                if (count == 0) {
                    loading.hide(100);
                }
            }
        });
    }
});
////////////////////////////////////////////////////
//        extra
function randomNumber() {
    var postId = $('#postId');
    var num = Math.floor(Math.random() * 9999 + 1000);
    postId.val(num);
}

randomNumber();

$("#status").on("change keyup paste", function () {
    if ($('#status').val().length >= 120) {

        $('#twcount').removeClass('label label-primary');
        $('#twcount').addClass('label label-danger');
        $('#wmsg1').html("You can't write more than 140 character on twitter <span>*</span>");
    }

    else {
        $('#twcount').addClass('label label-primary');
        $('#wmsg1').html("..");

    }
    $('#twcount').html($('#status').val().length);
});

// Settings page specific
$('#fbSettingSave').click(function () {
    $.ajax({
        type: 'post',
        url: 'fbsave',
        data: {
            'fbAppId': $('#fbAppId').val(),
            'fbAppSec': $('#fbAppSec').val(),
            'fbToken': $('#fbToken').val(),
            'fbPages': $('#fbPages :selected').val()
        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Facebook settings updated', 'success');
            }
            else {
                swal('Error!', data, 'error');
            }
        }
    });
});

$('#wpSave').click(function () {
    $.ajax({
        type: 'post',
        url: 'wpsave',
        data: {
            'wpUrl': $('#wpUrl').val(),
            'wpUser': $('#wpUser').val(),
            'wpPassword': $('#wpPassword').val()
        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Wordpress settings updated', 'success');
            }
            else {
                swal('Error!', data, 'error');
            }
        }
    })
});

$('#tuSave').click(function () {
    $.ajax({
        type: 'post',
        url: 'tusave',
        data: {
            'tuConKey': $('#tuConKey').val(),
            'tuConSec': $('#tuConSec').val(),
            'tuToken': $('#tuToken').val(),
            'tuTokenSec': $('#tuTokenSec').val(),
            'tuDefBlog': $('#tuDefBlog').val()
        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Tubmlr settings updated', 'success');
            }
            else {
                swal('Error!', data, 'error');
            }
        }
    });
});

$('#twSave').click(function () {
    $.ajax({
        type: 'post',
        url: 'twsave',
        data: {
            'twConKey': $('#twConKey').val(),
            'twConSec': $('#twConSec').val(),
            'twToken': $('#twToken').val(),
            'twTokenSec': $('#twTokenSec').val(),
            'twUser': $('#twUser').val()
        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Twitter settings updated', 'success');
            }
            else {
                swal('Error!', data, 'error');
            }


        }
    });
});

// Followers and Likes specific
$(function () {
    if (document.getElementById('followers')) {
        $.ajax({
            type: 'GET',
            url: 'gettwfoll',
            success: function (data) {
                if (data == 'error') {
                    $('#twFolList').html("Something went wrong");
                    $('#loading').hide(200);
                }
                else {
                    $('#twFolList').html(data);
                    $('#loading').hide(200);
                }
            }
        });
    }
});

// Facebook Pages specific
$('#fbwrite').click(function () {
    var pageId = $('#fbPages option:selected').attr('id');
    var accesstoken = $('#fbPages option:selected').attr('value');
    var imagepost = "no";
    var title = $('#dataTitle').val();
    var caption = $('#imgCaption').val();
    var link = $('#link').val();
    var image = $('#image').val();
    var description = $('#description').val();
    var status = $('#status').val();
    if ($('#imagetype').is(':checked')) {
        imagepost = "yes";
    }

    $.ajax({
        type: 'post',
        url: 'fbwrite',
        data: {
            'data': status,
            'title': title,
            'caption': caption,
            'description': description,
            'link': link,
            'image': image,
            'pageId': pageId,
            'accessToken': accesstoken,
            'imagepost': imagepost
        },
        success: function (data) {
            if (data == 'success') {
                swal("Done!", "Posted successfully !", "success")
            }
            else {
                swal("Error!", data, "error")
            }
        }
    });
});

// delete facebook post & comments
$('.optimusfbcom').click(function () {
    var feedId = $(this).attr('data-id');
    var pageToken = $(this).attr('data-token');

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        $.ajax({
            type: 'POST',
            url: 'fbdel',
            data: {
                'id': feedId,
                'pageToken': pageToken,

            },
            success: function (data) {
                if (data == 'success') {
                    swal("Done!", "deleted successfully !", "success")
                    location.reload();
                }
                else {
                    swal("Error", data, "error");
                }

            }
        });

    });


});

// comment on post or replay on comment

$('.form-control.input-sm').bind("enterKey", function (e) {
    var id = $(this).attr('data-id');
    var pageToken = $(this).attr('data-token');
    var comment = $(this).val();
    $.ajax({
        type: 'POST',
        url: 'fbcom',
        data: {
            'id': id,
            'pageToken': pageToken,
            'comment': comment
        },
        success: function (data) {
            alert(data);
            location.reload();
        }
    });
});
$('.form-control.input-sm').keyup(function (e) {
    if (e.keyCode == 13) {
        $(this).trigger("enterKey");
    }
});

// edit feed

$('.optimusfbedit').click(function () {
    var feed = $(this).attr('data-value');
    var feedId = $(this).attr('data-id');
    var pageToken = $(this).attr('data-token');
    var msg = "";


    swal({
        title: "An input!",
        text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something",
        showLoaderOnConfirm: true,
        inputValue: feed
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!");
            return false
        }
        $.ajax({
            type: 'POST',
            url: 'fbedit',
            data: {
                'id': feedId,
                'pageToken': pageToken,
                'message': inputValue
            },
            success: function (data) {
                swal("Done!", "You wrote: " + inputValue, "success");
                location.reload();
            },
            error: function (data) {
                swal("Done !", "You wrote: " + inputValue, "success");
                location.reload();
            }
        })

    });

});

// delete twitter post

$('.optimustwdel').click(function () {
    var feedId = $(this).attr('data-id');

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        $.ajax({
            type: 'POST',
            url: 'twdel',
            data: {
                'id': feedId,
            },
            success: function (data) {
                if (data == 'success') {
                    swal("Done!", "deleted successfully !", "success")
                    location.reload();
                }
                else {
                    swal("Error", data, "error");
                }

            }
        });

    });

});
// post to twitter
$('#twWrite').click(function () {
    $.ajax({
        type: 'POST',
        url: 'twwrite',
        data: {
            'data': $('#status').val(),
            'image': $('#image').val()
        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Posted on Twitter', 'success');
            }
            else {
                swal('Error!', data, 'error');
            }
        }
    });
});

// delete tumblr post

$('.optimustudel').click(function () {
    var id = $(this).attr('data-id');
    var blogName = $(this).attr('data-value');
    var reblog_key = $(this).attr('data-key');

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        $.ajax({
            type: 'POST',
            url: 'tudel',
            data: {
                'id': id,
                'blogName': blogName,
                'reBlogKey': reblog_key
            },
            success: function (data) {
                if (data == 'success') {
                    swal("Done!", "deleted successfully !", "success")
                    location.reload();
                }
                else {
                    swal("Error", data, "error");
                }

            }
        });

    });

});

// upload image

$("#uploadimage").on('submit', (function (e) {
    e.preventDefault();

    $.ajax({
        url: "iup",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data['status'] == 'success') {
                $('#image').val(data['fileName']);
                $('#imgMsg').html("Your file uploaded and it's name : " + data['fileName']);
                swal('Success!', 'Image File succefully uploaded', 'success');
                $('#imgPreview').attr('src', 'uploads/' + data['fileName']);

            }
            else {
                swal('Error!', data, 'error');
                $('#imgMsg').html("Something went wrong can't upload image");

            }
        }
    });
}));

// schedul add

// show schedule options
$('#addschedule').click(function () {
    $('#ss').show(200);

});
// hide schedule options
$('#sclose').click(function () {
    $('#ss').hide(200);

});

$('#saveschedule').click(function () {


    var title = $('#dataTitle').val();
    var caption = $('#imgCaption').val();
    var link = $('#link').val();
    var image = $('#image').val();
    var description = $('#description').val();
    var status = $('#status').val();
    var postId = $('#postId').val();
    var type = $('#type').val();
    var fb = "no";
    var fbg = "no";
    var tw = "no";
    var tu = "no";
    var wp = "no";
    var skype = "no";
    var imagetype = "no";
    var sharetype = "no";
    var groupId = "";
    var blogName = "no";
    var pageId = $('#fbPages option:selected').attr('id');
    var pageToken = $('#fbPages option:selected').attr('value');
    if ($('#fbCheck').is(':checked')) {
        fb = "yes";
    }

    if ($('#fbgCheck').is(':checked')) {
        fbg = "yes";
        groupId = $('#fbgroups').val();
    }

    if ($('#twCheck').is(':checked')) {
        tw = "yes";
    }

    if ($('#tuCheck').is(':checked')) {
        tu = "yes";
        blogName = $('#tuBlogName').val();
    }
    if ($('#wpCheck').is(':checked')) {
        wp = "yes";
    }
    if($('#skypeCheck').is(':checked')){
        skype = "yes";
    }

    if ($('#imagetype').is(':checked')) {
        imagetype = "yes";
    }

    if ($('#sharetype').is(':checked')) {
        sharetype = "yes";
    }

    $.ajax({
        type: 'POST',
        url: 'addschedule',
        data: {
            'title': title,
            'caption': caption,
            'link': link,
            'image': image,
            'description': description,
            'status': status,
            'postId': postId,
            'type': type,
            'pageId': pageId,
            'pageToken': pageToken,
            'groupId': groupId,
            'imagetype': imagetype,
            'sharetype': sharetype,
            'fb': fb,
            'fbg': fbg,
            'tw': tw,
            'tu': tu,
            'wp': wp,
            'skype':skype,
            'blogName': blogName

        },
        success: function (data) {
            if (data == 'success') {
                swal('Success!', 'Your post to added to scheduler', 'success');
                randomNumber();
            }
            else {
                swal('Error!', data, 'error');
            }

        }
    })
});

// dashboard activities

function fbLikes() {
    $.get('fblikes', function (data, status) {
        $('#dFbLikes').html(data);
    });
}

function twFollowers() {
    $.get('twfollowers', function (data, status) {
        $('#dTwFollowers').html(data);
    });
}

function tuFollowers() {
    $.get('tufollowers', function (data, status) {
        $('#dTuFollowers').html(data);
    });
}

function liTotalCompanies() {
    $.get('/liTotalCompanies', function (total) {
        $('#liCompanies').html(total);
    });
}

function liPostedJobs() {
    $.get('/liPostedJobs', function (total) {
        $('#liPostedJobs').html(total);
    });
}

function companyFollowers() {
    $.get('/companyFollowers', function (total) {
        $('#companyFollowers').html(total);
    });
}

function liCompanyUpdates() {
    $.get('/liCompanyUpdates', function (total) {
        $('#liCompanyUpdates').html(total);
    });
}

$(function () {
    if (document.getElementById('dFbLikes')) {
        fbLikes();
        twFollowers();
        tuFollowers();
        liPostedJobs();
        companyFollowers();
        liCompanyUpdates();
    }
});

// delete schedule


if (document.getElementById('slist')) {

    $('.optsdel').click(function () {
        var id = $(this).attr('data-id');


        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'sdel',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success!', 'Data deleted', 'success');
                        location.reload();
                    }
                    else {
                        swal('Error!', data, 'error');
                    }
                }
            });
        });


    });
}

// post delete

if (document.getElementById('allpost')) {
    $('.btn.btn-danger').click(function () {
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'delpost',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Deleted!", "Your post has been deleted.", "success");
                        location.reload();
                    }
                    else {
                        swal('Error!', data, 'error');
                    }
                }
            });

        });

    });
    $('#delall').click(function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete all!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'delallpost',
                data: {},
                success: function (data) {
                    if (data == 'success') {
                        swal("Deleted!", "Your all post have been deleted.", "success");
                        location.reload();
                    }
                    else {
                        swal('Error!', data, 'error');
                    }
                }
            });

        });
    })
}

// wordpress page specific

if (document.getElementById('wppage')) {
    $('#wpwrite').click(function () {
        var title = $('#dataTitle').val();
        var data = $('#status').val();
        var postId = $('#postId').val();
        $.ajax({
            type: 'post',
            url: 'wpwrite',
            data: {
                'title': title,
                'data': data,
                'postId': postId
            },
            success: function (data) {
                if (data != 'error') {

                    swal('Success!', 'Wrote on wordpress', 'success');
                }
                else {
                    swal('Error!', 'Something went wrong', 'error');
                }
            }
        });

        randomNumber();
    });
}

if (document.getElementById('tumbrl')) {
    $('.label.label-info.reblog').click(function () {
        var reblogKey = $(this).attr('data-key');
        var postId = $(this).attr('data-id');
        var blogName = $(this).attr('data-name');
        $.ajax({
            type: 'POST',
            url: 'tureblog',
            data: {
                'reblogKey': reblogKey,
                'postId': postId,
                'blogName': blogName
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success!', 'Reblog success', 'success');
                }
                else {
                    swal('Error!', data, 'error');
                }

            }

        });
    });
}

// save facebook public groups
if (document.getElementById('fbmassgroup')) {
    $('#saveFbGroup').click(function () {
        var id = $('#groupId').val();
        var name = $('#groupName').val();
        $.ajax({
            type: 'POST',
            url: 'savepublicgroup',
            data: {
                'groupId': id,
                'groupName': name
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success!', 'Group Information saved', 'success');
                }
                else {
                    swal('Error!', data, 'error');
                }
            }
        });

    });
}

if (document.getElementById('fbmassgroup')) {
    $('#postMassGroup').click(function () {
        var data = $('#status').val();
        $.ajax({
            type: 'POST',
            url: 'posttomassgroup',
            data: {
                'data': data
            },
            success: function (data) {
                $('#msg').html(data);
            }
        });
    });
}

if (document.getElementById('slist')) {
    $('.optsedit').click(function () {
        $('#title').val($(this).attr('data-title'));
        $('#content').val($(this).attr('data-content'));
        var typeVal = $(this).attr('data-type');
        $("#type").find('option').removeAttr("selected");
        $('#type option[value=' + typeVal + ']').attr('selected', 'selected');
        $('#id').val($(this).attr('data-id'));
        $('#editModal').modal();

    });

}

if (document.getElementById('slist')) {

    $('#sedit').click(function () {
        var title = $('#title').val();
        var content = $('#content').val();
        var type = $('#type').val();
        var id = $('#id').val();

        $.ajax({
            type: 'POST',
            url: 'sedit',
            data: {
                'title': title,
                'data': content,
                'type': type,
                'id': id
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success!', 'Data updated', 'success');
                    location.reload();
                }
                else {
                    swal('Error!', data, 'error');
                }
            }
        });
    });
}

// fb chat bot
// add new question and ans
if (document.getElementById('fb-bot')) {
    $('#addData').click(function () {

        var question = $('#question').val();
        var answer = $('#answer').val();
        var pageId = $('#pages').val();
        $.ajax({
            type: 'POST',
            url: 'addquestion',
            data: {
                'question': question,
                'answer': answer,
                'pageId':pageId
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success !', 'You question added', 'success');
                    location.reload();
                } else {
                    swal('Error!', data, 'error');
                }
            }

        });
    });
}

// delete fb bot question

if (document.getElementById('chatbot')) {
    $('.chatbotdel').click(function () {
        var id = $(this).attr('data-id');


        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'delquestion',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });
    });
}

// slack chat bot
if (document.getElementById('slack-bot')) {
    // add new question and ans
    $('#add-slack-question').submit(function (e) {
        if ($('#question').val() === '') {
            swal("Error", 'Message field can not be empty.', "error");
        } else if ($('#answer').val() == '') {
            swal("Error", 'Reply field can not be empty.', "error");
        } else if ($('#channel').val() == '') {
            swal("Error", 'Channel field can not be empty.', "error");
        } else {
            $.post($(this).attr('action'), {
                question: $('#question').val(),
                answer: $('#answer').val(),
                channel: $('#channel').val(),
                accuracy: $('#accuracy').val()
            }, function () {
                swal('Success!', 'You question added', 'success');
                location.reload();
            });
        }

        e.preventDefault();
    });

    // delete question
    $('.delete-slack-question').click(function (e) {
        var $this = $(this);

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.post('delete-slack-question', {id: $this.data('id')}, function () {
                swal("Done!", "Deleted successfully!", "success");
                location.reload();
            });
        });

        e.preventDefault();
    });

    // update bot config
    $('#bot-config-form').submit(function (e) {
        $.post($(this).attr('action'), {
            matchAcc: $('#matchAcc')
        }, function () {
            swal('Success!', 'Slack bot config updated.', 'success');
            location.reload();
        });

        e.preventDefault();
    });
}


if (document.getElementById('slog')) {
    $('.logdel').click(function () {
        var id = $(this).attr('data-id');


        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'logdel',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });
    });
}

if (document.getElementById('slog')) {
    $('#delall').click(function () {
        swal({
            title: "Are you sure?",
            text: "Do you want to delete all logs ? You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete all!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'alllogdel',
                data: {},
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "All deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });
    });
}

// data table

// var table = $('#mytable').DataTable( {
//
//     dom: '<""flB>tip',
//     buttons: [
//         {
//             extend: 'excel',
//             text: '<button class="btn btn-success btn-xs fak"><i class="fa fa-file-excel-o"></i> Export all to excel</button>'
//         },
//         {
//             extend: 'csv',
//             text: '<button class="btn btn-warning btn-xs fak"><i class="fa fa-file-o"></i> Export all to csv</button>'
//         },
//         {
//             extend: 'pdf',
//             text: '<button class="btn btn-danger btn-xs fak"><i class="fa fa-file-pdf-o"></i> Print all in pdf</button>'
//         },
//         {
//             extend: 'print',
//             text: '<button class="btn btn-default btn-xs fak"><i class="fa fa-print"></i> Print all</button>'
//         },
//     ]
// } );
// update language keyboard settings

if (document.getElementById('settingspage')) {
    $('#langSave').click(function () {
        $.ajax({
            type: 'POST',
            url: 'langsave',
            data: {
                'value': $('#langOp').val()
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success', 'Settings updated', 'success');

                }
                else {
                    swal('Error', data, 'error');
                }
            }
        })
    });
}


if (document.getElementById('settingspage')) {
    $('#skypeSave').click(function () {
        $.ajax({
            type: 'POST',
            url: 'skypesave',
            data: {
                'skypeUser': $('#skypeUser').val(),
                'skypePass': $('#skypePass').val()
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success', 'Settings updated', 'success');
                }
                else {
                    swal('Error', data, 'error');
                }
            }
        })
    });
}

if (document.getElementById('settingspage')) {
    $('#linkedinSettings').submit(function (e) {
        $.post($(this).attr('action'), {
            clientId: $('#linkedin_client_id').val(),
            clientSecret: $('#linkedin_client_secret').val()
        }, function (response) {
            if (response === 'success') {
                swal('Success', 'Settings updated', 'success');

                setTimeout(location.reload.bind(location), 1000);
            } else {
                sweetAlert("Oops...", response, "error");
            }
        });

        e.preventDefault();
    })
}

function liGoBackToAllUpdates() {
    $('#in_last').val('');
    $('.in_all').show(200);
    $('.in_last').addClass('hidden');
}

if (document.getElementById('linkedin')) {
    $('#in_all').change(function () {
        if (! $('#in_all').is(':checked')) {
            $('.in_all').hide(200);
            $('.in_last').removeClass('hidden');
            $('#in_last').focus();
        }
    });

    $('#in_last').keyup(function (e) {
        // if ESC key pressed
        if (e.keyCode == 27) {
            liGoBackToAllUpdates();
        }
    });

    $('#go_back').click(function () {
        liGoBackToAllUpdates();
    });

    $('form').submit(function (e) {
        $.post($(this).attr('action'), $(this).serialize(), function (response) {
            $('#send').button('reset');

            if (response.status === 'error') {
                return $('.alert').removeClass().addClass('alert alert-danger').html(response.error).removeClass('hidden');
            }

            return $('.alert').removeClass().addClass('alert alert-success').html(response.msg).removeClass('hidden');
        });

        $('#send').button('loading');

        e.preventDefault();
    });
}

// if(document.getElementById('scraper')){
//     $('#search').click(function () {
//         $('#scraper').html("Please wait........");
//         if($('#query').val()==''){
//             return swal('Please enter keyword');
//         }
//         else{
//             $.ajax({
//                type:'POST',
//                 url:'scraper',
//                 data:{
//                     'query':$('#query').val(),
//                     'type':$('#type').val(),
//                     'limit':$('#limit').val()
//                 },
//                 success:function (data) {
//                     if(data=='error'){
//                         $('#scraper').html("Something went wrong . can't fetch data ");
//                     }
//                     else{
//                         $('#scraper').html(data);
//                     }
//                 }
//             });
//         }
//     })
// }

if (document.getElementById('notifysettingspage')) {
    $('#notifySave').click(function () {
        $.ajax({
            'type': 'POST',
            'url': appPath()+'/settings/notifications',
            data: {
                'appId': $('#appId').val(),
                'appKey': $('#appKey').val(),
                'appSec': $('#appSec').val()
            },
            success: function (data) {
                if (data == 'success') {
                    swal('Success!', 'Settings Updated', 'success');
                }
                else {
                    swal('Error!', data, 'error');
                }
            }
        })
    })
}

// image functions
function logo() {
    return appPath()+"/images/optimus/social/logo.png";
}
function messengericon() {
    return appPath()+"/images/optimus/social/optmessenger.png";
}

function optfbicon() {
    return appPath()+"/images/optimus/social/optfb.png";
}

function optscheduleicon() {
    return appPath()+"/images/optimus/social/optschedule.png";
}

// notifications

function notify(icon, title, body, url) {
    if (!Notification) {
        alert('Desktop notifications not available in your browser. Try Chromium.');
        return;
    }

    if (Notification.permission !== "granted")
        Notification.requestPermission();
    else {
        var notification = new Notification(title, {
            icon: icon,
            body: body,
        });

        notification.onclick = function () {
            window.open(url);
        };

    }

}

// function insert(img,title,body,url,type,time){
//     $.ajax({
//         type:'POST',
//         url:'/notify',
//         data:{
//             'img':img,
//             'title':title,
//             'body':body,
//             'url':url,
//             'type':type,
//             'time':time
//         },
//         success:function (data) {
//             console.log(data);
//         }
//     });
// }

// delete all notifiactions

if (document.getElementById('allnotify')) {
    $('#delall').click(function () {
        swal({
            title: "Are you sure?",
            text: "Do you want to delete all Notifications ? You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete all!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'allnotifydel',
                data: {},
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "All deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });
    });
}

// intro current page


// delete skype saved phone number
if (document.getElementById('skypephone')) {
    $('.btn.btn-danger.btn-xs').click(function () {
        var id = $(this).attr('data-id');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete phone number ? You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: appPath()+'/skype/phone/del',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "Deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });
    });

    $('#delall').click(function () {

        swal({
            title: "Are you sure?",
            text: "Do you want to delete all phone number ? You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete all!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: 'POST',
                url: appPath()+'/skype/phone/del/all',
                data: {},
                success: function (data) {
                    if (data == 'success') {
                        swal("Done!", "Deleted successfully !", "success")
                        location.reload();
                    }
                    else {
                        swal("Error", data, "error");
                    }

                }
            });

        });

    });


}
