function reloadTable(table){
	// var t = table;
	// alert(t);
    $(table).dataTable().api().ajax.reload();
}

function validate_number(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

function getFormattedDate(date) {
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return year + '-' + month + '-' + day;
}

var angka = (function(id1){
    $('#'+ id1).bind('keypress', function(e) {
        return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
    });
});

var isNumberKey = (function(sender, evt) { 
    var txt = sender.value; 
    var dotcontainer = txt.split('.'); 
    var charCode = (evt.which) ? evt.which : event.keyCode; 
    if (!(dotcontainer.length == 1 && charCode == 46) && charCode > 31 && (charCode < 48 || charCode > 57)) 
        return false;

    return true; 
});

var mathDecimal2 = (function(source) { 
    var txtBox = document.getElementById(source); 
    var txt = txtBox.value; 
    if (!isNaN(txt) && isFinite(txt) && txt.length != 0) { 
       var rounded = Math.round(txt * 100) / 100; 
       txtBox.value = rounded.toFixed(2); 
    } 
});

var formatuang = (function(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
});

function pop_ast(id,jum) {
    $('[name=jumlah]').attr('max',jum);
    $('[name=id]').val(id);
    $('#modal_ast').modal('show');
}

function serialForm(frm){
    var str = $(frm).serialize();

    $(':input',frm).each(function() {
        var tag = this.tagName.toLowerCase();
        
        if (tag == 'select'){
            if(($(this).val()==null)||($(this).val()=='')){
                str = str+'&'+this.name+'=0';
            }
        }

        if ($(this).attr('alt') == 'datetimepicker'){
            if (this.value==''){
                str = str+'&'+this.name+'=1901-12-30 00:00'; 
            } else {
                var spl1 = this.value.split(' ');
                var spl2 = spl1[0].split('-');
                str = str+'&'+this.name+'='+spl2[2]+'-'+spl2[1]+'-'+spl2[0]+' '+spl1[1];
            }
        }

        if ($(this).attr('alt') == 'number'){
            if(($(this).val()==null)||($(this).val()=='')){
                str = str+'&'+this.name+'=0'; 
            } else {
                str = str+'&'+this.name+'='+this.value;       
            }
        }
         
        if ($(this).attr('alt') == 'datepicker'){
            if (this.value==''){
                str = str+'&'+this.name+'=1901-12-30'; 
            } else {
                var spl = this.value.split('-');
                str = str+'&'+this.name+'='+spl[2]+'-'+spl[1]+'-'+spl[0]; 
            }
        }

        if ($(this).attr('alt') == 'timepicker'){
            if (this.value==''){
                str = str+'&'+this.name+'=00:00:00'; 
            } else {
                /*str = str+'&'+this.name+'='+this.value+':00'; */
                str = str+'&'+this.name+'='+this.value; 
            }
        }

        if($(this).data('inputmask')){
            if($(this).attr('alt')=='date'){
                if (this.value==''){
                    str = str+'&'+this.name+'=1901-12-30'; 
                } else {
                    var spl = this.value.split('-');
                    str = str+'&'+this.name+'='+spl[2]+'-'+spl[1]+'-'+spl[0]; 
                }
            } else if($(this).attr('alt')=='hp'){
                str = str+'&'+this.name+'='+$.trim(encodeURIComponent(this.value.replace(/_/g,'')));
            }
        }

        if($(this).data('filestyle')){
            if (this.value==''){
                str = str+'&'+this.name+'=blank.png'; 
            } else {
                str = str+'&'+this.name+'='+this.value;       
            }
        };
    });

    return str.concat(
        $(frm+' input[type=checkbox]:not(:checked)').map(function() {     
            return '&'+this.name+'=0';
        }).toArray().join('')
    );    
}

function clearForm(frm){
    $(':input', frm).each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase(); 
        if (type == 'text'){
            this.value = "";
            if($(this).data('timepicker')){                
              $(this).timepicker('setTime', '');
            }
        } else if (type == 'password' || tag == 'textarea')
            this.value = "";
        else if (type == 'checkbox'){
            $(this).attr('checked',false);
            $(this).parent().removeClass("checked");
        } else if (type == 'radio')
            this.checked = false;
        else if (type== 'file'){
            $(this).val("");
            $("#dvPreview").empty();
        } else if (tag == 'select')
            $(this).val(0).trigger("change");
    });
}

function toast(label, msg){
    Command: toastr[label](msg)

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
}

function ssdatatable(id, url, col, order){
	$(id).dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries found",
            "infoFiltered": "(filtered1 from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries",
            "search": "Search:",
            "zeroRecords": "No matching records found"
        },

        // Or you can use remote translation file
        //"language": {
        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //},

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

        processing: true,
        serverSide: true,
        ajax: url,
        columns: col,
        "lengthMenu": [
            // [5, 15, 20, -1],
            // [5, 15, 20, "All"] // change per page values here
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        // set the initial value
        "pageLength": 10,            
        "pagingType": "full_numbers",
        "language": {
            "search": "search: ",
            "lengthMenu": "  _MENU_ records",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "order": order // set first column as a default sort by asc
    });
}

