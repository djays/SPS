
$(function(){

    //$('#outer-frame').corners();
    //$('#page-frame').corners();
    //$('#header').corners("top-left top-right");
    //$('#footer').corners("bottom-left bottom-right");
    $("#sliding-navigation li").click(function (){
        var url = $(this).find("a").attr("href");
        $.get(url,'',function(data){resultPOST(data);});
        return false;

    });

    $.get('ajx.php?id=2','',function(data){resultPOST(data);});
    slidebar("#sliding-navigation", 25, 15, 150, .8);
    
    
});

function myalert(msg)
{
Sexy.alert('<div class="alertMsg">'+msg+'</div>');
}
function myinfo(msg)
{
Sexy.info('<div class="alertMsg">'+msg+'</div>');
}
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}


function validitem(obj)
{
    var chkr = $.trim($(obj).val());
    if(chkr == '' || chkr == '-- Select --')
       {
         $(obj).css("background","#ffffCC"); 
         $(obj).css("border","2px solid #CF0C06");
         return false;
        }
    else
        return true;
}
function validate(obj)
{
    var i=0;
    var items = obj.split(',');
    var res = true;
    while(i<items.length)
        {
        res= res & validitem(items[i]);
        i+=1;
        }
    if (res == 0)
       myalert('Please Complete the Form');
    return res;  
}
function resultPOST(data)
{
    $('#main-content').html(data);
}
function sendPOST(obj,other,loc,func)
{
    var i=0;
    var items = obj.split(',');
    var dataString = '';
    while(i<items.length)
    {
    dataString+='&'+items[i].substr(1)+'='+$(items[i]).val();
    i++;
    }
    dataString=other+dataString;
    $.ajax({ type:"POST",url:loc,data:dataString,success:function(data){resultPOST(data);} });
    
}

function validate1()
{
    var result = validate('#Name,#regno,#Dept,#Sem,#Sec,#GID');
    var chk = $('#Sem').val();
            
    if (typeof(chk) != 'number')
    {
       myalert("Invalid Semester Value");
        return false;
    }
    if(result == 1)
    {
        sendPOST('#Name,#regno,#Dept,#Sem,#Sec,#GID','id=1','admin-end.php');
    }
}
function validate2()
{
    var result = validate('#Name,#empcode,#Dept');
    if(result == 1)
    {
        sendPOST('#Name,#empcode,#Dept','id=2','admin-end.php');
    }
}
function validate3()
{
    var result = validate('#GID,#Name');
    if(result == 1)
    {
        sendPOST('#GID,#Name','id=3','admin-end.php');
    }
}

function validate4()
{
    var chk = $('#usern').val();
    var result = validate('#usern,#Pass,#PassRe');
    if ((chk == 'DeptAdmin')|| (chk == 'HOD'))
    {
        var tr = trim($('#dept').val());
        if(tr!='')
            chk+='-'+tr;
        else
           myalert('Please Enter Department Code');            
    }    
    if($('#PassRe').val()!=$('#Pass').val())
    {
        result =0;
       myalert("Passwords Don't Match");
    }
    
    if(result == 1)
    {
        sendPOST('#Pass','id=4&usern='+chk,'admin-end.php');
    }
}
function validate5()
{
    var result = validate('#sem,#sec,#year,#dept');
    var chk = $('#sem').val();
  
    if(chk>=1 && chk <=8)
        result=result & 1;
    else
    {
        result = 0;
       myalert('Invalid Semester Value');
    }
    var yr = $('#year').val();
    if(yr<=2009 && yr>=2000)
        result = result & 1;
    else
    {
       myalert("Invalid Year");
        return;
    }
    var sub = $('#sub').val();
    var teach = $('#teach').val();
    var subcode = trim(sub.split('--')[0]);
    var empcode = trim(teach.split('--')[0]);
    if(result == 1)
    {
        sendPOST('#sem,#sec,#year,#dept','id=1&emp='+empcode+'&sub='+subcode,'deptadmin-end.php');
    }
}
function toArray(elName)
{
    var ref  =  document.getElementsByName(elName);
    var arr= new Array(); 
    var i = 0;
    while (i<ref.length)
    {
        arr[i]=ref[i].value;
        i++;
    }

    return arr;
}
function validate6()
{
    var grades = toArray('grade');
    var subcodes = toArray('subcode');
    var reg = trim($('#regno + input').val());
    if ( reg == '--Select--' || reg == '')
        return false;
    var regcode = reg.split('--');
    $.post('deptadmin-end.php',{'grades[]':grades,'subcodes[]':subcodes,'regcode':regcode[0],'id':3},function(data){$('#main-content').html(data);});    
}
function showDept()
{
    var chk = $('#usern').val();
    if ((chk == 'DeptAdmin')|| (chk == 'HOD'))
        $('#sDept').show(200);
    else
        $('#sDept').hide(250);
    
}
function getSubj()
{
    var reg = trim($('#regno + input').val());
    var sem = $('#sem').val();
    if(sem<=9 && sem >=1)
    {
    }
    else
    {
       myalert('Invalid Sem Number');
        return false;
    }
    if ( reg == '--Select--' || reg == '')
        return false;
    var regcode = reg.split('--');
    $.post('deptadmin-end.php',{'reg':regcode[0],'id':2,'sem':sem},function(data){$('#data1').html(data);});    
}
function getContents(sub,sem,sec,dept)
{
    $.post('teach-end.php?id=1',{'sub':sub,'dept':dept,'sem':sem,'sec':sec},function(data){$('#main-content').html(data);});    

}

