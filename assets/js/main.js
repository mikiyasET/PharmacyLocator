const medicineTab = $('#medicineTab')
const locationTab = $('#locationTab')
const pharmacyTab = $('#pharmacyTab')
const storeTab = $('#storeTab')

const medicineLink = $('#medicineLink')
const locationLink = $('#locationLink')
const pharmacyLink = $('#pharmacyLink')
const storeLink = $('#storeLink')

const medicineIcon = $('#medicineLink i:last-child')
const locationIcon = $('#locationLink i:last-child')
const pharmacyIcon = $('#pharmacyLink i:last-child')
const storeIcon = $('#storeLink i:last-child')

medicineTab.hide()
locationTab.hide()
pharmacyTab.hide()
storeTab.hide()



function loadPage(location,data = '',id = '') {
    showLoading()
    let request;
    switch (location) {
        case 'dashboard':
            request = $.ajax({
                url: "ajax/dashboard.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'medicine':
            request = $.ajax({
                url: "ajax/medicine.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'location':
            request = $.ajax({
                url: "ajax/location.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'pharmacy':
            request = $.ajax({
                url: "ajax/pharmacy.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'store':
            request = $.ajax({
                url: "ajax/store.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'leaderboard':
            request = $.ajax({
                url: "ajax/leaderboard.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
            break;
        case 'password':
            request = $.ajax({
                url: "ajax/password.php",
                type: "GET",
                dataType: "html",
            });
            break;
        case 'logout':
            request = $.ajax({
                url: "ajax/logout.php",
                type: "GET",
                dataType: "html",
            });
            break;
        default:
            request = $.ajax({
                url: "ajax/index.php",
                type: "GET",
                dataType: "html",
                data: {
                    func: data,
                    id: id
                }
            });
    }
    request.done(function(msg) {
        $(".main").html(msg);
        console.log('page changed')
        hideLoading();
    });
    request.fail(function(jqXHR, textStatus) {
        Toast.fire({
            icon: 'error',
            title: 'Connection Error'
        })
        hideLoading();
    });

}
function add(to) {
    switch (to) {
        case 'medicine':
            medicineBtn()
            break
        case 'location':
            locationBtn()
            break
        case 'pharmacy':
            pharmacyBtn()
            break
        case 'store':
            storeBtn()
            break
        case 'password':
            passwordBtn();
            break;
        default:
            Toast.fire({
                icon: 'error',
                title: 'Unknown call'
            })
    }
}
function modify(to,id) {
    switch (to) {
        case 'medicine':
            medicineBtn('edit',id)
            break
        case 'location':
            locationBtn('edit',id)
            break
        case 'pharmacy':
            pharmacyBtn('edit',id)
            break
        case 'store':
            storeBtn('edit',id)
            break
        default:
            Toast.fire({
                icon: 'error',
                title: 'Unknown call'
            })
    }
}
function remove(to,id) {
    showLoading()
    let name = ''
    let tab = ''
    let load = ''
    switch (to) {
        case 'medicine':
            tab = 'removeMedicine'
            name = 'medicine'
            load = 'medicine'
            break
        case 'location':
            tab = 'removeLocation'
            name = 'location'
            load = 'location'
            break
        case 'pharmacy':
            tab = 'removePharmacy'
            name = 'pharmacy'
            load = 'pharmacy'
            break
        case 'store':
            tab = 'removeStore'
            name = 'store'
            load = 'store'
            break
        default:
            name = 'unknown thing'
    }
    Swal.fire({
        title: 'Are you sure?',
        text: "You're about to delete this " + name + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let request = $.ajax({
                url: "ajax/index.php",
                type: "POST",
                data: {
                    id : id,
                    submit : tab
                },
                dataType: "text"
            });
            request.done(function(output) {
                console.log(output);
                switch (output) {
                    case 'success':
                        Toast.fire({
                            icon: 'success',
                            title: 'Deleted successfully'
                        })
                        loadPage(load,'remove')
                        break;
                    case 'failure':
                        Toast.fire({
                            icon: 'error',
                            title: 'Not deleted, try again later!'
                        })
                        break;
                    case 'unknownID':
                        Toast.fire({
                            icon: 'error',
                            title: 'something went wrong, refresh the page!'
                        })
                        break;
                }
                hideLoading()
            });
            request.fail(function(jqXHR, textStatus) {
                Toast.fire({
                    icon: 'error',
                    title: 'Request failed: ' + textStatus
                })
                hideLoading()
            });
        }
        else {
            hideLoading()
        }
    })
}

function medicineBtn(data = 'add',id = null) {}
function locationBtn(data = 'add',id = null) {
    showLoading()
    let name = $("input[name='name']").val();
    let request = $.ajax({
        url: "ajax/index.php",
        type: "POST",
        data: {
            id: id,
            name : name,
            submit : data === 'add' ? 'addLocation' : 'editLocation'
        },
        dataType: "text"
    });
    if (name != '') {
        request.done(function(output) {
            console.log(output);
            switch (output) {
                case 'locationSuccess':
                    Toast.fire({
                        icon: 'success',
                        title: 'Location added successfully'
                    })
                    loadPage('location','add')
                    break;
                case 'locationNameExist':
                    Toast.fire({
                        icon: 'error',
                        title: 'Name already exists'
                    })
                    break;
                case 'editLocationSuccess':
                    Toast.fire({
                        icon: 'success',
                        title: 'Location modified successfully'
                    })
                    loadPage('location','edit')
                    break;
                case 'editLocationUnknownID':
                    Toast.fire({
                        icon: 'error',
                        title: 'Id unknown, Please refresh the page'
                    })
                    break;
                default:
                    Toast.fire({
                        icon: 'error',
                        title: 'Internal Error'
                    })
            }
            hideLoading()
        });
        request.fail(function(jqXHR, textStatus) {
            Toast.fire({
                icon: 'error',
                title: 'Connection Error'
            })
            hideLoading()
        });
    }else {
        Toast.fire({
            icon: 'error',
            title: 'Empty field'
        })
        hideLoading()
    }
}
function pharmacyBtn(data = 'add',id = null) {
    showLoading()
    let name = $("input[name='name']").val() ?? '';
    let mapLink = $("input[name='mapLink']").val() ?? '';
    let location = $("select[name='location']").val() ?? '';
    let email = $("input[name='email']").val() ?? '';
    let password = $("input[name='password']").val() ?? '';
    let cpassword = $("input[name='cpassword']").val() ?? '';

    console.log(location);
    if ((password == cpassword) || data == 'edit') {
        if (name != '' && mapLink != '' && location != '' && email != '' && ((password != '' && cpassword != '') || data == 'edit')) {
            let request = $.ajax({
                url: "ajax/index.php",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    mapLink: mapLink,
                    location: location,
                    email: email,
                    password: password,
                    submit: data === 'add' ? 'addPharmacy' : 'editPharmacy'
                },
                dataType: "text"
            });
            request.done(function (output) {
                console.log(output);
                switch (output) {
                    case 'pharmacySuccess':
                        Toast.fire({
                            icon: 'success',
                            title: 'Location added successfully'
                        })
                        loadPage('pharmacy', 'add')
                        break;
                    case 'pharmacyNameEmailExist':
                        Toast.fire({
                            icon: 'error',
                            title: 'Name already exists'
                        })
                        break;
                    case 'passwordLength':
                        Toast.fire({
                            icon: 'error',
                            title: 'Password length must be 8 or greater in length'
                        })
                        break;
                    case 'emailError':
                        Toast.fire({
                            icon: 'error',
                            title: 'Invalid email address'
                        })
                        break;

                    case 'editPharmacySuccess':
                        Toast.fire({
                            icon: 'success',
                            title: 'Location modified successfully'
                        })
                        loadPage('pharmacy', 'edit')
                        break;
                    case 'editPharmacyUnknownID':
                        Toast.fire({
                            icon: 'error',
                            title: 'Id unknown, Please refresh the page'
                        })
                        break;
                    default:
                        Toast.fire({
                            icon: 'error',
                            title: 'Internal Error'
                        })
                }
                hideLoading()
            });
            request.fail(function (jqXHR, textStatus) {
                Toast.fire({
                    icon: 'error',
                    title: 'Connection Error'
                })
                hideLoading()
            });
        } else {
            Toast.fire({
                icon: 'error',
                title: 'Empty field'
            })
            hideLoading()
        }
    }
    else {
        Toast.fire({
            icon: 'error',
            title: 'Password doesn\'t match'
        })
        hideLoading()
    }
}
function storeBtn(data = 'add',id = null) {}


function collapseAll($except=null) {
    switch ($except) {
        case 'medicine':
            pharmacyIcon.text("expand_more")
            locationIcon.text("expand_more")
            storeIcon.text("expand_more")

            pharmacyTab.slideUp()
            locationTab.slideUp()
            storeTab.slideUp()
            break
        case 'location':
            pharmacyIcon.text("expand_more")
            medicineIcon.text("expand_more")
            storeIcon.text("expand_more")

            pharmacyTab.slideUp()
            medicineTab.slideUp()
            storeTab.slideUp()
            break
        case 'pharmacy':
            medicineIcon.text("expand_more")
            locationIcon.text("expand_more")
            storeIcon.text("expand_more")

            medicineTab.slideUp()
            locationTab.slideUp()
            storeTab.slideUp()
            break
        case 'store':
            medicineIcon.text("expand_more")
            locationIcon.text("expand_more")
            pharmacyIcon.text("expand_more")
            medicineTab.slideUp()
            locationTab.slideUp()
            pharmacyTab.slideUp()
            break
        default:
            medicineIcon.text("expand_more")
            locationIcon.text("expand_more")
            pharmacyIcon.text("expand_more")
            storeIcon.text("expand_more")
            medicineTab.slideUp()
            locationTab.slideUp()
            pharmacyTab.slideUp()
            storeTab.slideUp()
            break;
    }
}
function showLoading() {
    $('#mainpage').addClass('loading')
}
function hideLoading() {
    $('#mainpage').removeClass('loading')
}


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
var links = document.querySelectorAll('.list-link');
links.forEach((e) => {
    e.addEventListener('click',function () {
        links.forEach((e) => {
            e.classList.remove('active')
        })
        e.className += ' active'
    })
})
$('a').on('click', function (e) {
    const current = e.currentTarget.id;
    switch (current) {
        case 'medicineLink':
            collapseAll('medicine')
            medicineTab.slideToggle()
            medicineIcon.text() === "expand_more" ? medicineIcon.text('expand_less') : medicineIcon.text("expand_more")
            break
        case 'locationLink':
            collapseAll('location')
            locationTab.slideToggle()
            locationIcon.text() === "expand_more" ? locationIcon.text('expand_less') : locationIcon.text("expand_more")
            break
        case 'pharmacyLink':
            collapseAll('pharmacy')
            pharmacyTab.slideToggle()
            pharmacyIcon.text() === "expand_more" ? pharmacyIcon.text('expand_less') : pharmacyIcon.text("expand_more")
            break
        case 'storeLink':
            collapseAll('store')
            storeTab.slideToggle()
            storeIcon.text() === "expand_more" ? storeIcon.text('expand_less') : storeIcon.text("expand_more")
            break
        case 'leaderboardLink':
            collapseAll()
            break
        case 'dashboardLink':
            collapseAll()
            break
        case 'settingsLink':
            collapseAll()
            break
        case 'broadcastLink':
            collapseAll()
            break
    }
})