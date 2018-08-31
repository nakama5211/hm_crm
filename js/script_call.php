<script type="text/javascript">
	function showNewTab(sdt) {
		var id = window.top.$(".nav-tabs").children().length;
		var ulChildren = window.top.$(".nav-tabs").children();  
		var link = '<?php echo base_url().'user/detail' ?>+sdt';
		var title = sdt;
		var checkLink = false;
		for(var i = 0; i < id ;i++)
	      {
	      	if(ulChildren[i].children[0].nodeName.toLowerCase() === 'a'){
                  if(title == ulChildren[i].children[0].title)
                  {
                    checkLink = true;
                    var j = i+1;
                     window.top.$('.nav-tabs li:nth-child(' + j + ') a').click();
                     break;
                  }
                }
	      }
	     if(checkLink == true)
                {
                    return;
                }
              else
                {
			        window.top.$( ".nav-link" ).removeClass( "active" );
			        window.top.$( ".tab-pane" ).removeClass( "active" );
			         //think about it ;)
			        window.top.$('.nav-menu li:last-child').after('<li class="nav-item ">\
			    <a class="nav-link active show" role="tab" data-toggle="tab" href="#tab'+id+'" title="'+title+'" >\
			      <i class="fas fa-user-circle"></i> \
			      <span class="title_tab">'+title+'</span> </a><span class="fa fa-times-circle" aria-hidden="true"></span>\
			  </li>');
			        window.top.$('.tab-content').append('<div class="tab-pane active" id="tab' + id + '"><iframe id="myiframe1" class="myiframe" name="myiframe'+id+'" src="'+link+'" frameborder="0"></iframe></div>');
			        var i = id+1;
			       window.top.$('.nav-tabs li:nth-child(' + i + ') a').click(); 
					// window.top.document.getElementById("myiframe1").src = $(this).attr('title');
				}
	}
</script>