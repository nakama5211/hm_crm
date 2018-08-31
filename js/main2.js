function removeTab()
        {
            var id = window.top.$(".nav-tabs").children().length;
            var idtab = window.top.$(".nav-tabs").find("li > a.active").attr('href');
            var idnavbar = window.top.$(".nav-tabs").find("li > a.active").parent();
            $(idnavbar).remove();
            $(idtab).remove();
            window.top.$('.nav-tabs li:nth-child(' + (id-1) + ') a').click();
        }

function addTab(link,title,checkInsert) {
	 var x = Math.floor((Math.random() * 999) + 1);
    var id = window.top.$(".nav-tabs").children().length;
    var idtab = window.top.arrayTab[x];
    window.top.arrayTab.splice(x, 1);
      var ulChildren = window.top.$(".nav-tabs").children();  
      var link = link;
      var title = title;
      var checkLink = false;
      if(checkInsert == true)
      {
           window.top.$( ".nav-link" ).removeClass( "active" );
          window.top.$( ".tab-pane" ).removeClass( "active" );
           //think about it ;)
          window.top.$('.nav-tabs li:nth-child('+id+')').after('<li class="nav-item width-170  role="presentation"">\
      <a class="nav-link active show" name="'+link+'" role="tab" data-toggle="tab" href="#'+idtab+'" title="'+title+'" >\
        <i class="fas fa-tags"></i> \
        <span class="">'+title+'</span> </a><span class="fa fa-times" aria-hidden="true"></span>\
    </li>');
          window.top.$('.tab-content').append('<div class="tab-pane active" id="' + idtab + '"><iframe id="myiframe1" class="myiframe" name="myiframe'+id+'" src="'+link+'" frameborder="0"></iframe></div>');
          var widthsub = window.top.$('.nav-insert').width() * 2;
          var width = window.top.$('#lengthmenu').width() - widthsub;
              if(id >4)
              {
                  window.top.$("ul.nav-tabs li").each(function(){
                    $(this).attr('style', 'width:'+width/(id+1)+'px !important;');
                  });
                 
              }
              else{
                window.top.$("ul.nav-tabs li").each(function(){
                    $(this).attr('style', 'width:170px !important;');
                  });
              }
          var i = id+1;
         window.top.$('.nav-tabs li:nth-child(' + i + ') a').click(); 
         return;
      }
      for(var i = 0; i < id ;i++)
        {
          if(ulChildren[i].children[0].nodeName.toLowerCase() === 'a'){
                  if(link == ulChildren[i].children[0].name)
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
                else{
        window.top.$( ".nav-link" ).removeClass( "active" );
        window.top.$( ".tab-pane" ).removeClass( "active" );
         //think about it ;)
        window.top.$('.nav-tabs li:nth-child('+id+')').after('<li class="nav-item width-170  role="presentation"">\
    <a class="nav-link active show" name="'+link+'" role="tab" data-toggle="tab" href="#'+idtab+'" title="'+title+'" >\
      <i class="fas fa-tags"></i> \
      <span class="">'+title+'</span> </a><span class="fa fa-times" aria-hidden="true"></span>\
  </li>');
        window.top.$('.tab-content').append('<div class="tab-pane active" id="' + idtab + '"><iframe id="myiframe1" class="myiframe" name="myiframe'+id+'" src="'+link+'" frameborder="0"></iframe></div>');
        var widthsub = window.top.$('.nav-insert').width() * 2;
        var width = window.top.$('#lengthmenu').width() - widthsub;
            if(id >4)
            {
                window.top.$("ul.nav-tabs li").each(function(){
                  $(this).attr('style', 'width:'+width/(id+1)+'px !important;');
                });
               
            }
            else{
              window.top.$("ul.nav-tabs li").each(function(){
                  $(this).attr('style', 'width:170px !important;');
                });
            }
        var i = id+1;
       window.top.$('.nav-tabs li:nth-child(' + i + ') a').click(); 
     }
  }

