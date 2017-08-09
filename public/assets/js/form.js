function verifyForm(){
    var flag=true;
    var e1=document.getElementById('reg_id');
    var e2=document.getElementById('reg_name');
    var e3=document.getElementById('reg_surname');
    if(e1.value==""){
      flag = false;
      e1.style.backgroundColor = "#fee9e9";
      e1.placeholder = "The ID/Passport is mandatory";
    }
    if(e2.value==""){
      flag = false;
      e2.style.backgroundColor = "#fee9e9";
      e2.placeholder = "The name is mandatory";
    }
    if(e3.value==""){
      flag = false;
      e3.style.backgroundColor = "#fee9e9";
      e3.placeholder = "The surname is mandatory";
    }
    if(flag==true){
      document.getElementById('reg_form').action = "/create/"+e1.value+"/"+e2.value+"/"+e3.value+"/"+document.getElementById('reg_desc').value+"/"+document.getElementById('reg_spe').value;
    }
    return flag;
}
function verifySearch(){
    var flag=true;
    var e1=document.getElementById('sea_id');
    if(e1.value==""){
      flag = false;
      e1.style.backgroundColor = "#fee9e9";
      e1.placeholder = "The ID/Passport is mandatory";
    }
    if(flag==true){
      document.getElementById('sea_form').action = "/user/"+e1.value;
    }
    return flag;
}
