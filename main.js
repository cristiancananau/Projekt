$(document).ready(function(){
	gericht();

		function gericht(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getGericht:1},
			success	:	function(data){
				$("#get_gericht").html(data);
			}
		})
	}
    tagesangebot1();
    function tagesangebot1(){
        $.ajax({
            url	:	"action.php",
            method:	"POST",
            data	:	{getTagesangebot1:1},
            success	:	function(data){
                $("#get_tagesangebot1").html(data);
            }
        })
    }
    tagesangebot2();
    function tagesangebot2(){
        $.ajax({
            url	:	"action.php",
            method:	"POST",
            data	:	{getTagesangebot2:1},
            success	:	function(data){
                $("#get_tagesangebot2").html(data);
            }
        })
    }
    tagesangebot3();
    function tagesangebot3(){
        $.ajax({
            url	:	"action.php",
            method:	"POST",
            data	:	{getTagesangebot3:1},
            success	:	function(data){
                $("#get_tagesangebot3").html(data);
            }
        })
    }
    $("#suchen_btn").click(function(){
        $("#get_gericht").html("<h3>Loading...</h3>");
        var schlusselwort = $("#suchen").val();
        if(schlusselwort != ""){
            $.ajax({
                url		:	"action.php",
                method	:	"POST",
                data	:	{suchen:1,schlusselwort:schlusselwort},
                success	:	function(data){
                    $("#get_gericht").html(data);
                    if($("body").width() < 480){
                        $("body").scrollTop(683);
                    }
                }
            })
        }
    })
    $("#regist_btn").click(function(event){
        event.preventDefault();
        $.ajax({
            url		:	"register.php",
            method	:	"POST",
            data	:	$("form").serialize(),
            success	:	function(data){
                $("#regist_nachricht").html(data);
            }
        })

    })
	$("#regist1_btn").click(function(event){
		event.preventDefault();
    $.ajax({
        url		:	"register1.php",
        method	:	"POST",
        data	:	$("form").serialize(),
        success	:	function(data){
            $("#regist_nachricht").html(data);
        }
    })

})
	$("#login").click(function(event){
	event.preventDefault();
	var username = $("#username").val();
	var pass = $("#password").val();
	$.ajax({
		url : "login.php",
		method: "POST",
		data  : {userLogin:1, userUsername:username,userPassword:pass},
		success : function (data) {
            if(data == "hi"){
				window.location.href = "profile.php"
			}
            $("#login_falsch").html(data);

        }
	})
})
    warenkorb_menge();
    $("body").delegate("#gericht" , "click" , function (event) {
        event.preventDefault();
        var g_id = $(this).attr('pid')
		$.ajax({
			url : "action.php",
			method : "POST",
			data  : {addGericht:1,geID:g_id},
			success : function (data) {
				$("#gericht_nachricht").html(data);
                warenkorb_menge();

            }
		})
    })
    warenkorb_inhalt();
    function warenkorb_inhalt(){
        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{get_warenkorb_gericht:1},
            success	:	function(data){
                $("#warenkorb_gericht").html(data);
            }
        })

    };
    function warenkorb_menge(){
        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{warenkorb_menge:1},
            success	:	function(data){
                $(".badge").html(data);
            }
        })
    }


    $("#warenkorb_inhalt").click(function (event) {
        event.preventDefault();
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {get_warenkorb_gericht:1},
            success : function (data) {
                $("#warenkorb_gericht").html(data);
            }

        })
    })
    warenkorb_kaufen();
    function warenkorb_kaufen(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {warenkorb_kaufen:1},
            success : function (data) {
                $("#warenkorb_kaufen").html(data);
            }

        })
    }
    $("body").delegate(".menge","keyup",function(){
    	var gid = $(this).attr("pid");
    	var menge = $("#menge-"+gid).val();
    	var preis = $("#preis-"+gid).val();
    	var gesamt = menge * preis;
    	$("#gesamt-"+gid).val(gesamt);
    })
	$("body").delegate(".entfernen","click",function (event) {
        event.preventDefault();
        var gid=$(this).attr("entfernen_id");
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {entfernenVonWarenkorb:1,entfernenID:gid},
            success : function (data) {
            	$("#warenkorb_msg").html(data);
                warenkorb_kaufen(); //sa nu actualizezi singur de fiecare data

            }
		})
    })
    $("body").delegate(".aktualisieren","click",function (event) {
        event.preventDefault();
        var gid = $(this).attr("aktualisieren_id");
        var menge = $("#menge-"+gid).val();
        var preis = $("#preis-"+gid).val();
        var gesamt = $("#gesamt-"+gid).val();
        $.ajax({
            url	:"action.php",
            method	:	"POST",
            data	:	{aktualisierenGericht:1, aktualisierenID:gid, menge:menge, preis:preis, gesamt:gesamt},
            success	:	function(data){
                $("#warenkorb_msg").html(data);
                warenkorb_kaufen(); //sa nu actualizezi singur de fiecare data
            }
        })
    })
    kunde_information();
    function kunde_information(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {kunde_information:1},
            success : function (data) {
                $("#kunde_information").html(data);
            }

        })
    }
    $("#addbankverb").click(function(event){
        event.preventDefault();
        $.ajax({
            url		:	"bankdatenregister.php",
            method	:	"POST",
            data	:	$("form").serialize(),
            success	:	function(data){
                $("#bankverbnachricht").html(data);
            }
        })

    })
    bestellunginformation();
    function bestellunginformation(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {bestellungInformation:1},
            success : function (data) {
                $("#bestellung_information").html(data);
            }

        })
    }
    adminbestell();
    function adminbestell(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data  : {bestellungAdmin:1},
            success : function (data) {
                $("#bestellung_admin").html(data);
            }

        })
    }
    $("body").delegate(".baktualisieren","click",function (event) {
        event.preventDefault();
        var bid = $(this).attr("baktualisieren_id");
        $.ajax({
            url	:"action.php",
            method	:	"POST",
            data	:	{aktualisierenBestellung:1,baktualisierenID:bid},
            success	:	function(data){
                $("#bestellung_msg").html(data);
                adminbestell();

            }
        })
    })
    $("body").delegate(".baktualisieren1","click",function (event) {
        event.preventDefault();
        var bid = $(this).attr("baktualisieren_id1");
        $.ajax({
            url	:"action.php",
            method	:	"POST",
            data	:	{aktualisierenBestellung1:1,baktualisierenID1:bid},
            success	:	function(data){
                $("#bestellung_msg").html(data);
                adminbestell();

            }
        })
    })
    $("body").delegate(".baktualisieren2","click",function (event) {
        event.preventDefault();
        var bid = $(this).attr("baktualisieren_id2");
        $.ajax({
            url	:"action.php",
            method	:	"POST",
            data	:	{aktualisierenBestellung2:1,baktualisierenID2:bid},
            success	:	function(data){
                $("#bestellung_msg").html(data);
                adminbestell();

            }
        })
    })

})






















