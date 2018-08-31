var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;
var clients = {};
var book = {};
var status = {};

server.listen(port,function(){
  console.log('Server listening at port %d', port);
})

io.sockets.on('connection', function (socket) {

  clients[socket.id] = socket;
  
  console.log('a user connected: ' + socket.id);
  if(socket.handshake.query['phone']){book[socket.handshake.query['phone']]=socket.id;console.log(book);}
  io.sockets.emit( 'new_connect', {
    client: socket.id 
  });
  
  socket.on("disconnect",function(data){
    console.log("disconnected"+socket.id);
    io.sockets.emit( 'disconnect_client', {
      client: socket.id 
    });
    delete clients[socket.id];
  });

  socket.on('to_target', function(id, event){
    socket.broadcast.to(id).emit('prv_event', event);
  });

  socket.on( 'new_client', function( data ) {
    console.log(data);
    io.sockets.emit( 'new_client', {
    	name: data.name,
    	phone: data.phone,
    	id: data.id
    });
  });
});

var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.get('/', function(req, res) {
    console.log('----');
    res.send("Socket on");
});

app.post('/call',function(req,res){
    res.header("Access-Control-Allow-Origin", "*");
    let params= req.body;
    console.log(params);

    io.sockets.emit( 'object_event', {
      object: params 
    });

    let socketid='';
    let type= '';

    // if(clients.hasOwnProperty(params.value.extension)){
    //   socketid= clients[params.value.extension].socketid;
    // }
    
    if(params.event=='AgentStatus'){
      params = params.value;
      if(params.statustext&&params.statustext.toLowerCase()=='idle'){
        status[params.exten] = "ready";
      }
      type='changeStatusAgent';
    }
    else{


      type="callEvent";


      if(params.event.toLowerCase()=='ringing' ){
        var s_data = params.value;
        // console.log(params);
        // console.log(book);
        // console.log(book[s_data.tonumber]);
        // &&status[s_data.tonumber].toLowerCase()=='ready'
        if (book[s_data.tonumber]&&s_data.calltype.toLowerCase()=='inboundextension') {
          console.log("ringing to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_ringing', s_data);
        }
        if (book[s_data.fromnumber]&&s_data.calltype.toLowerCase()=='outboundextension') {
          console.log("ringing to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_ringing_outbound', s_data);
        }
      }


      else if(params.event.toLowerCase()=='answered'){
        var s_data = params.value;
        // console.log(params);
        // console.log(book);
        // console.log(book[s_data.tonumber]);
        if (book[s_data.tonumber]&&s_data.calltype.toLowerCase()=='inboundextension') {
          console.log("answered to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_answered', s_data);
        }else if(book[s_data.fromnumber]&&s_data.calltype.toLowerCase()=='outboundextension'){
          console.log("answered from"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.fromnumber]].emit('e_customer_answered', s_data);
        }
      }


      else if(params.event.toLowerCase()=='completed'){
        let config = false;
        // console.log(params);
        //create ticket if agent not in crm
         //select database and insert  to call log
        var s_data = params.value;
        // console.log(book);
        // console.log(book[s_data.tonumber]);
        if (book[s_data.tonumber]&&s_data.calltype.toLowerCase()=='inboundextension') {
          console.log("completed to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_completed', s_data);
        }
        if (book[s_data.fromnumber]&&s_data.calltype.toLowerCase()=='outboundextension') {
          console.log("completed to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_completed_outbound', s_data);
        }
      }


      else if(params.event.toLowerCase()=='misscall'){
        let config = false;
        // console.log(params);
        //create ticket if agent not in crm
         //select database and insert  to call log
        var s_data = params.value;
        // console.log(book);
        // console.log(book[s_data.tonumber]);
        if (book[s_data.tonumber]&&s_data.calltype.toLowerCase()=='inboundextension') {
          console.log("misscall to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_misscall', s_data);
        }
        if (book[s_data.fromnumber]&&s_data.calltype.toLowerCase()=='outboundextension') {
          console.log("misscall to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_misscall_outbound', s_data);
        }
      }


      else if(params.event.toLowerCase()=='hangup'){
        var s_data = params.value;
        // console.log(params);
        // console.log(book);
        // console.log(book[s_data.tonumber]);
        if (book[s_data.tonumber]&&s_data.calltype.toLowerCase()=='inboundextension') {
          console.log("hangup to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.tonumber]].emit('e_'+params.event.toLowerCase(), s_data);
        }else if(book[s_data.fromnumber]&&s_data.calltype.toLowerCase()=='outboundextension'){
          console.log("hangup to"+book[s_data.tonumber]);
          io.sockets.connected[book[s_data.fromnumber]].emit('e_customer_hangup', s_data);
        }
      }


    }


    // if ringing or answered or hangup only emit socket , completed => insert call log and emit socket

    if(socketid!=''){
      io.sockets.connected[socketid].emit(type,params)
    }

    res.end("yes");
});
