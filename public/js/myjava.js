$(document).ready(function(e) {
	
    /*==========================================
     * APPEAR ANIMATION
     *==========================================*/

     $('[data-appear-animation]').appear(function(){
         var delay = $(this).attr('data-appear-delay');
         var $el = $(this);
         if(delay){
             setTimeout(function(){
                 $el.addClass("animated " + $el.attr('data-appear-animation'));
             }, delay);
         } else {
           $el.addClass("animated " + $el.attr('data-appear-animation'));
         }
     });
	 
	 /*==========================================
     * NICE SCROLL
     *==========================================*/
	 $("html, .main_div").niceScroll({
        bouncescroll: true,
        cursorcolor: "#666",
        cursorwidth: "8px",
        scrollspeed: 60,
        smoothscroll: true,
        zindex: "auto" | '9000'
    });

    /*==========================================
     * SHOW TOOLTIP
     *==========================================*/
    $(".showToolTip").tooltip();

    /*==========================================
     * DELETE CONFIRMATION BOX FOR DATA
     *==========================================*/
    $('.confirmButton').click(function(e){
        var $form_id = $(this).attr('data-form-id');
        e.preventDefault();
        swal({
                title: "Confirm Delete?",
                text: "Are your sure you want to delete this data?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: "Don't Delete!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm){
                    $(".main_div #"+$form_id).trigger('submit');
                    //swal("Deleted!", "Your data has been deleted!", "success");
                } else {
                    swal("Cancelled", "Your data is safe!", "error");
                }
            }
        );
    });

    /*==========================================
     * DELETE CONFIRMATION BOX FOR fILE
     *==========================================*/
    $('.pro_delete_file_button').click(function(e){
        var $form_id = $(this).attr('data-delete-form-id');
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm){
                    $(".pro_do_task #"+$form_id).trigger('submit');
                    //swal("Deleted!", "Your data has been deleted!", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    $('form.showSavingOnSubmit').submit(function(){
        var $btn = $(this).find('button:submit');
        $btn.attr('disabled','disabled');
        $btn.button('loading');
    });
});


/*==========================================
 * DELETE SUCCESSFUL INFO
 *==========================================*/
function delete_success_info(data){
    if(!data)
        data = " the data";
    swal("Successfully Deleted!", "You have successfully deleted "+data, "success");
}

/*==========================================
 * RECORD SUCCESSFUL INFO
 *==========================================*/
function store_success_info(data){
    if(!data)
        data = " the data";
    swal("Stored Successfully!", "You have successfully stored "+data, "success");
}

/*==========================================
 * UPDATE SUCCESSFUL INFO
 *==========================================*/
function update_success_info(data){
    if(!data)
        data = " the data";
    swal("Updated Successfully", "You have successfully updated "+data, "success");
}

/*==========================================
 * DELETE FILE SUCCESSFUL INFO
 *==========================================*/
function delete_file_success_info(data){
    if(!data)
        data = " the file";
    swal("हटाउन सफल हुनुभयो!", "तपाईले यो "+data+" राख्न सफल हुनुभयो |", "success");
}

/*==========================================
 * REDIRECTED TO
 *==========================================*/
function redirect_to(data){
    var $mainUrl = $('#homePath').val();
    if(!data)
        data = " these data";
    swal({   title: "तपाईलाई यहाँ पठाइएको छ!",   text: "पहिला यो "+data+" हल्नुहोस|",   imageUrl: $mainUrl+"/public/images/smile1.png" });
}


/*==========================================
 * PAGE LINKER
 *==========================================*/
function page_linker(link1){

    swal({
            title: "तपाई कहाँ जान चाहनुहुन्छ?",
            text: "कार्य छनोट गर्नुहोस :) !",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: '#d9534f',
            confirmButtonText: 'गृह पृष्ठमा',
            cancelButtonText: "यही पेजमा",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm){
                window.location = link1;
            } else {
                swal("Data Stored Successfully!!", "Please go ahead", "success");
            }
        }
    );
}

function showStockTable(val){
	var url = $('#homePath').val()+'/getStockTable';
	$.ajax({
		url: url,
		data: 'date='+val,
		dataType: 'html',
		type: 'GET',
		cache: false,
		success: function (rval) {
			alert(rval);
			$('#stockTable').show();
			$('#stockTable tbody').html(rval);
		}
	});
}

/*==========================================
 * LAGAT KATTA
 *==========================================*/
// function showList(url){
    // if($('#lagatkatta').is(':checked')) {
        // $.ajax({
            // url: url,
            // dataType: 'html',
            // type: 'GET',
            // cache: false,
            // success: function (rval) {
                // $('#lagatkattakaran').html(rval);
            // }
        // });
	// }else{
		// $('#lagatkattakaran').hide();
	// }
// }

//additional functions for data table
$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
}
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };
			
			$(nPaging).addClass('pagination').append(
                '<ul class="pagination">' +
                    '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                    '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                    '</ul>'
            );
            
            var els = $('a', nPaging);
            $(els[0]).bind('click.DT', { action: "previous" }, fnClickHandler);
            $(els[1]).bind('click.DT', { action: "next" }, fnClickHandler);
        },

        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for (i = 0, iLen = an.length; i < iLen; i++) {
                // remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                // add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                        .insertBefore($('li:last', an[i])[0])
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                }

                // add / remove disabled classes from the static elements
                if (oPaging.iPage === 0) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
});