function piechart(id, url, value, title) {
    var dtProvider = [];
    $.ajax({
        url: url,
        type: 'POST',
        data: {'_token': Settings.token},
        dataType: 'json',
        success: function (result) {
            var chart = AmCharts.makeChart(id, {
                "type": "pie",
                "theme": "light",

                "fontFamily": 'Open Sans',
                
                "color":    '#888',

                "dataProvider": result.data,
                "valueField": "total",
                "titleField": "nama",
                "exportConfig": {
                    menuItems: [{
                        icon: Metronic.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                        format: 'png'
                    }]
                }
            });

            $('#'+id).closest('.portlet').find('.fullscreen').click(function() {
                chart.invalidateSize();
            });
        }
    });
}

var loadselect2 = (function(id1,p1,url1){
    $('#'+ id1).select2({        
        placeholder: p1,
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: url1,
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                var myResults = [];
                $.each(data, function (index, item) {
                    myResults.push({
                        'id': item.noid,
                        'text': item.nama,
                        'kode': item.kode
                    });
                });
                return {
                    results: myResults,
                };
            }          
        }
    });
});

var loadselect3 = (function(id1,p1,url1){
    $('#'+ id1).select2({        
        placeholder: p1,
        allowClear: true,
        ajax: {
            url: url1,
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                var myResults = [];
                $.each(data, function (index, item) {
                    myResults.push({
                        'id': item.noid,
                        'text': item.nama,
                        'kode': item.kode
                    });
                });
                return {
                    results: myResults,
                };
            }          
        }
    });
});

var loadselect4 = (function(id1,p1,url1,filter1,filterp1){
    $('#'+ id1).select2({        
        placeholder: p1,
        allowClear: true, 
        minimumInputLength: 2,       
        ajax: {
            url: url1,
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                var myResults = [];
                $.each(data, function (index, item) {
                    myResults.push({
                        'id': item.noid,
                        'text': item.nama,
                        'kode': item.kode
                    });
                });
                return {
                    results: myResults,
                };
            }          
        }
    }).on("change", function(e) {  
        if($('#'+id1).val()!=null){         
            loadselect3('id'+filter1.toLowerCase(),'Cari '+filterp1,Settings.base_url+'index.php/master/combo_data'+filter1.toLowerCase()+'filter/'+$('#'+id1).val());                 
        }
    });

    $("#id"+filter1.toLowerCase()).select2({
        placeholder:'Cari '+filterp1,
        allowClear: true
    });

    $("#"+id1).on("select2:selecting", function(e) {        
        $("#id"+filter1.toLowerCase()).select2('val',null);
    });

    $("#"+id1).on("select2:unselecting", function(e) {        
        $("#id"+filter1.toLowerCase()).select2('val',null);
    });
});

