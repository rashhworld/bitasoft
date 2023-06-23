$(document).ready(function () {
    $('.navbar-toggler').click(function () {
        $('.fa-bars-staggered').toggleClass('fa-xmark');
    });

    tinymce.init({
        selector: '.advTextarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount fullscreen',
        toolbar: 'fullscreen undo redo | blocks fontfamily fontsize | bold italic underline | codesample image table | align numlist bullist | forecolor backcolor | link media | emoticons charmap',
        menubar: false,
        
        images_upload_url: baseURL + "/AdminControl/uploadArtImg",
        images_upload_base_path: baseURL,
    });
    
    $('#plim').on('change', function () {
        const urlParams = new URLSearchParams(location.search);
        urlParams.set('plim', $(this).val());
        location.search = urlParams;
    });
});

// ajax loader
$(document).ajaxStart(function () {
    $('.loader').removeClass('d-none');
    $('button').prop('disabled', true);
});
$(document).ajaxComplete(function () {
    $('.loader').addClass('d-none');
    $('button').prop('disabled', false);
});

$("#showPassword").change(function () {
    $(this).prop("checked") ? $("#pPass").prop("type", "text") : $("#pPass").prop("type", "password");
});

function showToastResponse(type, msg) {
    toast.show();
    $('.toast').removeClass('bg-success bg-danger');

    if (type == 1) {
        $('.modal').modal('hide');
        $('.toast').addClass('bg-success');
        setTimeout(function () {
            location.reload();
        }, 1000);
    } else {
        $('.toast').addClass('bg-danger');
    }

    $('.toast-body').html(msg);
}

function validateAdminLogin() {
    $(".validateAdminLogin").validate({
        rules: {
            aEmail: {
                required: true,
            },
            aPass: {
                required: true,
                minlength: 5,
            },
        },

        submitHandler: function (form) {
            var adminData = $(form).serialize();
            $.ajax({
                url: "../AdminControl/validateAdminLogin",
                type: "POST",
                cache: false,
                data: adminData,
                processData: false,
                dataType: "JSON",
                success: function (res) {
                    if (res.type == 0) {
                        Swal.fire('Alert!', res.msg, 'error');
                    } else {
                        location.href = res.url;
                    }
                }
            });
        }
    })
}
// .....................................................

