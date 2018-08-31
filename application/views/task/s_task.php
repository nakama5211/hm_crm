<script type="text/javascript">
$(document).ready(function(){

	var h = $('table.dataTable').find('thead');
	var _o = h.attr('status-o'); $('label#_o').html(_o);
	var _w = h.attr('status-w'); $('label#_w').html(_w);
	var _c = h.attr('status-c'); $('label#_c').html(_c);
});
	var table = 
	$('#table-1').DataTable({
	     "paging":   true,
	     "language": {
	      "paginate": {
	        "previous": "Trước",
	        "next":"Sau"
	      }
	    },
	    "ordering": false,
	    "info":     false,
	    "searching": true,
	    "scrollY":        "100%",
	    // "scrollX":        true,
	    "bLengthChange": false,
	    "iDisplayLength": 25,
	    "scrollCollapse": true
	});

	$('a.dropdown-item').click(function(){
		var type = $(this).find('label').attr('id');
		var str = $(this).find('p').html();
		$('#_type').html(str.replace(/[0-9]/g, ''));
		$('#_all').html($(this).find('label').html()+" Công việc");
		switch (type){
			case '_o':
				table.search("Chờ xác nhận").draw();
				break;
			case '_w':
				table.search("Đang xử lý").draw();
				break;
			case '_c':
				table.search("Hoàn thành").draw();
				break;
			case '_a':
				table.search('').draw();
				break;
			default: break;
		}
	});
</script>