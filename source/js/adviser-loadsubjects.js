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
    $('body').on('click','.editSendSubject',function() {
        $('#editSendSubjectModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#').val(data[0]);
    });
});

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

if ( $.fn.dataTable.isDataTable( '#table1year1st' ) ) {
    table = $('#table1year1st').DataTable();
}
else 
{
    table = $('#table1year1st').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table1year2nd' ) ) {
    table = $('#table1year2nd').DataTable();
}
else 
{
    table = $('#table1year2nd').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table1yearsummer' ) ) {
    table = $('#table1yearsummer').DataTable();
}
else 
{
    table = $('#table1yearsummer').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table2year1st' ) ) {
    table = $('#table2year1st').DataTable();
}
else 
{
    table = $('#table2year1st').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table2year2nd' ) ) {
    table = $('#table2year2nd').DataTable();
}
else 
{
    table = $('#table2year2nd').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table2yearsummer' ) ) {
    table = $('#table2yearsummer').DataTable();
}
else 
{
    table = $('#table2yearsummer').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table3year1st' ) ) {
    table = $('#table3year1st').DataTable();
}
else 
{
    table = $('#table3year1st').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table3year2nd' ) ) {
    table = $('#table3year2nd').DataTable();
}
else 
{
    table = $('#table3year2nd').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table3yearsummer' ) ) {
    table = $('#table3yearsummer').DataTable();
}
else 
{
    table = $('#table3yearsummer').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table4year1st' ) ) {
    table = $('#table4year1st').DataTable();
}
else 
{
    table = $('#table4year1st').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table4year2nd' ) ) {
    table = $('#table4year2nd').DataTable();
}
else 
{
    table = $('#table4year2nd').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table4yearsummer' ) ) {
    table = $('#table4yearsummer').DataTable();
}
else 
{
    table = $('#table4yearsummer').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table5year1st' ) ) {
    table = $('#table5year1st').DataTable();
}
else 
{
    table = $('#table5year1st').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table5year2nd' ) ) {
    table = $('#table5year2nd').DataTable();
}
else 
{
    table = $('#table5year2nd').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

if ( $.fn.dataTable.isDataTable( '#table5yearsummer' ) ) {
    table = $('#table5yearsummer').DataTable();
}
else 
{
    table = $('#table5yearsummer').DataTable( {
        paging: false,
        ordering: false,
        info: false
    } );
}

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

//Start of First Year Subject and Grades List//
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".check_1st_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_1st").show();
                $(".show_1st_grade_1st").hide();
            } else {
                $(".hide_1st_grade_1st").hide();
                $(".show_1st_grade_1st").show();
            }
        });
    });

    $(function () {
        $("#chckAll1stsem1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_1st").show();
                $(".show_1st_grade_1st").hide();
            } else {
                $(".hide_1st_grade_1st").hide();
                $(".show_1st_grade_1st").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_1st_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_2nd").show();
                $(".show_1st_grade_2nd").hide();
            } else {
                $(".hide_1st_grade_2nd").hide();
                $(".show_1st_grade_2nd").show();
            }
        });
    });

    $(function () {
        $("#chckAll1stsem2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_2nd").show();
                $(".show_1st_grade_2nd").hide();
            } else {
                $(".hide_1st_grade_2nd").hide();
                $(".show_1st_grade_2nd").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_1st_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_summer").show();
                $(".show_1st_grade_summer").hide();
            } else {
                $(".hide_1st_grade_summer").hide();
                $(".show_1st_grade_summer").show();
            }
        });
    });

    $(function () {
        $("#chckAll1stsemsummer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_1st_grade_summer").show();
                $(".show_1st_grade_summer").hide();
            } else {
                $(".hide_1st_grade_summer").hide();
                $(".show_1st_grade_summer").show();chckAll1stsem1st
            }
        });
    });

    $(document).ready(function() {
        var $selectAll1stsem1st = $('#chckAll1stsem1st'); // main checkbox inside table thead
        var $table1stsem1st = $('#table11stsem'); // table selector 
        var $tdCheckbox1stsem1st = $table1stsem1st.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked1stsem1st = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll1stsem1st.on('click', function () {
            $tdCheckbox1stsem1st.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox1stsem1st.on('change', function(e){
            tdCheckboxChecked1stsem1st = $table1stsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll1stsem1st.prop('checked', (tdCheckboxChecked1stsem1st === $tdCheckbox1stsem1st.length));
        })
    });

    $(document).ready(function() {
        var $selectAll1stsem2nd = $('#chckAll1stsem2nd'); // main checkbox inside table thead
        var $table1stsem2nd = $('#table12ndsem'); // table selector 
        var $tdCheckbox1stsem2nd= $table1stsem2nd.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked1stsem2nd = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll1stsem2nd.on('click', function () {
            $tdCheckbox1stsem2nd.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox1stsem2nd.on('change', function(e){
            tdCheckboxChecked1stsem2nd = $table1stsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll1stsem2nd.prop('checked', (tdCheckboxChecked1stsem2nd === $tdCheckbox1stsem2nd.length));
        })
    });

    $(document).ready(function() {
        var $selectAll1stsemsummer = $('#chckAll1stsemsummer'); // main checkbox inside table thead
        var $table1stsemsummer = $('#table1summersem'); // table selector 
        var $tdCheckbox1stsemsummer = $table1stsemsummer.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked1stsemsummer = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll1stsemsummer.on('click', function () {
            $tdCheckbox1stsemsummer.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox1stsemsummer.on('change', function(e){
            tdCheckboxChecked1stsemsummer = $table1stsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll1stsemsummer.prop('checked', (tdCheckboxChecked1stsemsummer === $tdCheckbox1stsemsummer.length));
        })
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
            paging: false,
            ordering: false,
            info: false
        } );
    }

    $(document).ready(function() {
    $('body').on('click','.edit1stSubject1stbtn',function() {
        $('#edit1stSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#1st_subject_preid_1st').val(data[1]);
        $('#none2').val(data[2]);
        $('#1st_subject_1st').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#1st_grade_1st').val(data[8]);
        $('#1st_year_1st').val(data[9]);
        $('#1st_sem_1st').val(data[10]);
        $('#1st_subject_id_1st').val(data[11]);
        $('#none7').val(data[12]);
        $('#1st_remarks_1st').val(data[13]);
        $('#1st_schoolyear_1st').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit1stSubject2ndbtn',function() {
        $('#edit1stSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#1st_subject_preid_2nd').val(data[1]);
        $('#none2').val(data[2]);
        $('#1st_subject_2nd').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#1st_grade_2nd').val(data[8]);
        $('#1st_year_2nd').val(data[9]);
        $('#1st_sem_2nd').val(data[10]);
        $('#1st_subject_id_2nd').val(data[11]);
        $('#none7').val(data[12]);
        $('#1st_remarks_2nd').val(data[13]);
        $('#1st_schoolyear_2nd').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit1stSubjectsummerbtn',function() {
        $('#edit1stSubjectsummerModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#1st_subject_preid_summer').val(data[1]);
        $('#none2').val(data[2]);
        $('#1st_subject_summer').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#1st_grade_summer').val(data[8]);
        $('#1st_year_summer').val(data[9]);
        $('#1st_sem_summer').val(data[10]);
        $('#1st_subject_id_summer').val(data[11]);
        $('#none7').val(data[12]);
        $('#1st_remarks_summer').val(data[13]);
        $('#1st_schoolyear_summer').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete1stSubject1stbtn',function() {
        $('#delete1stSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#delete_sub_id_1st_1st').val(data[0]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete1stSubject2ndbtn',function() {
        $('#delete1stSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#delete_sub_id_1st_2nd').val(data[0]);
    });
    });
//End of First Year Subject and Grades List//
//Start of Second Year Subject and Grades List//
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".check_2nd_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_1st").show();
                $(".show_2nd_grade_1st").hide();
            } else {
                $(".hide_2nd_grade_1st").hide();
                $(".show_2nd_grade_1st").show();
            }
        });
    });

    $(function () {
        $("#chckAll2ndsem1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_1st").show();
                $(".show_2nd_grade_1st").hide();
            } else {
                $(".hide_2nd_grade_1st").hide();
                $(".show_2nd_grade_1st").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_2nd_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_2nd").show();
                $(".show_2nd_grade_2nd").hide();
            } else {
                $(".hide_2nd_grade_2nd").hide();
                $(".show_2nd_grade_2nd").show();
            }
        });
    });

    $(function () {
        $("#chckAll2ndsem2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_2nd").show();
                $(".show_2nd_grade_2nd").hide();
            } else {
                $(".hide_2nd_grade_2nd").hide();
                $(".show_2nd_grade_2nd").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_2nd_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_summer").show();
                $(".show_2nd_grade_summer").hide();
            } else {
                $(".hide_2nd_grade_summer").hide();
                $(".show_2nd_grade_summer").show();
            }
        });
    });

    $(function () {
        $("#chckAll2ndsemsummer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_2nd_grade_summer").show();
                $(".show_2nd_grade_summer").hide();
            } else {
                $(".hide_2nd_grade_summer").hide();
                $(".show_2nd_grade_summer").show();chckAll1stsem1st
            }
        });
    });

    $(document).ready(function() {
        var $selectAll2ndsem1st = $('#chckAll2ndsem1st'); // main checkbox inside table thead
        var $table2ndsem1st = $('#table21stsem'); // table selector 
        var $tdCheckbox2ndsem1st = $table2ndsem1st.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked2ndsem1st = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll2ndsem1st.on('click', function () {
            $tdCheckbox2ndsem1st.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox2ndsem1st.on('change', function(e){
            tdCheckboxChecked2ndsem1st = $table2ndsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll2ndsem1st.prop('checked', (tdCheckboxChecked2ndsem1st === $tdCheckbox2ndsem1st.length));
        })
    });

    $(document).ready(function() {
        var $selectAll2ndsem2nd = $('#chckAll2ndsem2nd'); // main checkbox inside table thead
        var $table2ndsem2nd = $('#table22ndsem'); // table selector 
        var $tdCheckbox2ndsem2nd= $table2ndsem2nd.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked2ndsem2nd = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll2ndsem2nd.on('click', function () {
            $tdCheckbox2ndsem2nd.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox2ndsem2nd.on('change', function(e){
            tdCheckboxChecked2ndsem2nd = $table2ndsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll2ndsem2nd.prop('checked', (tdCheckboxChecked2ndsem2nd === $tdCheckbox2ndsem2nd.length));
        })
    });

    $(document).ready(function() {
        var $selectAll2ndsemsummer = $('#chckAll2ndsemsummer'); // main checkbox inside table thead
        var $table2ndsemsummer = $('#table2summersem'); // table selector 
        var $tdCheckbox2ndsemsummer = $table2ndsemsummer.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked2ndsemsummer = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll2ndsemsummer.on('click', function () {
            $tdCheckbox2ndsemsummer.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox2ndsemsummer.on('change', function(e){
            tdCheckboxChecked2ndsemsummer = $table2ndsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll2ndsemsummer.prop('checked', (tdCheckboxChecked2ndsemsummer === $tdCheckbox2ndsemsummer.length));
        })
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
            paging: false,
            ordering: false,
            info: false
        } );
    }

    $(document).ready(function() {
    $('body').on('click','.edit2ndSubject1stbtn',function() {
        $('#edit2ndSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#2nd_subject_preid_1st').val(data[1]);
        $('#none2').val(data[2]);
        $('#2nd_subject_1st').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#2nd_grade_1st').val(data[8]);
        $('#2nd_year_1st').val(data[9]);
        $('#2nd_sem_1st').val(data[10]);
        $('#2nd_subject_id_1st').val(data[11]);
        $('#none7').val(data[12]);
        $('#2nd_remarks_1st').val(data[13]);
        $('#2nd_schoolyear_1st').val(data[14]);
        
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit2ndSubject2ndbtn',function() {
        $('#edit2ndSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#2nd_subject_preid_2nd').val(data[1]);
        $('#none2').val(data[2]);
        $('#2nd_subject_2nd').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#2nd_grade_2nd').val(data[8]);
        $('#2nd_year_2nd').val(data[9]);
        $('#2nd_sem_2nd').val(data[10]);
        $('#2nd_subject_id_2nd').val(data[11]);
        $('#none7').val(data[12]);
        $('#2nd_remarks_2nd').val(data[13]);
        $('#2nd_schoolyear_2nd').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit2ndSubjectsummerbtn',function() {
        $('#edit2ndSubjectsummerModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#2nd_subject_preid_summer').val(data[1]);
        $('#none2').val(data[2]);
        $('#2nd_subject_summer').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#2nd_grade_summer').val(data[8]);
        $('#2nd_year_summer').val(data[9]);
        $('#2nd_sem_summer').val(data[10]);
        $('#2nd_subject_id_summer').val(data[11]);
        $('#none7').val(data[12]);
        $('#2nd_remarks_summer').val(data[13]);
        $('#2nd_schoolyear_summer').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete2ndSubject1stbtn',function() {
        $('#delete2ndSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_2nd_1st').val(data[0]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete2ndSubject2ndbtn',function() {
        $('#delete2ndSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_2nd_2nd').val(data[0]);
    });
    });
//End of Second Year Subject and Grades List//
//Start of Third Year Subject and Grades List//
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".check_3rd_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_1st").show();
                $(".show_3rd_grade_1st").hide();
            } else {
                $(".hide_3rd_grade_1st").hide();
                $(".show_3rd_grade_1st").show();
            }
        });
    });

    $(function () {
        $("#chckAll3rdsem1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_1st").show();
                $(".show_3rd_grade_1st").hide();
            } else {
                $(".hide_3rd_grade_1st").hide();
                $(".show_3rd_grade_1st").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_3rd_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_2nd").show();
                $(".show_3rd_grade_2nd").hide();
            } else {
                $(".hide_3rd_grade_2nd").hide();
                $(".show_3rd_grade_2nd").show();
            }
        });
    });

    $(function () {
        $("#chckAll3rdsem2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_2nd").show();
                $(".show_3rd_grade_2nd").hide();
            } else {
                $(".hide_3rd_grade_2nd").hide();
                $(".hide_3rd_grade_2nd").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_3rd_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_summer").show();
                $(".show_3rd_grade_summer").hide();
            } else {
                $(".hide_3rd_grade_summer").hide();
                $(".show_3rd_grade_summer").show();
            }
        });
    });

    $(function () {
        $("#chckAll3rdsemsummer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_3rd_grade_summer").show();
                $(".show_3rd_grade_summer").hide();
            } else {
                $(".hide_3rd_grade_summer").hide();
                $(".show_3rd_grade_summer").show();chckAll1stsem1st
            }
        });
    });

    $(document).ready(function() {
        var $selectAll3rdsem1st = $('#chckAll3rdsem1st'); // main checkbox inside table thead
        var $table3rdsem1st = $('#table31stsem'); // table selector 
        var $tdCheckbox3rdsem1st = $table3rdsem1st.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked3rdsem1st = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll3rdsem1st.on('click', function () {
            $tdCheckbox3rdsem1st.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox3rdsem1st.on('change', function(e){
            tdCheckboxChecked3rdsem1st = $table3rdsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll3rdsem1st.prop('checked', (tdCheckboxChecked3rdsem1st === $tdCheckbox3rdsem1st.length));
        })
    });

    $(document).ready(function() {
        var $selectAll3rdsem2nd = $('#chckAll3rdsem2nd'); // main checkbox inside table thead
        var $table3rdsem2nd = $('#table32ndsem'); // table selector 
        var $tdCheckbox3rdsem2nd= $table3rdsem2nd.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked3rdsem2nd = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll3rdsem2nd.on('click', function () {
            $tdCheckbox3rdsem2nd.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox3rdsem2nd.on('change', function(e){
            tdCheckboxChecked3rdsem2nd = $table3rdsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll3rdsem2nd.prop('checked', (tdCheckboxChecked3rdsem2nd === $tdCheckbox3rdsem2nd.length));
        })
    });

    $(document).ready(function() {
        var $selectAll3rdsemsummer = $('#chckAll3rdsemsummer'); // main checkbox inside table thead
        var $table3rdsemsummer = $('#table3summersem'); // table selector 
        var $tdCheckbox3rdsemsummer = $table2ndsemsummer.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked3rdsemsummer = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll3rdsemsummer.on('click', function () {
            $tdCheckbox3rdsemsummer.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox3rdsemsummer.on('change', function(e){
            tdCheckboxChecked3rdsemsummer = $table3rdsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll3rdsemsummer.prop('checked', (tdCheckboxChecked3rdsemsummer === $tdCheckbox3rdsemsummer.length));
        })
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
            paging: false,
            ordering: false,
            info: false
        } );
    }

    $(document).ready(function() {
    $('body').on('click','.edit3rdSubject1stbtn',function() {
        $('#edit3rdSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#3rd_subject_preid_1st').val(data[1]);
        $('#none2').val(data[2]);
        $('#3rd_subject_1st').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#3rd_grade_1st').val(data[8]);
        $('#3rd_remarks_1st').val(data[9]);
        $('#3rd_year_1st').val(data[10]);
        $('#3rd_sem_1st').val(data[11]);
        $('#3rd_subject_id_1st').val(data[12]);
        $('#none7').val(data[13]);
        $('#3rd_schoolyear_1st').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit3rdSubject2ndbtn',function() {
        $('#edit3rdSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#3rd_subject_preid_2nd').val(data[1]);
        $('#none2').val(data[2]);
        $('#3rd_subject_2nd').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#3rd_grade_2nd').val(data[8]);
        $('#3rd_remarks_2nd').val(data[9]);
        $('#3rd_year_2nd').val(data[10]);
        $('#3rd_sem_2nd').val(data[11]);
        $('#3rd_subject_id_2nd').val(data[12]);
        $('#none7').val(data[13]);
        $('#3rd_schoolyear_2nd').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit3rdSubjectsummerbtn',function() {
        $('#edit3rdSubjectsummerModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#3rd_subject_preid_summer').val(data[1]);
        $('#none2').val(data[2]);
        $('#3rd_subject_summer').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#3rd_grade_summer').val(data[8]);
        $('#3rd_remarks_summer').val(data[9]);
        $('#3rd_year_summer').val(data[10]);
        $('#3rd_sem_summer').val(data[11]);
        $('#3rd_subject_id_summer').val(data[12]);
        $('#none7').val(data[13]);
        $('#3rd_schoolyear_summer').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete3rdSubject1stbtn',function() {
        $('#delete3rdSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_3rd_1st').val(data[0]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete3rdSubject2ndbtn',function() {
        $('#delete3rdSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_3rd_2nd').val(data[0]);
    });
    });
//End of Third Year Subject and Grades List//
//Start of Fourth Year Subject and Grades List//
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".check_4th_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_1st").show();
                $(".show_4th_grade_1st").hide();
            } else {
                $(".hide_4th_grade_1st").hide();
                $(".show_4th_grade_1st").show();
            }
        });
    });

    $(function () {
        $("#chckAll4thsem1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_1st").show();
                $(".show_4th_grade_1st").hide();
            } else {
                $(".hide_4th_grade_1st").hide();
                $(".show_4th_grade_1st").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_4th_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_2nd").show();
                $(".show_4th_grade_2nd").hide();
            } else {
                $(".hide_4th_grade_2nd").hide();
                $(".show_4th_grade_2nd").show();
            }
        });
    });

    $(function () {
        $("#chckAll4thsem2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_2nd").show();
                $(".show_4th_grade_2nd").hide();
            } else {
                $(".hide_4th_grade_2nd").hide();
                $(".show_4th_grade_2nd").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_4th_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_summer").show();
                $(".show_4th_grade_summer").hide();
            } else {
                $(".hide_4th_grade_summer").hide();
                $(".show_4th_grade_summer").show();
            }
        });
    });

    $(function () {
        $("#chckAll4thsemsummer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_4th_grade_summer").show();
                $(".show_4th_grade_summer").hide();
            } else {
                $(".hide_4th_grade_summer").hide();
                $(".show_4th_grade_summer").show();chckAll1stsem1st
            }
        });
    });

    $(document).ready(function() {
        var $selectAll4thsem1st = $('#chckAll4thsem1st'); // main checkbox inside table thead
        var $table4thsem1st = $('#table41stsem'); // table selector 
        var $tdCheckbox4thsem1st = $table4thsem1st.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked4thsem1st = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll4thsem1st.on('click', function () {
            $tdCheckbox4thsem1st.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox4thsem1st.on('change', function(e){
            tdCheckboxChecked4thsem1st = $table4thsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll4thsem1st.prop('checked', (tdCheckboxChecked4thsem1st === $tdCheckbox4thsem1st.length));
        })
    });

    $(document).ready(function() {
        var $selectAll4thsem2nd = $('#chckAll4thsem2nd'); // main checkbox inside table thead
        var $table4thsem2nd = $('#table42ndsem'); // table selector 
        var $tdCheckbox4thsem2nd= $table4thsem2nd.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked4thsem2nd = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll4thsem2nd.on('click', function () {
            $tdCheckbox4thsem2nd.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox4thsem2nd.on('change', function(e){
            tdCheckboxChecked4thsem2nd = $table4thsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll4thsem2nd.prop('checked', (tdCheckboxChecked4thsem2nd === $tdCheckbox4thsem2nd.length));
        })
    });

    $(document).ready(function() {
        var $selectAll4thsemsummer = $('#chckAll4thsemsummer'); // main checkbox inside table thead
        var $table4thsemsummer = $('#table4summersem'); // table selector 
        var $tdCheckbox4thsemsummer = $table4thsemsummer.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked4thsemsummer = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll4thsemsummer.on('click', function () {
            $tdCheckbox4thsemsummer.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox4thsemsummer.on('change', function(e){
            tdCheckboxChecked4thsemsummer = $table4thsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll4thsemsummer.prop('checked', (tdCheckboxChecked4thsemsummer === $tdCheckbox4thsemsummer.length));
        })
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
            paging: false,
            ordering: false,
            info: false
        } );
    }

    $(document).ready(function() {
    $('body').on('click','.edit4thSubject1stbtn',function() {
        $('#edit4thSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#4th_subject_preid_1st').val(data[1]);
        $('#none2').val(data[2]);
        $('#4th_subject_1st').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#4th_grade_1st').val(data[8]);
        $('#4th_remarks_1st').val(data[9]);
        $('#4th_year_1st').val(data[10]);
        $('#4th_sem_1st').val(data[11]);
        $('#4th_subject_id_1st').val(data[12]);
        $('#none7').val(data[13]);
        $('#4th_schoolyear_1st').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit4thSubject2ndbtn',function() {
        $('#edit4thSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#4th_subject_preid_2nd').val(data[1]);
        $('#none2').val(data[2]);
        $('#4th_subject_2nd').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#4th_grade_2nd').val(data[8]);
        $('#4th_remarks_2nd').val(data[9]);
        $('#4th_year_2nd').val(data[10]);
        $('#4th_sem_2nd').val(data[11]);
        $('#4th_subject_id_2nd').val(data[12]);
        $('#none7').val(data[13]);
        $('#4th_schoolyear_2nd').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit4thSubjectsummerbtn',function() {
        $('#edit4thSubjectsummerModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#4th_subject_preid_summer').val(data[1]);
        $('#none2').val(data[2]);
        $('#4th_subject_summer').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#4th_grade_summer').val(data[8]);
        $('#4th_remarks_summer').val(data[9]);
        $('#4th_year_summer').val(data[10]);
        $('#4th_sem_summer').val(data[11]);
        $('#4th_subject_id_summer').val(data[12]);
        $('#none7').val(data[13]);
        $('#4th_schoolyear_summer').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete4thSubject1stbtn',function() {
        $('#delete4thSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_4th_1st').val(data[0]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete4thSubject2ndbtn',function() {
        $('#delete4thSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_4th_2nd').val(data[0]);
    });
    });
//End of Fourth Year Subject and Grades List//
//Start of Fifth Year Subject and Grades List//
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $(".check_5th_sem_1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_1st").show();
                $(".show_5th_grade_1st").hide();
            } else {
                $(".hide_5th_grade_1st").hide();
                $(".show_5th_grade_1st").show();
            }
        });
    });

    $(function () {
        $("#chckAll5thsem1st").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_1st").show();
                $(".show_5th_grade_1st").hide();
            } else {
                $(".hide_5th_grade_1st").hide();
                $(".show_5th_grade_1st").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_5th_sem_2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_2nd").show();
                $(".show_5th_grade_2nd").hide();
            } else {
                $(".hide_5th_grade_2nd").hide();
                $(".show_5th_grade_2nd").show();
            }
        });
    });

    $(function () {
        $("#chckAll5thsem2nd").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_2nd").show();
                $(".show_5th_grade_2nd").hide();
            } else {
                $(".hide_5th_grade_2nd").hide();
                $(".show_5th_grade_2nd").show();chckAll1stsem1st
            }
        });
    });

    $(function () {
        $(".check_5th_sem_summer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_summer").show();
                $(".show_5th_grade_summer").hide();
            } else {
                $(".hide_5th_grade_summer").hide();
                $(".show_5th_grade_summer").show();
            }
        });
    });

    $(function () {
        $("#chckAll5thsemsummer").click(function () {
            if ($(this).is(":checked")) {
                $(".hide_5th_grade_summer").show();
                $(".show_5th_grade_summer").hide();
            } else {
                $(".hide_5th_grade_summer").hide();
                $(".show_5th_grade_summer").show();chckAll1stsem1st
            }
        });
    });

    $(document).ready(function() {
        var $selectAll5thsem1st = $('#chckAll5thsem1st'); // main checkbox inside table thead
        var $table5thsem1st = $('#table51stsem'); // table selector 
        var $tdCheckbox5thsem1st = $table5thsem1st.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked5thsem1st = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll5thsem1st.on('click', function () {
            $tdCheckbox5thsem1st.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox5thsem1st.on('change', function(e){
            tdCheckboxChecked5thsem1st = $table5thsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll5thsem1st.prop('checked', (tdCheckboxChecked5thsem1st === $tdCheckbox5thsem1st.length));
        })
    });

    $(document).ready(function() {
        var $selectAll5thsem2nd = $('#chckAll5thsem2nd'); // main checkbox inside table thead
        var $table5thsem2nd = $('#table52ndsem'); // table selector 
        var $tdCheckbox5thsem2nd= $table5thsem2nd.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked5thsem2nd = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll5thsem2nd.on('click', function () {
            $tdCheckbox5thsem2nd.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox5thsem2nd.on('change', function(e){
            tdCheckboxChecked5thsem2nd = $table5thsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll5thsem2nd.prop('checked', (tdCheckboxChecked5thsem2nd === $tdCheckbox5thsem2nd.length));
        })
    });

    $(document).ready(function() {
        var $selectAll5thsemsummer = $('#chckAll5thsemsummer'); // main checkbox inside table thead
        var $table5thsemsummer = $('#table5summersem'); // table selector 
        var $tdCheckbox5thsemsummer = $table5thsemsummer.find('tbody input:checkbox'); // checboxes inside table body
        var tdCheckboxChecked5thsemsummer = 0; // checked checboxes

        // Select or deselect all checkboxes depending on main checkbox change
        $selectAll5thsemsummer.on('click', function () {
            $tdCheckbox5thsemsummer.prop('checked', this.checked);
        });

        // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
        $tdCheckbox5thsemsummer.on('change', function(e){
            tdCheckboxChecked5thsemsummer = $table5thsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
            // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
            $selectAll5thsemsummer.prop('checked', (tdCheckboxChecked5thsemsummer === $tdCheckbox5thsemsummer.length));
        })
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
            paging: false,
            ordering: false,
            info: false
        } );
    }

    $('#addFifthSubject').on('click', function() {
        $('#addFifthSubjectsmodal').modal('show');
    });

    $('#deleteAllFifthSubject').on('click', function() {
        $('#deleteAllFifthSubjectsmodal').modal('show');
    });

    $(document).ready(function() {
    $('body').on('click','.edit5thSubject1stbtn',function() {
        $('#edit5thSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#5th_subject_preid_1st').val(data[1]);
        $('#none2').val(data[2]);
        $('#5th_subject_1st').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#5th_grade_1st').val(data[8]);
        $('#5th_remarks_1st').val(data[9]);
        $('#5th_year_1st').val(data[10]);
        $('#5th_sem_1st').val(data[11]);
        $('#5th_subject_id_1st').val(data[12]);
        $('#none7').val(data[13]);
        $('#5th_schoolyear_1st').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit5thSubject2ndbtn',function() {
        $('#edit5thSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#5th_subject_preid_2nd').val(data[1]);
        $('#none2').val(data[2]);
        $('#5th_subject_2nd').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#5th_grade_2nd').val(data[8]);
        $('#5th_remarks_2nd').val(data[9]);
        $('#5th_year_2nd').val(data[10]);
        $('#5th_sem_2nd').val(data[11]);
        $('#5th_subject_id_2nd').val(data[12]);
        $('#none7').val(data[13]);
        $('#5th_schoolyear_2nd').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.edit5thSubjectsummerbtn',function() {
        $('#edit5thSubjectsummerModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#none1').val(data[0]);
        $('#5th_subject_preid_summer').val(data[1]);
        $('#none2').val(data[2]);
        $('#5th_subject_summer').val(data[3]);
        $('#none3').val(data[4]);
        $('#none4').val(data[5]);
        $('#none5').val(data[6]);
        $('#none6').val(data[7]);
        $('#5th_grade_summer').val(data[8]);
        $('#5th_remarks_summer').val(data[9]);
        $('#5th_year_summer').val(data[10]);
        $('#5th_sem_summer').val(data[11]);
        $('#5th_subject_id_summer').val(data[12]);
        $('#none7').val(data[13]);
        $('#5th_schoolyear_sumer').val(data[14]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete5thSubject1stbtn',function() {
        $('#delete5thSubject1stModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_5th_1st').val(data[0]);
    });
    });

    $(document).ready(function() {
    $('body').on('click','.delete5thSubject2ndbtn',function() {
        $('#delete5thSubject2ndModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#deleteid_sub_id_5th_2nd').val(data[0]);
    });
    });
//End of Fifth Year Subject and Grades List//