var buatform = (function(urlform,idform,dv,idkat,formname){
    $(dv).empty();
    if (idkat=="1"){
        $(dv).append("<form id="+formname+" name="+formname+" action='#'> </form>"); 
        dv = '#'+formname;
    }

    $.getJSON(urlform,{"noid":idform},function (json){          
        $.each($.parseJSON(json.jsonform),function(indek,nilai){
            switch(nilai.tag) {  
                case "hidden" :   
                    $(dv).append("<input type='hidden' id="+nilai.id+" name="+nilai.name+">");
                break;
                case "input": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "</div>");
                    break;   
                case "inputbtn": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <div class='input-group input-group-sm'> "+
                    "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "   <span class='input-group-btn'> "+
                    "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
                    "   </span> "+
                    " </div> "+
                    "</div>");
                    break;
                case "inputbtn2": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <div class='input-group input-group-sm'> "+
                    "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "   <span class='input-group-btn'> "+
                    "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
                    "     <button class='btn btn-danger btn-flat' type='button' onclick='get"+nilai.id+"();'>GET</button> "+
                    "   </span> "+
                    " </div> "+
                    "</div>");
                break;  
                case "number": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "</div>");
                    angka(nilai.id);    
                    break;
                case "numberbtn": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <div class='input-group input-group-sm'> "+
                    "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "   <span class='input-group-btn'> "+
                    "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
                    "   </span> "+
                    " </div> "+
                    "</div>");
                    angka(nilai.id);    
                    break;
                case "numberbtn2": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <div class='input-group input-group-sm'> "+
                    "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "   <span class='input-group-btn'> "+
                    "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
                    "     <button class='btn btn-danger btn-flat' type='button' onclick='get"+nilai.id+"();'>GET</button> "+
                    "   </span> "+
                    " </div> "+
                    "</div>");
                    angka(nilai.id);    
                    break;
                case "email": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group'> "+
                    "     <div class='input-group-addon'> "+
                    "      <i class='fa fa-envelope'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
                    "  </div> "+
                    "</div>");
                    break; 
                case "checkbox":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label> "+
                    "   <input type='checkbox' id="+nilai.id+" name="+nilai.name+" value='1'> "+nilai.label +
                    " </label> "+
                    "</div> ");
                    break;
                case "select1":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>");        
                    comboboxku(nilai.id,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),'noid','nama');
                    $("#"+nilai.id).select2({
                    placeholder: nilai.pholder,
                    allowClear: true,
                    minimumInputLength: 2
                    });   
                    break;
                case "select2":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control ' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>");        
                    loadselect2(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''));
                    break;
                case "select3":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control' style='width:100%;' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>");        
                    loadselect3(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''));
                    break;
                case "select4":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>"); 
                    loadselect4(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),nilai.filter,nilai.filterpholder);       
                    break;
                case "select5":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>");        
                    comboboxku(nilai.id,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),'noid','nama');
                    $("#"+nilai.id).select2({
                        placeholder: nilai.pholder,
                        allowClear: true,
                        minimumInputLength: 2
                    }).on("change", function(e) {  
                        if($('#'+nilai.id).val()!=null){          
                          comboboxku('id'+nilai.filter,Settings.base_url+'index.php/master/combo_data'+nilai.filter+'filter/'+$('#'+nilai.id).val(),'noid','nama');
                        }
                    });
                    break;
                case "select6":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+                
                    " <select class='form-control ' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
                    " </select> "+
                    "</div>");        
                    loadselect2(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/'+nilai.combo);
                    break;
                case "radio":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"' style='position:relative;margin-top:-10px'> ");
                    $.each((nilai.data),function(key,val){
                        $(dv).append("\u00a0"+"\u00a0"+"\u00a0"+"\u00a0"+"\u00a0"+
                        "<input type='radio' id="+val.id+" name="+val.name+" value="+val.val+" "+val.chk+">"+val.label);
                    });
                        $(dv).append("<br /><br /></div>");
                    break;
                case "password": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <input type='password' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"' /> "+
                    "</div>");
                    break; 
                case "textarea": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <textarea class='form-control' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"'></textarea> "+
                    "</div>");
                    break; 
                /*
                case "datepicker":
                $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                " <label for="+nilai.name+">"+nilai.label+
                "   <div class='input-group'> "+
                "     <div class='input-group-addon'> "+
                "       <i class='fa fa-calendar'></i> "+
                "     </div> "+
                " </label> "+
                "     <input type='text' class='form-control input-sm ' id="+nilai.id+" name="+nilai.name+" style='font-weight: normal !important;'/> "+
                "   </div> "+
                " </div>");

                $('#'+nilai.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight:true
                });
                $('#'+nilai.id).datepicker('update', new Date());
                */
                case "datepicker":          
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group date' id="+nilai.id+"> "+
                    "     <div class='input-group-addon'> "+
                    "       <i class='fa fa-calendar'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='datepicker' id="+nilai.id+" name="+nilai.name+" /> "+
                    "   </div> "+
                    " </div>");  
                    var dateNow = new Date();
                    $('#'+nilai.id).datetimepicker({
                        format: 'DD-MM-YYYY',            
                        defaultDate:dateNow
                    });
                    break;
                case "datetimepicker":          
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group date' id="+nilai.id+"> "+
                    "     <div class='input-group-addon'> "+
                    "       <i class='fa fa-calendar'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='datetimepicker' id="+nilai.id+" name="+nilai.name+" /> "+
                    "   </div> "+
                    " </div>");  
                    var dateNow = new Date();
                    $('#'+nilai.id).datetimepicker({
                        format: 'DD-MM-YYYY HH:mm',            
                        showClose: true,
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down"
                        },
                        defaultDate:dateNow
                    });
                    break;
                /*
                case "timepicker":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+
                    "   <div class='input-group bootstrap-timepicker'> "+
                    "     <div class='input-group-addon'> "+
                    "       <i class='glyphicon glyphicon-time'></i> "+
                    "     </div> "+
                    " </label> "+
                    "       <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" /> "+
                    "   </div> "+
                    "</div>");
                    $('#'+nilai.id).timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                    });
                    break;
                */
                case "timepicker":          
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group date' id="+nilai.id+"> "+
                    "     <div class='input-group-addon'> "+
                    "       <i class='glyphicon glyphicon-time'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='timepicker' id="+nilai.id+" name="+nilai.name+" /> "+
                    "   </div> "+
                    " </div>");  
                    var dateNow = new Date();
                    $('#'+nilai.id).datetimepicker({
                        format: 'HH:mm',
                        toolbarPlacement: 'bottom',            
                        showClose: true,
                        defaultDate:dateNow
                    });
                    break;
                case "touchspin":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" /> "+
                    "</div>");
                    angka(nilai.id);
                    $('#'+nilai.id).TouchSpin({
                        verticalbuttons: true,
                        min: 1
                    });
                    break;
                case "decimal":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"' OnKeyPress='return isNumberKey(this, event);' onchange='mathDecimal2(this.id);' /> "+
                    "</div>");
                    break;      
                case "phonemask": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group'> "+
                    "     <div class='input-group-addon'> "+
                    "        <i class='fa fa-phone'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='phone' id="+nilai.id+" name="+nilai.name+" data-inputmask='\"mask\": \"(999)-9999999\"' data-mask /> "+
                    "   </div> "+
                    "</div>");
                    break;  
                case "hpmask": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group'> "+
                    "     <div class='input-group-addon'> "+
                    "        <i class='fa fa-phone'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='hp' id="+nilai.id+" name="+nilai.name+" data-inputmask='\"mask\": \"+6299999999999\"' data-mask /> "+
                    "   </div> "+
                    "</div>");
                    break;  
                case "datemask": 
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                    "   <div class='input-group'> "+
                    "     <div class='input-group-addon'> "+
                    "        <i class='fa fa-calendar'></i> "+
                    "     </div> "+
                    "     <input type='text' class='form-control input-sm' alt='date' id="+nilai.id+" name="+nilai.name+" data-inputmask=\"'alias': 'dd-mm-yyyy'\" data-mask /> "+
                    "   </div> "+
                    "</div>");
                    break;    
                case "file":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <label for="+nilai.name+">"+nilai.label+"</label> "+
                      " <div id='dvPreview'> "+
                      " </div> "+
                    " <input type='file' class='form-control input-sm no-border' id="+nilai.id+" name="+nilai.name+" /> "+
                    "</div>");
                    $(":file").filestyle({iconName: "glyphicon-inbox",buttonBefore: true});
                    $("#"+nilai.id).change(function () {
                    if (typeof (FileReader) != "undefined") {
                        var dvPreview = $("#dvPreview");
                        dvPreview.html("");
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                        $($(this)[0].files).each(function () {
                            var file = $(this);
                            if (regex.test(file[0].name.toLowerCase())) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var img = $("<img />");
                                    img.attr("style", "height:120px;width: 120px");
                                    img.attr("src", e.target.result);
                                    dvPreview.append(img);
                                    dvPreview.append("<br/><br/>");
                                }
                                reader.readAsDataURL(file[0]);
                            } else {
                                console.log(file[0].name + " is not a valid image file.");
                                dvPreview.html("");
                                return false;
                            }
                        });
                    } else {
                            console.log("This browser does not support HTML5 FileReader.");
                        }
                    });
                    break;
                case "button1":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <button type='button' id="+nilai.id+" name="+nilai.name+" class='btn btn-primary btn-block'  onclick="+nilai.click+"><i class='fa fa-sign-in'></i>&nbsp;Simpan</button> "+
                    " </div>");
                    break;
                case "button2":
                    $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
                    " <button type='button' class='btn btn-danger btn-block'  onclick="+nilai.click+"><i class='fa fa-times'></i>&nbsp;Batal</button> "+
                    " </div>");
                    break;
            }       
        });
    });
});

