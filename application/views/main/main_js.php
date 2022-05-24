<script src="<?php echo base_url('assets/theme/adm2/js/jquery.min.js'); ?>"></script>
<!-- smart resize event -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.debouncedresize.min.js'); ?>"></script>
<!-- hidden elements width/height -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.actual.min.js'); ?>"></script>
<!-- js cookie plugin -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.cookie.min.js'); ?>"></script>
<!-- main bootstrap js -->
<script src="<?php echo base_url('assets/theme/adm2/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- tooltips -->
<script src="<?php echo base_url('assets/theme/adm2/lib/qtip2/jquery.qtip.min.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/theme/adm2/lib/datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<!-- timepicker -->
<script src="<?php echo base_url('assets/theme/adm2/lib/datepicker/bootstrap-timepicker.min.js'); ?>"></script>
<!-- datatable -->
<script src="<?php echo base_url('assets/theme/adm2/lib/datatables/js/jquery.dataTables.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/datatables-responsive/js/dataTables.responsive.js'); ?>"></script>
<!-- jBreadcrumbs -->
<script src="<?php echo base_url('assets/theme/adm2/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js'); ?>"></script>
<!-- lightbox -->
<script src="<?php echo base_url('assets/theme/adm2/lib/colorbox/jquery.colorbox.min.js'); ?>"></script>
<!-- fix for ios orientation change -->
<script src="<?php echo base_url('assets/theme/adm2/js/ios-orientationchange-fix.js'); ?>"></script>
<!-- scrollbar -->
<script src="<?php echo base_url('assets/theme/adm2/lib/antiscroll/antiscroll.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/antiscroll/jquery-mousewheel.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/datatables/js/jquery.dataTables.js'); ?>"></script>
<!-- to top -->
<script src="<?php echo base_url('assets/theme/adm2/lib/UItoTop/jquery.ui.totop.min.js'); ?>"></script>
<!-- common functions -->
<script src="<?php echo base_url('assets/theme/adm2/js/gebo_common.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js'); ?>"></script>
<!-- touch events for jquery ui-->
<script src="<?php echo base_url('assets/theme/adm2/js/forms/jquery.ui.touch-punch.min.js'); ?>"></script>
<!-- multi-column layout -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.imagesloaded.min.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.wookmark.js'); ?>"></script>
<!-- responsive table -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.mediaTable.min.js'); ?>"></script>
<!-- small charts -->
<script src="<?php echo base_url('assets/theme/adm2/js/jquery.peity.min.js'); ?>"></script>
<!-- calendar -->
<script src="<?php echo base_url('assets/theme/adm2/lib/fullcalendar/fullcalendar.min.js'); ?>"></script>
<!-- sortable/filterable list -->
<script src="<?php echo base_url('assets/theme/adm2/lib/list_js/list.min.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/list_js/plugins/paging/list.paging.min.js'); ?>"></script>
<!-- dashboard functions -->
<script src="<?php echo base_url('assets/theme/adm2/js/gebo_dashboard.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/select2/js/select2.min.js'); ?>"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/toastr/toastr.js'); ?>" type="text/javascript"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/sweetalert/sweetalert.min.js'); ?>" type="text/javascript"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/maskmoney/jquery.maskMoney.min.js'); ?>" type="text/javascript"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/mask/jquery.mask.js'); ?>" type="text/javascript"></script>
<!-- ...  -->
<script src="<?php echo base_url('assets/theme/adm2/lib/mask/jquery.mask.min.js'); ?>" type="text/javascript"></script>


<script src="<?php echo base_url('assets/theme/adm2/lib/moment_js/moment.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/theme/adm2/lib/moment_js/moment.min.js'); ?>" type="text/javascript"></script>

<!-- smoke_js -->
<script src="<?php echo base_url('assets/theme/adm2/lib/smoke/smoke.js'); ?>"></script>





<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")', 1000);

    });
</script>