function saveMarks(reg,sub)
{
    var m1 = $('#frm'+reg+' #marksSess1').val();
    var m2 = $('#frm'+reg+' #marksSess2').val();
    var m3 = $('#frm'+reg+' #marksSess3').val();
    if( (m1>=0 && m1 <21) && (m2>=0 && m2<21)&& (m3>=0 && m3<21)) 
    {
    }
    else
        {
           myalert('Invalid Sessional Marks');
            return false;
        }
    $.post('teach-end.php?id=3',{'sub':sub,'reg':reg,'m1':m3,'m2':m2,'m3':m1},function(data){

if (trim(data)=='DONE')
    myinfo('Marks Have Been Updated');
$('#li'+reg).slideToggle(300);
});    
}
function getSesMarks(reg,sub)
{
    $.post('teach-end.php?id=2',{'sub':sub,'reg':reg},function(data){$('#li'+reg).html(data); $('#li'+reg).slideToggle(300);             
});       
}
function sessfromHod()
{
   
    var reg = $('#reg').val();
    if (reg =='--Select--')
    {
        myalert('Please Select Appropriate Record');
        return false;
    }
    var regno = reg.split('-')[0];
    $.post('view-ajx.php?id=1',{'regno':regno},function(data){
$('#main-content').html(data);
});

}
function gradefromHod()
{
   
    var reg = $('#reg').val();
    if (reg =='--Select--')
    {
        myalert('Please Select Appropriate Record');
        return false;
    }
    var regno = reg.split('-')[0];
    $.post('view-ajx.php?id=3',{'regno':regno},function(data){
$('#main-content').html(data);
});

}
function sessfromDir()
{
    var dept = $('#dept').val();
    if (dept =='--Select--')
    {
        myalert('Please Select Appropriate Record');
        return false;
    }
    $.post('hod-ajx.php?id=1',{'dept':dept},function(data){
$('#main-content').html(data);
});

}
function gradefromDir()
{
    var dept = $('#dept').val();
    if (dept =='--Select--')
    {
        myalert('Please Select Appropriate Record');
        return false;
    }    
    
    $.post('hod-ajx.php?id=2',{'dept':dept},function(data){
$('#main-content').html(data);
});

}

function sendMsg()
{
    var add = trim($('#address').val());
    var msg = trim($('#msg').val());
    var address = add.split('--')
    if(msg =='')
    {
        myalert('Please Enter the Message');
        return false;
    }
    if(add == '--Select--')
    {
        myalert('Please Select Recepient');
        return false;
    }
     $.post('messages.php?id=4',{'add':address[0],'msg':msg},function(data){
    if (trim(data.substr(0,4)) == "DONE")
   {
     document.getElementById('frm1').reset();
     myinfo("Message Sent");
   }
else 
     myalert("Error message not Sent");
    
});
    

}
function uploadPhoto()
{
    var uid = trim($('#uid').val());
    if(uid == '--Select--')
    {
        myalert("Please Choose Correct Record");
        return false;
    }
    var ival = $('#imgfil').val();
    $.post('admin-ajx.php?id=6',{'reg':uid,'photo':ival},function(data)
{alert(data);});

}
function slidebar(navigation_id, pad_out, pad_in, time, multiplier)
{
	
	var list_elements = navigation_id + " li.sliding-element";
	var link_elements = list_elements + " a";
	var timer = 0;
	$(list_elements).each(function(i)
	{
		// margin left = - ([width of element] + [total vertical padding of element])
		$(this).css("margin-left","-180px");
		timer = (timer*multiplier + time);
		$(this).animate({ marginLeft: "5px" }, timer);
		$(this).animate({ marginLeft: "15px" }, timer);
		$(this).animate({ marginLeft: "5px" }, timer);
	});

	// creates the hover-slide effect for all link elements 		
	$(link_elements).each(function(i)
	{
		$(this).hover(
		function()
		{
			$(this).animate({ paddingLeft: pad_out }, 150);
		},		
		function()
		{
			$(this).animate({ paddingLeft: pad_in }, 150);
		});
	});
}
    
