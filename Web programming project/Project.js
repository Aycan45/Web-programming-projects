var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000);
}
function Validate(){
  var name = document.forms["Form"]["fname"]; 
  var lname = document.forms["Form"]["lname"];               
  var email = document.forms["Form"]["email"]; 
  var password = document.forms["Form"]["password"];
  var username = document.forms["Form"]["username"];
  var repeatpassword=document.forms["Form"]["repeatpassword"];
    if (name.value == "" && name.value.lenght<3)                                  
    { 
        window.alert("Напишете името си!"); 
        name.focus(); 
        return false;
    }
    if (lname.value == "" && lname.value.lenght<3)                                  
    { 
        window.alert("Напишете фамилията си!"); 
        lname.focus();
        return false; 
    }
     if (username.value == "" && username.value.lenght<3)                        
    { 
        window.alert("Напишете си потребителското име"); 
        username.focus();
        return false; 
    }
    if (!name.value.match(/[A-Z]/g) || !lname.value.match(/[A-Z]/g)) {
        window.alert('Няма голяма буква на имената!');
        name.focus();
        lname.focus();
        return false; 
    }
    if (!name.value.match(/[a-z]/g) || !lname.value.match(/[a-z]/g)) {
        window.alert('Няма малка буква на имената!');
        name.focus();
        lname.focus();
        return false; 

    }
    if (!password.value.match(/[0-9]/g)) {
        window.alert('Няма число на паролата!');
        password.focus();
        return false; 
    }
    if (!password.value.match(/[A-Z]/g)) {
        window.alert('Няма голяма буква на паролата!');
        password.focus();
        return false; 
    }   
    if (email.value == "" && email.value.lenght<3)                                   
    { 
        window.alert("Напишете валиден имейл!"); 
        email.focus(); 
        return false; 

    } 
   
    if (email.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Напишете валиден имейл!"); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf(".", 0) < 0)                 
    { 
        window.alert("Напишете валиден имейл!"); 
        email.focus(); 
        return false; 
    }
     if (!password==repeatpassword)                        
    { 
        window.alert("Паролите на съвпадат!"); 
        password.focus(); 
        return false; 
    }
    if (password.value == "" && password.value.lenght<3)                        
    { 
        window.alert("Напишете си паролата"); 
        password.focus();
        return false; 
    }
    return true; 
  }
