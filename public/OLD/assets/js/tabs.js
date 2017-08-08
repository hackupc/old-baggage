function openTab(evt, tabName){
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("user-content");
  for(i=0; i<tabcontent.length; i++){
    tabcontent[i].style.opacity = "0";
    tabcontent[i].style.height = "0";
  }
  tablinks = document.getElementsByClassName("user-tabs");
  for(i=0; i<tablinks.length; i++){
    tablinks[i].classList.remove("active");
  }
  document.getElementById(tabName).style.opacity = "1";
  document.getElementById(tabName).style.height = "inherit";
  evt.currentTarget.classList.add("active");
  window.history.pushState("object or string", "Title", location.protocol+"//"+location.host+location.pathname);
}
