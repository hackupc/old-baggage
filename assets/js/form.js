function verifyForm(){
    var flag=true;
    var e1=document.getElementById('reg_id');
    var e2=document.getElementById('reg_name');
    var e3=document.getElementById('reg_surname');
    if(e1.value==""){
      flag = false;
      e1.style.backgroundColor = "#fee9e9";
      e1.placeholder = "The ID is mandatory";
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
      document.getElementById('reg_form').action = "assets/functions/register_new.php";
    }
    return flag;
}
