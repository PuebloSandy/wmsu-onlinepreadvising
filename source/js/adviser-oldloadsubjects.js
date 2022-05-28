function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$('#table_add_sub').on('change', ':checkbox', function() {
    $('#button').toggle(!!$('input:checkbox:checked').length);
});

$(".multiple-1").select2({
    //maximumSelectionLength: 2
});

$('#table-send').DataTable();

if ( $.fn.dataTable.isDataTable( '#table_add_sub' ) ) {
    table = $('#table_add_sub').DataTable();
}
else 
{
    table = $('#table_add_sub').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table_grade_input' ) ) {
    table = $('#table_grade_input').DataTable();
}
else 
{
    table = $('#table_grade_input').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

$(document).ready(function() {
    $('body').on('click','.deleteSendSubject',function() {
        $('#deleteSendSubjectModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#stud_send_subjectid').val(data[0]);
    });
}); 

//the interval 'timer' is set as soon as the page loads
var timer = setInterval(function(){ auto_logout() }, 900000);
// the figure '20000' (20 seconds) indicates how many milliseconds the timer be set to.
//e.g. if you want it to set 15 mins, calculate 15min= 15x60=900 sec => 900,000 milliseconds.
function reset_interval(){
    //first step: clear the existing timer
    clearInterval(timer); 
    //second step: implement the timer again
    timer = setInterval(function(){ auto_logout() }, 900000);
    //..completed the reset of the timer
}
    
function auto_logout(){
    //this function will redirect the user to the logout script
    $("#logoutAuto").modal("show");
}

function firsttable(){
    document.getElementById('firstYear').style.display='block'; 
    document.getElementById('secondYear').style.display='none'; 
    document.getElementById('thirdYear').style.display='none'; 
    document.getElementById('fourthYear').style.display='none'; 
    document.getElementById('fifthYear').style.display='none';

    document.getElementById('tab1').style.color = 'white'; 
    document.getElementById('tab2').style.color = 'red'; 
    document.getElementById('tab3').style.color = 'red'; 
    document.getElementById('tab4').style.color = 'red';
    document.getElementById('tab5').style.color = 'red'; 

    document.getElementById('tab1').style.backgroundColor = 'red'; 
    document.getElementById('tab2').style.backgroundColor = 'white'; 
    document.getElementById('tab3').style.backgroundColor = 'white'; 
    document.getElementById('tab4').style.backgroundColor = 'white';
    document.getElementById('tab5').style.backgroundColor = 'white';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".up_1st_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_1st").show();
                $(".show_1st_grade_1st").hide();
                $(".up_grade_button").show();
                $('.check_1st_sem_1st').prop('checked', true);
            } else {
                $(".hide_1st_grade_1st").hide();
                $(".show_1st_grade_1st").show();
                $(".up_grade_button").hide();
                $('.check_1st_sem_1st').prop('checked', false);
            }
        });
        $('.up_1st_sem_1st').trigger('change');
    });

    $(function () {
        $(".up_1st_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_2nd").show();
                $(".show_1st_grade_2nd").hide();
                $(".up_grade_button_1st_2nd").show();
                $('.check_1st_sem_2nd').prop('checked', true);
            } else {
                $(".hide_1st_grade_2nd").hide();
                $(".show_1st_grade_2nd").show();
                $(".up_grade_button_1st_2nd").hide();
                $('.check_1st_sem_2nd').prop('checked', false);
            }
        });
        $('.up_1st_sem_2nd').trigger('change');
    });

    $(function () {
        $(".up_1st_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_summer").show();
                $(".show_1st_grade_summer").hide();
                $(".up_grade_button_1st_summer").show();
                $('.check_1st_sem_summer').prop('checked', true);
            } else {
                $(".hide_1st_grade_summer").hide();
                $(".show_1st_grade_summer").show();
                $(".up_grade_button_1st_summer").hide();
                $('.check_1st_sem_summer').prop('checked', false);
            }
        });
        $('.up_1st_sem_summer').trigger('change');
    });

    $('#table11stsem').on('change', ':checkbox', function() {
        $('#button_update').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table12ndsem').on('change', ':checkbox', function() {
        $('#button_update_1st_2nd').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table1summersem').on('change', ':checkbox', function() {
        $('#button_update_1st_summer').toggle(!!$('input:checkbox:checked').length);
    });

    if ( $.fn.dataTable.isDataTable( '#table11stsem' ) ) {
        table = $('#table11stsem').DataTable();
    }
    else {
        table = $('#table11stsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table12ndsem' ) ) {
        table = $('#table12ndsem').DataTable();
    }
    else {
        table = $('#table12ndsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table1summersem' ) ) {
        table = $('#table1summersem').DataTable();
    }
    else {
        table = $('#table1summersem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }
}

function secondtable(){
    document.getElementById('firstYear').style.display='none'; 
    document.getElementById('secondYear').style.display='block'; 
    document.getElementById('thirdYear').style.display='none'; 
    document.getElementById('fourthYear').style.display='none'; 
    document.getElementById('fifthYear').style.display='none';

    document.getElementById('tab1').style.color = 'red'; 
    document.getElementById('tab2').style.color = 'white'; 
    document.getElementById('tab3').style.color = 'red'; 
    document.getElementById('tab4').style.color = 'red';
    document.getElementById('tab5').style.color = 'red'; 

    document.getElementById('tab1').style.backgroundColor = 'white'; 
    document.getElementById('tab2').style.backgroundColor = 'red'; 
    document.getElementById('tab3').style.backgroundColor = 'white'; 
    document.getElementById('tab4').style.backgroundColor = 'white';
    document.getElementById('tab5').style.backgroundColor = 'white';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".up_2nd_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_1st").show();
                $(".show_2nd_grade_1st").hide();
                $(".up_grade_button_2nd_1st").show();
                $('.check_2nd_sem_1st').prop('checked', true);
            } else {
                $(".hide_2nd_grade_1st").hide();
                $(".show_2nd_grade_1st").show();
                $(".up_grade_button_2nd_1st").hide();
                $('.check_2nd_sem_1st').prop('checked', false);
            }
        });
        $('.up_2nd_sem_1st').trigger('change');
    });

    $(function () {
        $(".up_2nd_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_2nd").show();
                $(".show_2nd_grade_2nd").hide();
                $(".up_grade_button_2nd_2nd").show();
                $('.check_2nd_sem_2nd').prop('checked', true);
            } else {
                $(".hide_2nd_grade_2nd").hide();
                $(".show_2nd_grade_2nd").show();
                $(".up_grade_button_2nd_2nd").hide();
                $('.check_2nd_sem_2nd').prop('checked', false);
            }
        });
        $('.up_2nd_sem_2nd').trigger('change');
    });

    $(function () {
        $(".up_2nd_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_summer").show();
                $(".show_2nd_grade_summer").hide();
                $(".up_grade_button_2nd_summer").show();
                $('.check_2nd_sem_summer').prop('checked', true);
            } else {
                $(".hide_2nd_grade_summer").hide();
                $(".show_2nd_grade_summer").show();
                $(".up_grade_button_2nd_summer").hide();
                $('.check_2nd_sem_summer').prop('checked', false);
            }
        });
        $('.up_2nd_sem_summer').trigger('change');
    });

    $('#table21stsem').on('change', ':checkbox', function() {
        $('#button_update_2nd_1st').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table22ndsem').on('change', ':checkbox', function() {
        $('#button_update_2nd_2nd').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table2summersem').on('change', ':checkbox', function() {
        $('#button_update_2nd_summer').toggle(!!$('input:checkbox:checked').length);
    });

    if ( $.fn.dataTable.isDataTable( '#table21stsem' ) ) {
        table = $('#table21stsem').DataTable();
    }
    else {
        table = $('#table21stsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table22ndsem' ) ) {
        table = $('#table22ndsem').DataTable();
    }
    else {
        table = $('#table22ndsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table2summersem' ) ) {
        table = $('#table2summersem').DataTable();
    }
    else {
        table = $('#table2summersem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }
}

function thirdtable(){
    document.getElementById('firstYear').style.display='none'; 
    document.getElementById('secondYear').style.display='none'; 
    document.getElementById('thirdYear').style.display='block'; 
    document.getElementById('fourthYear').style.display='none'; 
    document.getElementById('fifthYear').style.display='none';

    document.getElementById('tab1').style.color = 'red'; 
    document.getElementById('tab2').style.color = 'red'; 
    document.getElementById('tab3').style.color = 'white'; 
    document.getElementById('tab4').style.color = 'red';
    document.getElementById('tab5').style.color = 'red'; 

    document.getElementById('tab1').style.backgroundColor = 'white'; 
    document.getElementById('tab2').style.backgroundColor = 'white'; 
    document.getElementById('tab3').style.backgroundColor = 'red'; 
    document.getElementById('tab4').style.backgroundColor = 'white';
    document.getElementById('tab5').style.backgroundColor = 'white';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".up_3rd_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_1st").show();
                $(".show_3rd_grade_1st").hide();
                $(".up_grade_button_3rd_1st").show();
                $('.check_3rd_sem_1st').prop('checked', true);
            } else {
                $(".hide_3rd_grade_1st").hide();
                $(".show_3rd_grade_1st").show();
                $(".up_grade_button_3rd_1st").hide();
                $('.check_3rd_sem_1st').prop('checked', false);
            }
        });
        $('.up_3rd_sem_1st').trigger('change');
    });

    $(function () {
        $(".up_3rd_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_2nd").show();
                $(".show_3rd_grade_2nd").hide();
                $(".up_grade_button_3rd_2nd").show();
                $('.check_3rd_sem_2nd').prop('checked', true);
            } else {
                $(".hide_3rd_grade_2nd").hide();
                $(".show_3rd_grade_2nd").show();
                $(".up_grade_button_3rd_2nd").hide();
                $('.check_3rd_sem_2nd').prop('checked', false);
            }
        });
        $('.up_3rd_sem_2nd').trigger('change');
    });

    $(function () {
        $(".up_3rd_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_summer").show();
                $(".show_3rd_grade_summer").hide();
                $(".up_grade_button_3rd_summer").show();
                $('.check_3rd_sem_summer').prop('checked', true);
            } else {
                $(".hide_3rd_grade_summer").hide();
                $(".show_3rd_grade_summer").show();
                $(".up_grade_button_3rd_summer").hide();
                $('.check_3rd_sem_summer').prop('checked', false);
            }
        });
        $('.up_3rd_sem_summer').trigger('change');
    });

    $('#table31stsem').on('change', ':checkbox', function() {
        $('#button_update_3rd_1st').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table32ndsem').on('change', ':checkbox', function() {
        $('#button_update_3rd_2nd').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table3summersem').on('change', ':checkbox', function() {
        $('#button_update_3rd_summer').toggle(!!$('input:checkbox:checked').length);
    });

    if ( $.fn.dataTable.isDataTable( '#table31stsem' ) ) {
        table = $('#table31stsem').DataTable();
    }
    else {
        table = $('#table31stsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table32ndsem' ) ) {
        table = $('#table32ndsem').DataTable();
    }
    else {
        table = $('#table32ndsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table3summersem' ) ) {
        table = $('#table3summersem').DataTable();
    }
    else {
        table = $('#table3summersem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }
}

function fourthtable(){
    document.getElementById('firstYear').style.display='none'; 
    document.getElementById('secondYear').style.display='none'; 
    document.getElementById('thirdYear').style.display='none'; 
    document.getElementById('fourthYear').style.display='block'; 
    document.getElementById('fifthYear').style.display='none';

    document.getElementById('tab1').style.color = 'red'; 
    document.getElementById('tab2').style.color = 'red'; 
    document.getElementById('tab3').style.color = 'red'; 
    document.getElementById('tab4').style.color = 'white';
    document.getElementById('tab5').style.color = 'red'; 

    document.getElementById('tab1').style.backgroundColor = 'white'; 
    document.getElementById('tab2').style.backgroundColor = 'white'; 
    document.getElementById('tab3').style.backgroundColor = 'white'; 
    document.getElementById('tab4').style.backgroundColor = 'red';
    document.getElementById('tab5').style.backgroundColor = 'white';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".up_4th_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_1st").show();
                $(".show_4th_grade_1st").hide();
                $(".up_grade_button_4th_1st").show();
                $('.check_4th_sem_1st').prop('checked', true);
            } else {
                $(".hide_4th_grade_1st").hide();
                $(".show_4th_grade_1st").show();
                $(".up_grade_button_4th_1st").hide();
                $('.check_4th_sem_1st').prop('checked', false);
            }
        });
        $('.up_4th_sem_1st').trigger('change');
    });

    $(function () {
        $(".up_4th_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_2nd").show();
                $(".show_4th_grade_2nd").hide();
                $(".up_grade_button_4th_2nd").show();
                $('.check_4th_sem_2nd').prop('checked', true);
            } else {
                $(".hide_4th_grade_2nd").hide();
                $(".show_4th_grade_2nd").show();
                $(".up_grade_button_4th_2nd").hide();
                $('.check_4th_sem_2nd').prop('checked', false);
            }
        });
        $('.up_4th_sem_2nd').trigger('change');
    });

    $(function () {
        $(".up_4th_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_summer").show();
                $(".show_4th_grade_summer").hide();
                $(".up_grade_button_4th_summer").show();
                $('.check_4th_sem_summer').prop('checked', true);
            } else {
                $(".hide_4th_grade_summer").hide();
                $(".show_4th_grade_summer").show();
                $(".up_grade_button_4th_summer").hide();
                $('.check_4th_sem_summer').prop('checked', false);
            }
        });
        $('.up_4th_sem_summer').trigger('change');
    });

    $('#table41stsem').on('change', ':checkbox', function() {
        $('#button_update_4th_1st').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table42ndsem').on('change', ':checkbox', function() {
        $('#button_update_4th_2nd').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table4summersem').on('change', ':checkbox', function() {
        $('#button_update_4th_summer').toggle(!!$('input:checkbox:checked').length);
    });

    if ( $.fn.dataTable.isDataTable( '#table41stsem' ) ) {
        table = $('#table41stsem').DataTable();
    }
    else {
        table = $('#table41stsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table42ndsem' ) ) {
        table = $('#table42ndsem').DataTable();
    }
    else {
        table = $('#table42ndsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table4summersem' ) ) {
        table = $('#table4summersem').DataTable();
    }
    else {
        table = $('#table4summersem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }
}

function fifthtable(){
    document.getElementById('firstYear').style.display='none'; 
    document.getElementById('secondYear').style.display='none'; 
    document.getElementById('thirdYear').style.display='none'; 
    document.getElementById('fourthYear').style.display='none'; 
    document.getElementById('fifthYear').style.display='block';

    document.getElementById('tab1').style.color = 'red'; 
    document.getElementById('tab2').style.color = 'red'; 
    document.getElementById('tab3').style.color = 'red'; 
    document.getElementById('tab4').style.color = 'red';
    document.getElementById('tab5').style.color = 'white'; 

    document.getElementById('tab1').style.backgroundColor = 'white'; 
    document.getElementById('tab2').style.backgroundColor = 'white'; 
    document.getElementById('tab3').style.backgroundColor = 'white'; 
    document.getElementById('tab4').style.backgroundColor = 'white';
    document.getElementById('tab5').style.backgroundColor = 'red';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".up_5th_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_1st").show();
                $(".show_5th_grade_1st").hide();
                $(".up_grade_button_5th_1st").show();
                $('.check_5th_sem_1st').prop('checked', true);
            } else {
                $(".hide_5th_grade_1st").hide();
                $(".show_5th_grade_1st").show();
                $(".up_grade_button_5th_1st").hide();
                $('.check_5th_sem_1st').prop('checked', false);
            }
        });
        $('.up_5th_sem_1st').trigger('change');
    });

    $(function () {
        $(".up_5th_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_2nd").show();
                $(".show_5th_grade_2nd").hide();
                $(".up_grade_button_5th_2nd").show();
                $('.check_5th_sem_2nd').prop('checked', true);
            } else {
                $(".hide_5th_grade_2nd").hide();
                $(".show_5th_grade_2nd").show();
                $(".up_grade_button_5th_2nd").hide();
                $('.check_5th_sem_2nd').prop('checked', false);
            }
        });
        $('.up_5th_sem_2nd').trigger('change');
    });

    $(function () {
        $(".up_5th_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_summer").show();
                $(".show_5th_grade_summer").hide();
                $(".up_grade_button_5th_summer").show();
                $('.check_5th_sem_summer').prop('checked', true);
            } else {
                $(".hide_5th_grade_summer").hide();
                $(".show_5th_grade_summer").show();
                $(".up_grade_button_5th_summer").hide();
                $('.check_5th_sem_summer').prop('checked', false);
            }
        });
        $('.up_5th_sem_summer').trigger('change');
    });

    $('#table51stsem').on('change', ':checkbox', function() {
        $('#button_update_5th_1st').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table52ndsem').on('change', ':checkbox', function() {
        $('#button_update_5th_2nd').toggle(!!$('input:checkbox:checked').length);
    });

    $('#table5summersem').on('change', ':checkbox', function() {
        $('#button_update_5th_summer').toggle(!!$('input:checkbox:checked').length);
    });

    if ( $.fn.dataTable.isDataTable( '#table51stsem' ) ) {
        table = $('#table51stsem').DataTable();
    }
    else {
        table = $('#table51stsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table52ndsem' ) ) {
        table = $('#table52ndsem').DataTable();
    }
    else {
        table = $('#table52ndsem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }

    if ( $.fn.dataTable.isDataTable( '#table5summersem' ) ) {
        table = $('#table5summersem').DataTable();
    }
    else {
        table = $('#table5summersem').DataTable( {
            searching: false,
            paging: false,
            ordering: false,
            info: false
        } );
    }
}