var serialform = (function(frm){
  var str = $(frm).serialize();

  $(':input',frm).each(function() {
    var tag = this.tagName.toLowerCase(); 

    if (tag == 'select')
      if(($(this).val()==null)||($(this).val()=='')){
        str = str+'&'+this.name+'=0';
      }

    if ($(this).attr('alt') == 'datetimepicker'){
      if (this.value==''){
        str = str+'&'+this.name+'=1901-12-30 00:00'; 
      }else{
        var spl1 = this.value.split(' ');
        var spl2 = spl1[0].split('-');
        str = str+'&'+this.name+'='+spl2[2]+'-'+spl2[1]+'-'+spl2[0]+' '+spl1[1];
      }
    }

    if ($(this).attr('alt') == 'number'){
      if(($(this).val()==null)||($(this).val()=='')){
        str = str+'&'+this.name+'=0'; 
      }else{
        str = str+'&'+this.name+'='+this.value;       
      }
    }
     
    if ($(this).attr('alt') == 'datepicker'){
      if (this.value==''){
        str = str+'&'+this.name+'=1901-12-30'; 
      }else{
        var spl = this.value.split('-');
        str = str+'&'+this.name+'='+spl[2]+'-'+spl[1]+'-'+spl[0]; 
      }
    }

    if ($(this).attr('alt') == 'timepicker'){
      if (this.value==''){
        str = str+'&'+this.name+'=00:00:00'; 
      }else{
        /*str = str+'&'+this.name+'='+this.value+':00'; */
        str = str+'&'+this.name+'='+this.value; 
      }
    }

    if($(this).data('inputmask')){
        if($(this).attr('alt')=='date'){
          if (this.value==''){
            str = str+'&'+this.name+'=1901-12-30'; 
          }else{
            var spl = this.value.split('-');
            str = str+'&'+this.name+'='+spl[2]+'-'+spl[1]+'-'+spl[0]; 
          }
        }
        else if($(this).attr('alt')=='hp'){
           str = str+'&'+this.name+'='+$.trim(encodeURIComponent(this.value.replace(/_/g,'')));
        }
    }

    if($(this).data('filestyle')){
      if (this.value==''){
        str = str+'&'+this.name+'=blank.png'; 
      }else{
        str = str+'&'+this.name+'='+this.value;       
      }
    };
  });

  return str.concat(
    $(frm+' input[type=checkbox]:not(:checked)').map(function() {     
       return '&'+this.name+'=0';
    }).toArray().join('')
  );    
});

var bersihform = (function(frm){
  $(':input', frm).each(function() {
      var type = this.type;
      var tag = this.tagName.toLowerCase(); 
      if (type == 'text'){
        this.value = "";
        if($(this).data('timepicker')){                
          $(this).timepicker('setTime', '');
        } 
      }
      else if (type == 'password' || tag == 'textarea')
        this.value = "";
      else if (type == 'checkbox')
        $(this).iCheck('uncheck');
      else if (type == 'radio')
        this.checked = false;
      else if (type== 'file'){
          $(this).val("");
          $("#dvPreview").empty();
      }
      else if (tag == 'select')
        $(this).val(null).trigger("change");
    });
});

