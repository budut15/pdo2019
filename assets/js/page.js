function searchWithPagination(page_number,links,keys){
	var url=$('meta[name=csrf]').attr("url_public");
	var token=$('meta[name=csrf]').attr("content");
	
	$.ajax({
		url: url+links,
		type: 'POST', 
		data: {keys: keys, page: page_number,csrf_token:token},
		dataType: "html",
		cache: false,
		beforeSend: function(e) {
			loadpanel();
		},
		success: function(response){ 
			csrf();
			$(".view_data").html(response);
			hidepanel();
			//page_content_onresize();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			csrf();
			//alert(xhr.responseText); 
			hidepanel();
		}
	});
}

		function csrf(){
			var url=$('meta[name=csrf]').attr("url_public");
			$.get(url+'ajax/csrf',function(data){
			$('meta[name=csrf]').attr("content",data);
			});
		}
		
		function loadpage(){
			  $('body').css('cursor', 'wait');
			  var title = "";
			  var icon = "";
			  var duration = "";
			  var url=$('meta[name=csrf]').attr("url_public");
			  $.Toast.showToast({title: title,duration: duration, icon:icon,image: url+'assets/img/loading2.gif'});
		}
		//loadpage()
		function hidepage(){
			$.Toast.hideToast();
			$('body').css('cursor', 'default');
		}
		
		function loadpanel(){
			  //$('body').css('cursor', 'wait');
			  var title = "";
			  var icon = "";
			  var duration = "";
			  var url=$('meta[name=csrf]').attr("url_public");
			  $.Toast2.showToast({title: title,duration: duration, icon:icon,kelas:'.table-responsive',image: url+'assets/img/load.svg'});
		}
		//loadpage()
		function hidepanel(){
			$.Toast2.hideToast();
			//$('body').css('cursor', 'default');
		}
		
		function formatDate(date,kode) {
			var d = new Date(date),
				month = '' + (d.getMonth()+1),
				day = '' + d.getDate(),
				year ='' + d.getFullYear(),
				hour ='' + d.getHours(),
				minute ='' + d.getMinutes(),
				second ='' + d.getSeconds();
			
			var bulan=['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			
			var bln=['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'];
				

			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;
			if (hour.length < 2) hour = '0' + hour;
			if (minute.length < 2) minute = '0' + minute;
			if (second.length < 2) second = '0' + second;
			
			//alert([day, month, year].join('-')+' '+[hour,minute,second].join(':'));
			if(kode==1){
				
				var cek= [day, month, year].join('/');
				
			}else if(kode==2){
			
			var cek= [day, bulan[d.getMonth()], year].join('-');
				
			}else if(kode==3){
				
			var cek= [day, month, year].join('/')+' '+[hour,minute,second].join(':');
				
			}else if(kode==4){
				
			var cek= [year, month, day].join('-');
				
			}else if(kode==5){
				
			var cek= [day, bln[d.getMonth()], year].join('-');
				
			}else if(kode==6){
				
			var cek= [day, bln[d.getMonth()], year].join('-')+' '+[hour,minute,second].join(':');
				
			}else if(kode==7){
				
			var cek= [day, month, year].join('-');
				
			}else{
				
			var cek= [day, bln[d.getMonth()], year].join('-');
				
			}
			return cek;
		}
		

		function isNumberKey(evt)
		  {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
			return true;
		  }
		function goBack() {
			window.history.back();
		}
		function addPeriod(nStr)
		{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return x1 + x2;
		}
		 
			//$("#NOMR").mask("999999999");
		
		
		function removeParam(key, sourceURL) {
			var rtn = sourceURL.split("?")[0],
				param,
				params_arr = [],
				queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
			if (queryString !== "") {
				params_arr = queryString.split("&");
				for (var i = params_arr.length - 1; i >= 0; i -= 1) {
					param = params_arr[i].split("=")[0];
					if (param === key) {
						params_arr.splice(i, 1);
					}
				}
				rtn = rtn + "?" + params_arr.join("&");
			}
			return rtn;
		}
	
        function getdate() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            if (h < 10) {
                h = "0" + h;
            }
            if (m < 10) {
                m = "0" + m;
            }
            if (s < 10) {
                s = "0" + s;
            }

            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
            var yy = date.getYear();
            var year = (yy < 1000) ? yy + 1900 : yy;

            var tgl = (thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
            var jam = (h + ":" + m + ":" + s + " wib");
            $("#timer").html(tgl + ' ' + jam);
            setTimeout(function () { getdate() }, 1000);
        }
		
	$(document).on('nifty.ready', function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#datarange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#tanggal').val(start.format('YYYY-MM-DD'));
        $('#tanggal2').val(end.format('YYYY-MM-DD'));
    }

    $('#datarange').daterangepicker({
        startDate: start,
        endDate: end,
		opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        //cancelClass: 'btn-small',
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
		
    }, cb);
	  $('.lahir').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		locale: {format: "DD-MM-YYYY"},
		minYear: 1950,
		maxYear: parseInt(moment().format('YYYY'),10)
	  });
	  
	  $('.tanggal').daterangepicker({
		singleDatePicker: true,
		//showDropdowns: true,
		locale: {format: "DD-MM-YYYY"}
		//minYear: 1950,
		//maxYear: parseInt(moment().format('YYYY'),10)
	  });

    cb(start, end);
		});