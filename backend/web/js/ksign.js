

var sig = $("#signature1").jSignature({color:"#000","background-color":"#999",'UndoButton':true});

var dataurl = $("#servicejob-signature_customer_name").val();

if (dataurl=="") {
  var info = dataurl.substring(0,1);
}

//console.log(dataurl);

if (info =="i") {
  var data = "data:"+dataurl;
  sig.jSignature("setData", data) ;
}


//console.log(dataurl);
//console.log(data);
//var $sigdiv = $("#signature1");
//sigdiv.jSignature();
//console.log($sigdiv);
//sig.jSignature("setData", "data:image/jsignature;base30,cVZ1000Y59ce1Gomn1Sla4331222_2Q9aad331000000062344544") ;
//$("#signature1").jSignature("importData",dataurl);

$("#test").click(function(e){
  //e.preventDefault();

var testdata = $('#signature1').jSignature('getData','base30');
if (testdata == "image/jsignature;base30,") {
  testdata = "";
}

var arc = $("#servicejob-signature_customer_name").val(testdata);
//console.log(arc);

//var testdata = $('#signature1').jSignature('getData','svg');


//var testdata = $('#signature1').jSignature("getData","base30");
//console.log(testdata);
//  $("#servicejob-signature_web").val("");
//  $("#servicejob-signature_web").val(testdata);

})