var ambilform = (function(frm, data) {   
    $.each(data, function(key, value){  
      var $c  = $('[name='+key+']', frm);   
      if($c.is('select')){                
        getselect2ajax($c.attr('id'),value,Settings.base_url+'index.php/master/combo_data'+$c.attr('id').replace('id','')+'ambil/'+value);
      }
      else if($c.is('textarea')){   
        $c.val(value);              
      }
      else{
        switch($c.attr("type"))  
        {  
            case "text" :   
              if($c.attr('alt')=='datepicker'){
               if (value=='1901-12-30'){
                  $c.val=''; 
                }else{   
                  var spl = value.split('-');
                  $c.val(spl[2]+'-'+spl[1]+'-'+spl[0]);
                }  
              } 
              else if($c.attr('alt')=='datetimepicker'){
                if (value=='1901-12-30 00:00:00'){
                  $c.val=''; 
                }else{
                  var spl1 = value.split(' ');
                  var spl2 = spl1[0].split('-');
                  $c.val(spl2[2]+'-'+spl2[1]+'-'+spl2[0]+' '+spl1[1]);
                }  
              }              
              else if($c.attr('alt')=='timepicker'){             
                $c.val(value);
              } 
              else if($c.data("inputmask")){
                  if($c.attr('alt')=='date'){
                    if (value=='1901-12-30'){
                      $c.val=''; 
                    }
                    else if(value==null){
                      $c.val='';
                    }
                    else{   
                      var spl = value.split('-');
                      $c.val(spl[2]+'-'+spl[1]+'-'+spl[0]);              
                    }
                  }
                  else{
                    $c.val(value);   
                  }
              }
              else{
                $c.val(value);   
              }
              break;
            case "hidden": 
                $c.val(value);   
                break;   
            case "radio" : case "checkbox":   
                $c.each(function(){
                   if($(this).attr('value') == value) {  $(this).iCheck('check'); }else {$(this).iCheck('uncheck');}});   
                break;      
                  case "file":
                        var dvPreview = $("#dvPreview");
                        dvPreview.html("");
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                if (regex.$(this).val()) {
                    var img = $("<img />");
                    img.attr("style", "height:120px;width: 120px");
                    img.attr("src", e.target.result);
                    dvPreview.append(img);
                               dvPreview.append("<br/><br/>");
                } 
                        break;
        } 
      } 

    });
  });

  var buattbl1 = (function(urlform,idform,st){
    $(st).empty();
    $.getJSON(urlform,{"noid":idform},function (json){          

      $.each($.parseJSON(json.jsonform),function(indek,nilai){
        switch(nilai.idkat) {
          case "1":

          break;

          default:
          break;
        }

      })
    })
  });


  var buatform = (function(urlform,idform,dv,idkat,formname){
    $(dv).empty();
    if (idkat=="1"){
      $(dv).append("<form id="+formname+" name="+formname+" action='#'> </form>"); 

      dv = '#'+formname;
    }
    $.getJSON(urlform,{"noid":idform},function (json){          

      $.each($.parseJSON(json.jsonform),function(indek,nilai){
        switch(nilai.tag)  
        {  
          case "hidden" :   
          $(dv).append("<input type='hidden' id="+nilai.id+" name="+nilai.name+">");
          break;
          case "input": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "</div>");
          break;   
          case "inputbtn": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <div class='input-group input-group-sm'> "+
          "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "   <span class='input-group-btn'> "+
          "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
          "   </span> "+
          " </div> "+
          "</div>");
          break;  
          case "inputbtn2": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <div class='input-group input-group-sm'> "+
          "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "   <span class='input-group-btn'> "+
          "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
          "     <button class='btn btn-danger btn-flat' type='button' onclick='get"+nilai.id+"();'>GET</button> "+
          "   </span> "+
          " </div> "+
          "</div>");
          break;  
          case "number": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "</div>");
          angka(nilai.id);    
          break;
          case "numberbtn": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <div class='input-group input-group-sm'> "+
          "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "   <span class='input-group-btn'> "+
          "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
          "   </span> "+
          " </div> "+
          "</div>");
          angka(nilai.id);    
          break;
          case "numberbtn2": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <div class='input-group input-group-sm'> "+
          "   <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "   <span class='input-group-btn'> "+
          "     <button class='btn btn-info btn-flat' type='button' onclick='cek"+nilai.id+"();'>CEK</button> "+
           "     <button class='btn btn-danger btn-flat' type='button' onclick='get"+nilai.id+"();'>GET</button> "+
          "   </span> "+
          " </div> "+
          "</div>");
          angka(nilai.id);    
          break;
          case "email": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group'> "+
          "     <div class='input-group-addon'> "+
          "      <i class='fa fa-envelope'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" maxlength="+nilai.maxlength+" placeholder='"+nilai.pholder+"' /> "+
          "  </div> "+
          "</div>");
          break; 
          case "checkbox":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label> "+
          "   <input type='checkbox' id="+nilai.id+" name="+nilai.name+" value='1'> "+nilai.label +
          " </label> "+
          "</div> ");
          break;
          case "select1":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>");        
          comboboxku(nilai.id,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),'noid','nama');
          $("#"+nilai.id).select2({
            placeholder: nilai.pholder,
            allowClear: true,
            minimumInputLength: 2
          });   
          break;
          case "select2":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control ' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>");        
          loadselect2(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''));
          break;
          case "select3":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control' style='width:100%;' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>");        
          loadselect3(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''));
          break;
          case "select4":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>"); 
          loadselect4(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),nilai.filter,nilai.filterpholder);       
          break;
          case "select5":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>");        
          comboboxku(nilai.id,Settings.base_url+'index.php/master/combo_data'+nilai.name.replace('id',''),'noid','nama');
          $("#"+nilai.id).select2({
            placeholder: nilai.pholder,
            allowClear: true,
            minimumInputLength: 2
          }).on("change", function(e) {  
            if($('#'+nilai.id).val()!=null){          
              comboboxku('id'+nilai.filter,Settings.base_url+'index.php/master/combo_data'+nilai.filter+'filter/'+$('#'+nilai.id).val(),'noid','nama');
            }
          });
          break;
          case "select6":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+                
          " <select class='form-control ' style='width:100%' id="+nilai.id+" name="+nilai.name+"> "+       
          " </select> "+
          "</div>");        
          loadselect2(nilai.id,nilai.pholder,Settings.base_url+'index.php/master/'+nilai.combo);
          break;
          case "radio":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"' style='position:relative;margin-top:-10px'> ");
            $.each((nilai.data),function(key,val){
              $(dv).append("\u00a0"+"\u00a0"+"\u00a0"+"\u00a0"+"\u00a0"+
                "<input type='radio' id="+val.id+" name="+val.name+" value="+val.val+" "+val.chk+">"+val.label);
            });
              $(dv).append("<br /><br /></div>");
          break;
          case "password": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <input type='password' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"' /> "+
          "</div>");
          break; 
          case "textarea": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <textarea class='form-control' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"'></textarea> "+
          "</div>");
          break; 
          /*
          case "datepicker":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+
          "   <div class='input-group'> "+
          "     <div class='input-group-addon'> "+
          "       <i class='fa fa-calendar'></i> "+
          "     </div> "+
          " </label> "+
          "     <input type='text' class='form-control input-sm ' id="+nilai.id+" name="+nilai.name+" style='font-weight: normal !important;'/> "+
          "   </div> "+
          " </div>");
          
          $('#'+nilai.id).datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight:true
          });
          $('#'+nilai.id).datepicker('update', new Date());
          */
         case "datepicker":          
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group date' id="+nilai.id+"> "+
          "     <div class='input-group-addon'> "+
          "       <i class='fa fa-calendar'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='datepicker' id="+nilai.id+" name="+nilai.name+" /> "+
          "   </div> "+
          " </div>");  
          var dateNow = new Date();
          $('#'+nilai.id).datetimepicker({
            format: 'DD-MM-YYYY',            
            defaultDate:dateNow
          });
          break;
          case "datetimepicker":          
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group date' id="+nilai.id+"> "+
          "     <div class='input-group-addon'> "+
          "       <i class='fa fa-calendar'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='datetimepicker' id="+nilai.id+" name="+nilai.name+" /> "+
          "   </div> "+
          " </div>");  
          var dateNow = new Date();
          $('#'+nilai.id).datetimepicker({
            format: 'DD-MM-YYYY HH:mm',            
            showClose: true,
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
            },
            defaultDate:dateNow
          });
          break;
          /*
          case "timepicker":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+
          "   <div class='input-group bootstrap-timepicker'> "+
          "     <div class='input-group-addon'> "+
          "       <i class='glyphicon glyphicon-time'></i> "+
          "     </div> "+
          " </label> "+
          "       <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" /> "+
          "   </div> "+
          "</div>");
          $('#'+nilai.id).timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
          });
          break;
          */
         case "timepicker":          
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group date' id="+nilai.id+"> "+
          "     <div class='input-group-addon'> "+
          "       <i class='glyphicon glyphicon-time'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='timepicker' id="+nilai.id+" name="+nilai.name+" /> "+
          "   </div> "+
          " </div>");  
          var dateNow = new Date();
          $('#'+nilai.id).datetimepicker({
            format: 'HH:mm',
            toolbarPlacement: 'bottom',            
            showClose: true,
            defaultDate:dateNow
          });
          break;
          case "touchspin":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" /> "+
          "</div>");
          angka(nilai.id);
          $('#'+nilai.id).TouchSpin({
            verticalbuttons: true,
            min: 1
          });
          break;
          case "decimal":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          " <input type='text' class='form-control input-sm' id="+nilai.id+" name="+nilai.name+" placeholder='"+nilai.pholder+"' OnKeyPress='return isNumberKey(this, event);' onchange='mathDecimal2(this.id);' /> "+
          "</div>");
          break;        
          case "phonemask": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group'> "+
          "     <div class='input-group-addon'> "+
          "        <i class='fa fa-phone'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='phone' id="+nilai.id+" name="+nilai.name+" data-inputmask='\"mask\": \"(999)-9999999\"' data-mask /> "+
          "   </div> "+
          "</div>");
          break;  
          case "hpmask": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group'> "+
          "     <div class='input-group-addon'> "+
          "        <i class='fa fa-phone'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='hp' id="+nilai.id+" name="+nilai.name+" data-inputmask='\"mask\": \"+6299999999999\"' data-mask /> "+
          "   </div> "+
          "</div>");
          break;  
          case "datemask": 
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
          "   <div class='input-group'> "+
          "     <div class='input-group-addon'> "+
          "        <i class='fa fa-calendar'></i> "+
          "     </div> "+
          "     <input type='text' class='form-control input-sm' alt='date' id="+nilai.id+" name="+nilai.name+" data-inputmask=\"'alias': 'dd-mm-yyyy'\" data-mask /> "+
          "   </div> "+
          "</div>");
          break;    
          case "file":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <label for="+nilai.name+">"+nilai.label+"</label> "+
              " <div id='dvPreview'> "+
              " </div> "+
          " <input type='file' class='form-control input-sm no-border' id="+nilai.id+" name="+nilai.name+" /> "+
          "</div>");
          $(":file").filestyle({iconName: "glyphicon-inbox",buttonBefore: true});
          $("#"+nilai.id).change(function () {
            if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#dvPreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "height:120px;width: 120px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                                    dvPreview.append("<br/><br/>");
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    console.log(file[0].name + " is not a valid image file.");
                    dvPreview.html("");
                    return false;
                }
            });
            } else {
                    console.log("This browser does not support HTML5 FileReader.");
                }
          });
          break;
          case "button1":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <button type='button' id="+nilai.id+" name="+nilai.name+" class='btn btn-primary btn-block'  onclick="+nilai.click+"><i class='fa fa-sign-in'></i>&nbsp;Simpan</button> "+
          " </div>");
          break;
          case "button2":
          $(dv).append("<div class='form-group col-xs-12 col-sm-"+nilai.cols+"'> "+
          " <button type='button' class='btn btn-danger btn-block'  onclick="+nilai.click+"><i class='fa fa-times'></i>&nbsp;Batal</button> "+
          " </div>");
          break;
        }       
      });
    });

  });
  
  var dgdatatables = (function(dg,url,cols,tnama,t){
    $(dg).dataTable({
        "fnDrawCallback": function ( oSettings ) {
            if ( oSettings.bSorted || oSettings.bFiltered )
            {
                for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
            }
        },        
        "sAjaxSource": url,
        "sAjaxDataProp": "aData",
        "iDisplayLength": 10,
        "aoColumns":cols,
        "oLanguage": {
          "sLengthMenu": "Tampilkan _MENU_ data per halaman",
          "sSearch": "Pencarian: ", 
          "sZeroRecords": "Data Kosong",
          "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
          "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
          "sInfoFiltered": "(di filter dari _MAX_ total data)"
        },  
        "aLengthMenu": [[10, 25, 50, 100 ], [10, 25, 50, 100]],
        "bLengthChange" : true,
        "bAutoWidth": false,
        "sDom": '<"H"<"'+tnama+'">lfr>t<"F"pi>'
    });
    $("div."+tnama).html(t);
  });
  
  var dgstandart = (function(dg,col,tnama,t){
    $(dg).dataTable({
        "fnDrawCallback": function ( oSettings ) {
            if ( oSettings.bSorted || oSettings.bFiltered )
            {
                for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
            }
        },                
        "sAjaxDataProp": "aData",
        "iDisplayLength": 10,
        "aoColumns":col,
        "oLanguage": {
          "sSearch": "Pencarian: ", 
          "sZeroRecords": "Data Kosong",
          "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
          "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
          "sInfoFiltered": "(di filter dari _MAX_ total data)"
        }, 
        "aLengthMenu": [[5, 10, 50, 100 , -1], [5, 10, 50, 100]],
        "bLengthChange" : false,
        "bAutoWidth": false,
        "sDom": '<"H"<"'+tnama+'">lfr>t<"F"pi>'
    });
    $("div."+tnama).html(t);
  });
  
  var JudulText = (function(str){
    if (str.length<=3){
      return str.toUpperCase();
    }
    else{
      return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
      }
  });

  var convertDate = (function(age) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(age);
    return getAge([pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/'));
  });

 var nextChar = (function (c) {
    return String.fromCharCode(c.charCodeAt(0) + 1);
 });

 var buildform = (function (id,name,value) {
    /*1 text
     2 textarea
     3 numeric
     4 decimal
     5 datetime
     6 date
     7 time
     8 combobox
     9 checkbox
     10 radio
     11 numeric 2 kolom
     */
    var x;
    switch (id){
        case "1":
            return "<input type='text' id='"+name+"'  name='"+name+"' class='form-control input-sm'>";
            break;
        case "2":
            return "<textarea id="+name+" name="+name+" class='form-control input-sm'></textarea> ";
            break;
        case "3":
            x = "<input type='text' id='"+name+"'  name='"+name+"' alt='number' class='form-control input-sm' value='0'>";
            setTimeout(function(){
                angka(name);
            }, 1000);
            return x;
            break;
        case "4":
            return "<input type='text' class='form-control input-sm' alt='decimal' OnKeyPress='return isNumberKey(this, event);' onchange='mathDecimal2(this.id);' id='"+name+"'  name='"+name+"' class='form-control input-sm' value='0'>";
            break;
        case "5":
            x =  "<div class='input-group date' id="+name+"> "+
            "     <div class='input-group-addon'> "+
            "       <i class='fa fa-calendar'></i> "+
            "     </div> "+
            "     <input type='text' class='form-control input-sm' alt='datetimepicker' id="+name+" name="+name+" /> "+
            "   </div> "+
            " </div>";
            var dateNow = new Date();
            setTimeout(function(){
                $('#'+name).datetimepicker({
                    format: 'DD-MM-YYYY HH:mm',
                    showClose: true,
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },
                    defaultDate:dateNow
                });
            }, 1000);
            return x;
            break;
        case "6":
            x =  "<div class='input-group date' id="+name+"> "+
            "     <div class='input-group-addon'> "+
            "       <i class='fa fa-calendar'></i> "+
            "     </div> "+
            "     <input type='text' class='form-control input-sm' alt='datepicker' id="+name+" name="+name+" /> "+
            "   </div> "+
            " </div>";
            var dateNow = new Date();
            setTimeout(function(){
                $('#'+name).datetimepicker({
                    format: 'DD-MM-YYYY',
                    defaultDate:dateNow
                });
            }, 1000);
            return x;
            break;
        case "7":
            x =  "<div class='input-group date' id="+name+"> "+
            "     <div class='input-group-addon'> "+
            "       <i class='glyphicon glyphicon-time'></i> "+
            "     </div> "+
            "     <input type='text' class='form-control input-sm' alt='timepicker' id="+name+" name="+name+" /> "+
            "   </div> "+
            " </div>";
            var dateNow = new Date();
            setTimeout(function(){
                $('#'+name).datetimepicker({
                    format: 'HH:mm',
                    toolbarPlacement: 'bottom',
                    showClose: true,
                    defaultDate:dateNow
                });
            }, 1000);
            return x;
            break;
        case "8":
            var a = "<select class='form-control input-sm' id="+name+" name="+name+" > ";
            var b = [];
            $.each($.parseJSON(value),function(i,v){
                b.push("<option value="+v.key+">"+v.val+"</option> ");
            });
            var c  = "</select> ";
            var html = [a,b,c].join('');
            return html;
            break;
        case "9":
            var x = [];
            $.each($.parseJSON(value),function(i,v) {
                if(v.key=='1') {
                    x.push("<input type='checkbox' id=" + name + " name=" + name + " value='1' class='form-control input-sm' checked>\u00a0\u00a0 " + v.val);
                }
            });
            return x.join('');
            break;
        case "10":
            var b = [];
            $.each($.parseJSON(value),function(i,v){
                b.push("<input type='radio' id="+name+" name="+name+" value="+v.key+" class='form-control input-sm'>\u00a0\u00a0"+v.val+"\u00a0\u00a0");
            });
            return b.join('');
            break;
        default :
            return "<input type='text' id='"+name+"'  name='"+name+"' class='form-control input-sm'>";
            break;
    }
 });

 var getform = (function(frm, data) {
    $.each(data, function(key, value){
        var $c  = $('[name='+key+']', frm);
        if($c.is('select')){
            $c.val(value);
        }
        else if($c.is('textarea')){
            $c.val(value);
        }
        else{
            switch($c.attr("type"))
            {
                case "text" :
                    if($c.attr('alt')=='datepicker'){
                        if (value=='1901-12-30'){
                            $c.val='';
                        }else{
                            var spl = value.split('-');
                            $c.val(spl[2]+'-'+spl[1]+'-'+spl[0]);
                        }
                    }else if($c.attr('alt')=='datetimepicker'){
                        if (value=='1901-12-30 00:00:00'){
                            $c.val='';
                        }else{
                            var spl1 = value.split(' ');
                            var spl2 = spl1[0].split('-');
                            $c.val(spl2[2]+'-'+spl2[1]+'-'+spl2[0]+' '+spl1[1]);
                        }
                    }
                    else if($c.attr('alt')=='timepicker'){
                        $c.val(value);
                    }else {
                        $c.val(value);
                    }
                    break;
                case "radio" : case "checkbox":
                $c.each(function(){
                    if($(this).attr('value') == value) {  $(this).iCheck('check'); }else {$(this).iCheck('uncheck');}});
                break;
            }
        }
    });
 });

 var cleanform = (function(frm){
    var dateNow = new Date();
    $(':input', frm).each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        if (type == 'text'){
            if ($(this).attr('alt') == 'number'){
                this.value = "0";
            }
            else if ($(this).attr('alt') == 'decimal'){
                this.value = "0";
            }else if ($(this).attr('alt') == 'datetimepicker'){
                this.value=moment(dateNow).format('DD-MM-YYYY HH:mm');
            }else if ($(this).attr('alt') == 'datepicker'){
                this.value=moment(dateNow).format('DD-MM-YYYY');
            }else if ($(this).attr('alt') == 'timepicker'){
                this.value=moment(dateNow).format('HH:mm');
            }else {
                this.value = "";
            }
        }
        else if(type == 'textarea'){
            this.value = "";
        }
        else if (type == 'checkbox')
            $(this).iCheck('check');
        else if (type == 'radio')
            $('input[type="radio"][value="0"]').iCheck('check');
        else if (tag == 'select')
            $(this).val('0');
    });
 });

  var getAge= (function(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString.substring(6,10),
                       dateString.substring(0,2)-1,                   
                       dateString.substring(3,5)                  
                       );

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
      var monthAge = monthNow - monthDob;
    else {
      yearAge--;
      var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
      var dateAge = dateNow - dateDob;
    else {
      monthAge--;
      var dateAge = 31 + dateNow - dateDob;

      if (monthAge < 0) {
        monthAge = 11;
        yearAge--;
      }
    }

    age = {
        years: yearAge,
        months: monthAge,
        days: dateAge
        };

    yearString = "Y ";
    monthString = "M ";
    dayString = "D";


    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.years + yearString + age.months + monthString+ age.days + dayString;
    else ageString = "NA";

    return ageString;
});

var myAjax = (function($){
    return {
        getAjax: function(params){
            var set = $.extend({
                url:      '',
                spinner:  undefined,
                data:'',
                type: "POST",
                dataType: 'html',
                cache:    false,
                success:  function(){}
            }, params);
 
            $.ajax({
                beforeSend: function(){
                    $(set.spinner).show();
                },
                url: set.url,
                data: set.data,    
                type: set.type,
                dataType: set.dataType,
                success: set.success,
                complete:function(){
                  $(set.spinner).hide();
                }
            });
        }
    };
})(jQuery);