<script type="text/javascript">
	$(document).ready(function(){
		$('#table-1-knowledge').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
            "columns": [
              { "width": "18%" },
              { "width": "17%" },
              { "width": "10%" },
              { "width": "15%" },
              { "width": "10%" },
              { "width": "10%" },
              { "width": "10%" }
            ],
            "info":     false,
            "ordering": false,
            "searching": false,
            "scrollY":        "100%",
            "iDisplayLength": 15,
            "scrollX":        true,
            "bLengthChange": false,
            "scrollCollapse": true
          }).columns.adjust().draw();

    $('select#level_1').change(function(){
        var val = $(this).val();
        if(val){
          $('select#level_2 option, select#level_3 option').each(function(){
            var ref1 = $(this).attr('ref1');
            if (ref1==val) {
              $(this).removeClass('hide');
            }else{
              $(this).addClass('hide');
            }
          });
        }else{
          $('select#level_2 option, select#level_3 option').each(function(){
            $(this).removeClass('hide');
          });
        }
    });
    $('select#level_2').change(function(){
        var val = $(this).val();
        if(val){
          $('select#level_3 option').each(function(){
            var ref2 = $(this).attr('ref2');
            if (ref2==val) {
              $(this).removeClass('hide');
            }else{
              $(this).addClass('hide');
            }
          });
        }else{
          $('select#level_3 option').each(function(){
            $(this).removeClass('hide');
          });
        }  
    });
	});

	$('#btn-search').click(function(){
		// alert($(this).attr('id'));
		var text = $('#search_area input[name="s_text"]').val();
		var group = $('#search_area select[name="s_group"]').val();
		var cate = $('#search_area select[name="s_cate"]').val();
		var type = $('#search_area select[name="s_type"]').val();
		var createby = $('#search_area select[name="s_createby"]').val();
		if (text.length>50) {
			alert('Không được nhập quá 50 ký tự.');
		}else{
		document.getElementById('iframesearch').src = "<?php echo base_url().'knowledge/search/?groupid='?>"+group+"&categoryid="+cate+"&tickettype="+type+"&createby="+createby+"&search="+text;
		}
	});
</script>