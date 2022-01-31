function showPassword() 
{
   var input = document.getElementById('password');
   var show = document.getElementById('show');
   if (input.type === "password") 
   {
      input.type = "text";
      show.style.backgroundImage = "url('../foto/occhio_aperto.png')";
   } 
   else 
   {
      input.type = "password";
      show.style.backgroundImage = "url('../foto/occhio_chiuso.png')";
   }
}


function showPasswordRipetuta() 
{
   var input = document.getElementById('ripeti_password');
   var show = document.getElementById('show-ripetuta');
   if (input.type === "password") 
   {
      input.type = "text";
      show.style.backgroundImage = "url('../foto/occhio_aperto.png')";
   } 
   else 
   {
      input.type = "password";
      show.style.backgroundImage = "url('../foto/occhio_chiuso.png')";
   }
}


function valida_login()
{
   var username = document.getElementById("username");
   var password = document.getElementById("password");

   var username_validation = /^[a-zA-Z]+[' ']?[a-zA-Z]+$/;
   var username_v = document.getElementById("username").value;

   if (!username_validation.test(username_v)) 
   {
      alert("Formato username non valido.");
      document.getElementById("username").focus();
      return false;
   }

   // Check campi vuoti
   if(username.value.trim() == "")
   {
      alert("Formato username scorretto!");
      document.getElementById("username").focus();
      return false;
   }

   if(password.value.trim() == "")
   {
      alert("Formato password scorretto!");
      document.getElementById("password").focus();
      return false; 
   }
}


function popupCentratoNick() 
{
      var w = 450;
      var h = 250;
      var l = Math.floor((screen.width-w)/2);
      var t = Math.floor((screen.height-h)/2);

      window.open("./recupero_username.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}


function valida_registrazione() 
{
   var name = document.getElementById("name");
   var surname = document.getElementById("surname");
   var username = document.getElementById("username");
   var email = document.getElementById("email");
   var password = document.getElementById("password");
   var data = document.getElementById("data_nascita");
   var ripeti_password =document.getElementById("ripeti_password");

   // //check campi vuoti
   if(name.value.trim() == "")
   {
         alert("Il campo Nome è obbligatorio.");
         document.name.focus();
         return false;
   }

   if(surname.value.trim() == "")
   {
         alert("Il campo Cognome è obbligatorio.");
         document.surname.focus();
         return false;
   }

   if(username.value.trim() == "")
   {
         alert("Il campo Username è obbligatorio.");
         documento.username.focus();
         return false;
   }
         

   // Controllo che ci siano solo caratteri alfabetici nel nome 
   var username_validation = /^[a-zA-Z]+[' ']?[a-zA-Z]+$/;
   var username_v = document.getElementById("username").value;

   if (!username_validation.test(username_v)) 
   {
      alert("Il campo Username non è valido.");
      document.getElementById("username").focus();
      return false;
   }
   
   if(data.value.trim() == "")
   {
      alert("Il campo Data non è valido.");
      document.data.focus();
      return false;
   }

   var data_reg_exp = /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
   var data_v= document.getElementById("data_nascita").value;

   if (!data_reg_exp.test(data_v)) 
   {
      alert("Formato data scorretto!");
      data.focus();
      return false;
   }
   
   var today = new Date();
   var anno = data_v.substring(0,4);
         
   if(anno > (today.getFullYear() - 16))
   {
      data.focus();
      alert("Devi avere almeno 18 anni!");
      console.log(today.getFullYear());
      return false;
   }
   
   if(email.value.trim() == "")
   {
      alert("Devi inserire l'email!");
      email.focus();
      return false;
   }
         
   //controllare formato email
   var email_reg_exp = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,4})$/i;
   if (!email_reg_exp.test(email.value)) 
   {
      email.focus();
      alert("Formato email scorretto!");
      return false;
   }
   
   if(password.value.trim() == "")
   {
      alert("Formato password scorretto!");
      password.focus();
      return false;
   }
   
   if(ripeti_password.value.trim() == "")
   {
      alert("Devi reinserire la password!");
      ripeti_password.focus();
      return false;
   }
   
   //corrispondenza password e ripeti_password
   if(ripeti_password.value.trim() != password.value.trim())
   {
      alert("Le password non coincidono!");
      ripeti_password.focus();
      return false;
   }
}




    