<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";

    $('.ssw_trigger').remove();

    // Select2
    //$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    //ini untuk datatable menggunakan form-control
    //$.fn.dataTable.ext.classes.sLengthSelect = 'form-control';

    $("#logouts").click(function() {
        window.location = base_url + "main/logout";
    });


    $.ajaxSetup({
        data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    });

    // Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip();

    getcontents('home', '<?php echo $this->session->userdata('sess_token'); ?>');


    function getMCE() {


        //powerpaste advcode tinymcespellchecker a11ychecker mediaembed linkchecker
        tinyMCE.init({
            theme: "modern",
            mode: "specific_textareas",
            editor_selector: "mceEditor",
            plugins: ' print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: ' formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | fontselect',
            image_advtab: true,
            relative_urls: false,
            remove_script_host: false,
            paste_data_images: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [
                base_url + 'assets/editor/tinymce/font_googleapis.css',
                base_url + 'assets/editor/tinymce/codepen.min.css'
            ],
            file_browser_callback: function(field, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    file: base_url + 'assets/editor/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type, // sesuikan direktory KCfinder
                    title: 'File Manager',
                    width: 900,
                    height: 550,
                    inline: true,
                    close_previous: false
                }, {
                    window: win,
                    input: field
                });
                return false;
            },
            setup: function(editor) {
                editor.on('change', function() {
                    tinyMCE.triggerSave();
                });

            }
        });

    }


    function getMCE_2() {


        //powerpaste advcode tinymcespellchecker a11ychecker mediaembed linkchecker
        tinyMCE.init({
            theme: "modern",
            mode: "specific_textareas",
            editor_selector: "mceEditor",
            plugins: ' print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: ' formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            relative_urls: false,
            remove_script_host: false,
            paste_data_images: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [
                base_url + 'assets/editor/tinymce/font_googleapis.css',
                base_url + 'assets/editor/tinymce/codepen.min.css'
            ],
            file_browser_callback: function(field, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    file: base_url + 'assets/editor/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type, // sesuikan direktory KCfinder
                    title: 'File Manager',
                    width: 900,
                    height: 550,
                    inline: true,
                    close_previous: false
                }, {
                    window: win,
                    input: field
                });
                return false;
            },
            setup: function(editor) {
                editor.on('change', function() {
                    tinyMCE.triggerSave();
                });

            }
        });

    }

    function getcontents(controller, tokens, id_rows, id_rows2, id_rows3) {


        if (controller == '#' || controller == null || controller == '0' || controller == '') {
            loadErrorPage();
        } else {

            var http = new XMLHttpRequest();
            var url = base_url + controller;
            var params = '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&tokens=' + tokens + '&id_rows=' + id_rows + '&id_rows2=' + id_rows2 + '&id_rows3=' + id_rows3 + '';
            http.open('POST', url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function() { //Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    //$('#content-container').html("");
                    document.getElementById('content-containers').innerHTML = "";
                    $('#content-containers').html(http.responseText);

                } else {
                    //loadErrorPage();
                }
            }
            http.send(params);

        }

    }

    function getpopup(controller, tokens, id_modal, id_row, id_row2) {
        var base_url = '<?php echo base_url(); ?>';

        var http = new XMLHttpRequest();
        var url = base_url + controller;
        var params = '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&tokens=' + tokens + '&id_modal=' + id_modal + '&id_row=' + id_row + '&id_row2=' + id_row2 + '';
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() { //Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
                //$('#content-popup').html("");
                document.getElementById('content-modals').innerHTML = "";
                $('#content-modals').html(http.responseText);
                $('#' + id_modal).modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true,
                    refresh: true
                });
            } else {
                //loadErrorPage();
            }
        }
        http.send(params);
    }

    function getpopup_coa_approve(controller, tokens, id_modal, id_row, noref, pt, alias) {
        var base_url = '<?php echo base_url(); ?>';

        var http = new XMLHttpRequest();
        var url = base_url + controller;
        var params = '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&tokens=' + tokens + '&id_modal=' + id_modal + '&id_row=' + id_row + '&noref=' + noref + '&pt=' + pt + '&alias=' + alias + '';
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() { //Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
                //$('#content-popup').html("");
                document.getElementById('content-modals').innerHTML = "";
                $('#content-modals').html(http.responseText);
                $('#' + id_modal).modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true,
                    refresh: true
                });
            } else {
                //loadErrorPage();
            }
        }
        http.send(params);
    }

    function getpopup_new_coa(controller, tokens, id_modal, noref, alias) {
        var base_url = '<?php echo base_url(); ?>';

        var http = new XMLHttpRequest();
        var url = base_url + controller;
        var params = '<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>&tokens=' + tokens + '&id_modal=' + id_modal + '&noref=' + noref + '&alias=' + alias + '';
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() { //Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
                //$('#content-popup').html("");
                document.getElementById('content-modals').innerHTML = "";
                $('#content-modals').html(http.responseText);
                $('#' + id_modal).modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true,
                    refresh: true
                });
            } else {
                //loadErrorPage();
            }
        }
        http.send(params);
    }

    function modals(id_modal) {
        $('#' + id_modal).modal('show');
    }

    function loadErrorPage() {
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            url: base_url + 'main/error_page',
            type: 'POST',
            success: function(result) {
                $('#cmain').html("");
                $('#cmain').html(result);
            }
        });
    }

    function loading() {
        loadingPannel = (function() {
            var lpDialog = $("" +
                "<div class='modal' id='lpDialog' data-backdrop='static' data-keyboard='false' style='border-color:#0080FF;width: 100px;height: 10px;margin:0 auto;display:table;position: absolute;left: 0;right:0;top: 50%;position: absolute;border:1px solid;-webkit-transform:translateY(-50%);-moz-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);'>" +
                "<div class='modal-dialog' >" +
                "<div class='modal-content'>" +
                //"<div class='modal-header'><b>Loading...</b></div>" + //Processing
                "<div class='modal-body'>" +
                "<div style='text-align:center'><img src='<?php echo base_url('assets/theme/adm2/img/ajax_loader.gif'); ?>'>Loading...</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>");
            return {
                show: function() {
                    lpDialog.modal('show');
                },
                hide: function() {
                    lpDialog.modal('hide');
                }
            };
        })();
    }


    function loading_posting() {
        loadingPannel = (function() {
            var lpDialog = $("" +
                "<div class='modal' id='lpDialog' data-backdrop='static' data-keyboard='false' style='border-color:#0080FF;width: 150px;height: 10px;margin:0 auto;display:table;position: absolute;left: 0;right:0;top: 50%;position: absolute;border:1px solid;-webkit-transform:translateY(-50%);-moz-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);'>" +
                "<div class='modal-dialog' >" +
                "<div class='modal-content'>" +
                //"<div class='modal-header'><b>Loading...</b></div>" + //Processing
                "<div class='modal-body'>" +
                "<div style='text-align:center'><img src='<?php echo base_url('assets/theme/adm2/img/ajax_loader.gif'); ?>'> <br> Proses Posting...</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>");
            return {
                show: function() {
                    lpDialog.modal('show');
                },
                hide: function() {
                    lpDialog.modal('hide');
                }
            };
        })();
    }

    function loading_coa() {
        loadingPannel = (function() {
            var lpDialog = $("" +
                "<div class='modal' id='lpDialog' data-backdrop='static' data-keyboard='false' style='border-color:#0080FF;width: 150px;height: 10px;margin:0 auto;display:table;position: absolute;left: 0;right:0;top: 50%;position: absolute;border:1px solid;-webkit-transform:translateY(-50%);-moz-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);'>" +
                "<div class='modal-dialog' >" +
                "<div class='modal-content'>" +
                //"<div class='modal-header'><b>Loading...</b></div>" + //Processing
                "<div class='modal-body'>" +
                "<div style='text-align:center'><img src='<?php echo base_url('assets/theme/adm2/img/ajax_loader.gif'); ?>'> <br> Proses Simpan...</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>");
            return {
                show: function() {
                    lpDialog.modal('show');
                },
                hide: function() {
                    lpDialog.modal('hide');
                }
            };
        })();
    }

    function loading_show() {

        $("#loading-spin").show();
    }

    function loading_hide() {
        $("#loading-spin").hide();
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            Command: toastr["error"]("Silahkan Masukan Angka, Tidak Boleh Huruf !", "Info");
            return false;
        }
        return true;
    }

    $('.br-sideleft-menu').on('click', 'li', function() {
        $('.br-sideleft-menu li.active').removeClass('active');
        $(this).addClass('with-sub active show-sub');
    });


    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "show",
        "hideMethod": "fadeOut"
    }
    //showMethod : fadeIn

    //    toastr.options = {
    //          "closeButton": false,
    //          "debug": false,
    //          "newestOnTop": false,
    //          "progressBar": true,
    //          "positionClass": "toast-top-right",
    //          "preventDuplicates": false,
    //          "onclick": null,
    //          "showDuration": "300",
    //          "hideDuration": "1000",
    //          "timeOut": "5000",
    //          "extendedTimeOut": "1000",
    //          "showEasing": "swing",
    //          "hideEasing": "swing",
    //          "showMethod": "slideDown",
    //          "hideMethod": "slideUp"
    //    }




    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }


    // Ini Untuk merubah angka ke angka
    var th = ['', 'ribu', 'juta', 'milyar', 'triliun'];
    // uncomment this line for English Number System
    // var th = ['','thousand','million', 'milliard','billion'];

    var dg = ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
    var tn = ['sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];
    var tw = ['dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'];

    function toWords(s) {
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s)) return 'not a number';
        var x = s.indexOf('.');
        if (x == -1) x = s.length;
        if (x > 15) return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0) str += 'ratus ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk) str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ');
    }

    // Ini Untuk merubah angka ke angka

    //ini untuk merubah periode 
    $("#tx_periode").click(function() {
        var tokens = '<?php echo $this->session->userdata('sess_token'); ?>';
        getpopup('main/set_periode', tokens, 'popup_set_periode', '12');
    });
</script>