function addCatagory(modal) {
    $(modal + " form").validate({
        rules: {
            cname: {
                required: true,
            },
            cimg: {
                required: true,
                extension: "jpg|jpeg|png|webp|gif",
                maxsize: 3145728,
            },
            cdesc: {
                required: true,
            },
        }, messages: {
            cimg: { extension: "Please upload only Image files.", maxsize: "Image size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var catagoryData = new FormData($(modal + " form")[0]);
            $.ajax({
                url: baseURL + "/AdminControl/addCatagory",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: catagoryData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function viewUpdateCatagory(modal, cid) {
    $.ajax({
        url: baseURL + "/AdminControl/viewUpdateCatagory",
        type: "POST",
        data: {
            cid: cid
        },
        dataType: "JSON",
        success: function (res) {
            $(modal).modal('show');
            $(modal + ' #cid').val(res.cid);
            $(modal + ' #cname').val(res.cname);
            $(modal + ' #imgExist').html('<i class="fa-regular fa-image"></i>');
            $(modal + ' #cdesc').val(res.cdesc);
        },
    });
}

function updateCatagory(modal) {
    $(modal + " form").validate({
        rules: {
            cname: {
                required: true,
            },
            cimg: {
                extension: "jpg|jpeg|png|webp|gif",
                maxsize: 3145728,
            },
            cdesc: {
                required: true,
            },
        }, messages: {
            cimg: { extension: "Please upload only Image files.", maxsize: "Image size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var catagoryData = new FormData($(modal + " form")[0]);
            $.ajax({
                url: baseURL + "/AdminControl/updateCatagory",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: catagoryData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

$("#updateCatPos").sortable({
    update: function (event, ui) {
        var item_order = [];
        $('#updateCatPos .col').each(function () {
            item_order.push($(this).attr("id"));
        });
        var order_string = 'order=' + item_order;
        $.ajax({
            type: "GET",
            url: baseURL + "/AdminControl/updateCatPosition",
            data: order_string,
            cache: false,
            success: function (data) { }
        });
    }
});

function deleteCatagory(cid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/deleteCatagory",
                type: "POST",
                data: {
                    cid: cid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}

function fetchSubject(pos, elem, type) {
    var cid = $(elem).val();
    if (cid != '') {
        $.ajax({
            url: baseURL + "/AdminControl/viewSubject",
            type: 'post',
            data: { cid: cid },
            dataType: 'json',
            success: function (res) {
                $(pos + ' #sid').html('<option value="" selected disabled hidden>Choose Here</option>');
                $(pos + ' #mdid').html('<option value="" selected disabled hidden>Choose Here</option>');
                $(pos + ' #moduleData').html(''); $(pos + ' #subjectData').html('');

                if (res.length > 0) {
                    for (let i = 0; i < res.length; i++) {
                        var option = $('<option>', {
                            value: res[i].sid,
                            text: res[i].sname,
                        });
                        $(pos + ' #sid').append(option);
                    }
                } else {
                    var option = $('<option>', {
                        value: '',
                        text: 'No subject found ...',
                    });
                    $(pos + ' #sid').append(option);
                }
                
                if (type == 'update') {
                    if (res.length > 0) {
                        for (let i = 0; i < res.length; i++) {
                            $(pos + ' #subjectData').append(
                                '<form class="usf' + res[i].sid + '">' +
                                '  <div class="input-group mb-3">' +
                                '    <input type="hidden" class="form-control" name="cid" value="' + cid + '">' +
                                '    <input type="hidden" class="form-control" name="sid" value="' + res[i].sid + '">' +
                                '    <input type="text" class="form-control" name="sname" value="' + res[i].sname + '">' +
                                '    <button class="btn btn-light border" type="submit" onclick="updateSubject(' + res[i].sid + ')">' +
                                '      <i class="fa-solid fa-pen-to-square text-primary"></i>' +
                                '    </button>' +
                                '    <button class="btn btn-light border" type="button" onclick="deleteSubject(' + res[i].sid + ')">' +
                                '      <i class="fa-solid fa-trash-can text-danger"></i>' +
                                '    </button>' +
                                '  </div>' +
                                '</form>'
                            );
                        }
                    } else {
                        $(pos + ' #subjectData').append('<p class="text-danger">No subject found for this catagory ...</p>');
                    }
                }
            }
        });
    } else {
        $(pos + ' #sid').html('<option value="" selected disabled hidden>Choose Here</option>');
        $(pos + ' #mdid').html('<option value="" selected disabled hidden>Choose Here</option>');
        $(pos + ' #moduleData').html(''); $(pos + ' #subjectData').html('');
    }
}

function fetchModule(pos, elem, type) {
    var sid = $(elem).val();
    if (sid != '') {
        $.ajax({
            url: baseURL + "/AdminControl/viewModule",
            type: "POST",
            data: { sid: sid },
            dataType: "JSON",
            success: function (res) {
                $(pos + ' #moduleData').html('');
                $(pos + ' #mdid').html('<option value="" selected disabled hidden>Choose Here</option>');

                if (res.length > 0) {
                    for (let i = 0; i < res.length; i++) {
                        $(pos + ' #moduleData').append(
                            '<form class="umf' + res[i].mdid + '">' +
                            '  <div class="input-group mb-3">' +
                            '    <input type="hidden" class="form-control" name="sid" value="' + sid + '">' +
                            '    <input type="hidden" class="form-control" name="mdid" value="' + res[i].mdid + '">' +
                            '    <input type="text" class="form-control" name="mdname" value="' + res[i].mdname + '">' +
                            '    <button class="btn btn-light border" type="submit" onclick="updateModule(' + res[i].mdid + ')">' +
                            '      <i class="fa-solid fa-pen-to-square text-primary"></i>' +
                            '    </button>' +
                            '    <button class="btn btn-light border" type="button" onclick="deleteModule(' + res[i].mdid + ')">' +
                            '      <i class="fa-solid fa-trash-can text-danger"></i>' +
                            '    </button>' +
                            '  </div>' +
                            '</form>'
                        );
                    }
                } else {
                    $(pos + ' #moduleData').append('<p class="text-danger">No subject found for this catagory ...</p>');
                }
                
                if (type == 'view') {
                    if (res.length > 0) {
                        for (let i = 0; i < res.length; i++) {
                            var option = $('<option>', {
                                value: res[i].mdid,
                                text: res[i].mdname,
                            });
                            $(pos + ' #mdid').append(option);
                        }
                    } else {
                        var option = $('<option>', {
                            value: '',
                            text: 'No subject found ...',
                        });
                        $(pos + ' #mdid').append(option);
                    }
                }
            },
        });
    } else {
        $(pos + ' #moduleData').html('');
        $(pos + ' #mdid').html('<option value="" selected disabled hidden>Choose Here</option>');
    }
}

function addSubject(modal) {
    $(modal + " form").validate({
        rules: {
            cid: {
                required: true,
            },
            sname: {
                required: true,
                letterswithbasicpunc: true,
            },
        },

        submitHandler: function (form) {
            var subjectData = $(form).serialize();
            $.ajax({
                url: baseURL + "/AdminControl/addSubject",
                type: "POST",
                cache: false,
                data: subjectData,
                processData: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function updateSubject(sid) {
    $(".usf" + sid).validate({
        rules: {
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            sname: {
                required: true,
                letterswithbasicpunc: true,
            },
        },

        submitHandler: function (form) {
            var subjectData = $(form).serialize();
            $.ajax({
                url: baseURL + "/AdminControl/updateSubject",
                type: "POST",
                cache: false,
                data: subjectData,
                processData: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function deleteSubject(sid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/deleteSubject",
                type: "POST",
                data: {
                    sid: sid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}


function addModule(modal) {
    $(modal + " form").validate({
        rules: {
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            mdname: {
                required: true,
            },
        },

        submitHandler: function (form) {
            var moduleData = $(form).serialize();
            $.ajax({
                url: baseURL + "/AdminControl/addModule",
                type: "POST",
                data: moduleData,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function updateModule(mdid) {
    $(".umf" + mdid).validate({
        rules: {
            sid: {
                required: true,
            },
            mdid: {
                required: true,
            },
            mdname: {
                required: true,
            },
        },

        submitHandler: function (form) {
            var moduleData = $(form).serialize();
            $.ajax({
                url: baseURL + "/AdminControl/updateModule",
                type: "POST",
                data: moduleData,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function deleteModule(mdid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/deleteModule",
                type: "POST",
                data: {
                    mdid: mdid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}

function addMaterial(formName) {
    $(formName).validate({
        rules: {
            mtitle: {
                required: true,
            },
            mfile: {
                required: false,
                extension: "jpg|jpeg|png|webp|gif|pdf",
                maxsize: 3145728,

            },
            mdesc: {
                required: true,
            },
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            mdid: {
                required: true,
            },
            mstatus: {
                required: true,
            },
        },
        messages: {
            mfile: { extension: "Please upload only image or pdf files.", maxsize: "File size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var materialData = new FormData($(formName)[0]);
            $.ajax({
                url: baseURL + "/AdminControl/addMaterial",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: materialData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    $(formName).trigger('reset');
                    toast.show(); $('.toast-body').addClass('bg-success').html(res.msg);
                }
            });
        }
    })
}

function updateMaterial(formName) {
    $(formName).validate({
        rules: {
            mid: {
                required: true,
            },
            mtitle: {
                required: true,
            },
            mfile: {
                required: false,
                extension: "jpg|jpeg|png|webp|gif|pdf",
                maxsize: 3145728,

            },
            mdesc: {
                required: true,
            },
            cid: {
                required: true,
            },
            sid: {
                required: true,
            },
            mdid: {
                required: true,
            },
            mstatus: {
                required: true,
            },
        },
        messages: {
            mfile: { extension: "Please upload only image or pdf files.", maxsize: "File size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var materialData = new FormData($(formName)[0]);
            $.ajax({
                url: baseURL + "/AdminControl/updateMaterial",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: materialData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function sortnfilterMat(action) {
    var form = $('.sortnfilterMat');
    var selects = form.find('select');
    var filled = selects.toArray().every(select => select.value !== '');

    if (action === 'Arrange') {
        if (filled) {
            form.attr('action', baseURL + "/admin/material/arrange");
            form.submit();
        } else {
            alert('Select all three fields for arrangement to work.');
            event.preventDefault();
        }
    } else if (action === 'Filter') {
        form.attr('action', baseURL + "/admin/material");
        form.submit();
    }
}

$("#updateMatPos").sortable({
    update: function (event, ui) {
        var item_order = [];
        $('#updateMatPos tr').each(function () {
            item_order.push($(this).attr("id"));
        });
        var order_string = 'order=' + item_order;
        $.ajax({
            type: "GET",
            url: baseURL + "/AdminControl/updateMatPosition",
            data: order_string,
            cache: false,
            success: function (data) { }
        });
    }
});

function removeMatFile(mid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/removeMatFile",
                type: "POST",
                data: {
                    mid: mid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}

function deleteMaterial(mid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/deleteMaterial",
                type: "POST",
                data: {
                    mid: mid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}

// ========================================================================================
// Blog Section
// ========================================================================================


function addBlogpost(formName) {
    $(formName).validate({
        rules: {
            btitle: {
                required: true,
            },
            bimg: {
                required: true,
                extension: "jpg|jpeg|png|webp|gif",
                maxsize: 3145728,

            },
            bdesc: {
                required: true,
            },
            bstatus: {
                required: true,
            },
        },
        messages: {
            bimg: { extension: "Please upload only image files.", maxsize: "File size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var blogData = new FormData($(formName)[0]);
            $.ajax({
                url: baseURL + "/AdminControl/addBlogpost",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: blogData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    // $(formName).trigger('reset');
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function updateBlogpost(formName) {
    $(formName).validate({
        rules: {
            bid: {
                required: true,
            },
            btitle: {
                required: true,
            },
            bimg: {
                required: false,
                extension: "jpg|jpeg|png|webp|gif|pdf",
                maxsize: 3145728,

            },
            bdesc: {
                required: true,
            },
            bstatus: {
                required: true,
            },
        },
        messages: {
            bimg: { extension: "Please upload only image files.", maxsize: "File size must not exceed 3MB", },
        },

        submitHandler: function (form) {
            var blogData = new FormData($(formName)[0]);
            $.ajax({
                url: baseURL + "/AdminControl/updateBlogpost",
                type: "POST",
                enctype: 'multipart/form-data',
                cache: false,
                data: blogData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                }
            });
        }
    })
}

function deleteBlogpost(bid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + "/AdminControl/deleteBlogpost",
                type: "POST",
                data: {
                    bid: bid
                },
                dataType: "JSON",
                success: function (res) {
                    res.type == 1 ? showToastResponse(1, res.msg) : showToastResponse(0, res.msg);
                },
            });
        }
    })
}

$("#searchModal form").submit(function (e) {
    e.preventDefault();
    var cType = this.cType.value;
    var sTerm = this.sTerm.value;
    if (cType && sTerm) {
        location.href = baseURL + "/admin/search/" + cType + "/" + sTerm;
    }
});