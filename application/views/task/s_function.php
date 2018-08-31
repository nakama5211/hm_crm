<script type="text/javascript">
	function newTab(title,link) {
      var ulChildren = $(".nav-tabs").children();  
      var id = $(".nav-tabs").children().length;
      var idtab = id+title;
      var checkLink = false;
      for(var i = 0; i < id ;i++)
      {
        // alert(ulChildren[i].children[0].nodeName.toLowerCase());
        if(ulChildren[i].children[0].nodeName.toLowerCase() === 'a'){
          if(title == ulChildren[i].children[0].title)
          {
            checkLink = true;
            var j = i+1;
             $('.nav-tabs li:nth-child(' + j + ') a').click();
             break;

            // alert("found one, the id is: " + ulChildren[i].children[0].title);
          }
        }
      }
      if(checkLink == true)
        {
            return;
        }
      else
        {
            if(link == "#")
            {
              return;
            }
          else{
              if(title == 'Search')
              {
                var icon = 'fas fa-search-plus';
              }
              else if(title == 'Ticket')
              {
              var icon = 'fas fa-home';
              }
              else if(title == 'User')
              {
              var icon = 'fas fa-user-circle';
              }
              else{
                var icon = 'far fa-calendar-alt';
              }
                $( ".nav-link" ).removeClass( "active" );
                $( ".tab-pane" ).removeClass( "active" );
                 //think about it ;)
                $('.nav-tabs li:nth-child('+id+')').after('<li class="nav-item width-170"  role="presentation">\
            		<a class="nav-link active show" role="tab" data-toggle="tab" href="#tab'+idtab+'" title="'+title+'" >\
              			<i class="'+icon+'"></i> \
              			<span class="">'+title+'</span> </a><span class="fa fa-times" aria-hidden="true"></span>\
          			</li>');
                $('.tab-content').append('<div class="tab-pane active" id="tab' + idtab + '"><iframe id="myiframe1" class="myiframe" name="myiframe'+id+'" src="'+link+'" frameborder="0"></iframe></div>');
                var width = 956;
            if(id >4)
            {
                $("ul.nav-tabs li").each(function(){
                  $(this).attr('style', 'width:'+width/(id+1)+'px !important;');
                });
               
            }
            else{
              $("ul.nav-tabs li").each(function(){
                  $(this).attr('style', 'width:170px !important;');
                });
            }
                var i = id+1;
               $('.nav-tabs li:nth-child(' + i + ') a').click(); 
               // break;
          }
            
       }
	}
</script>