function visualizzaBoxPost()
{
    var box = document.getElementById("box-areatesto");

    // Devo inserire la casella di testo
    // TEXTAREA
    var elemento = document.createElement("textarea");
    elemento.setAttribute("placeholder", "A cosa stai pensando?");
    elemento.setAttribute("name", "areatesto");
    elemento.required = true;
    box.appendChild(elemento); // inserisco nel box-areatesto 
    
    // SUBMIT Scegli Immagine
    box = document.getElementById("box-input-file");
    elemento = document.createElement("input");
    elemento.setAttribute("type", "submit");
    elemento.setAttribute("value", "Scegli immagini");
    elemento.setAttribute("onclick", "document.getElementById('file-choosen').click()");
    elemento.setAttribute("class", "bottone-segli-immagine");
    elemento.setAttribute("name", "bottone-segli-immagine");
    box.appendChild(elemento);


    // SUBMIT Post
    box = document.getElementById("box-posta");
    elemento = document.createElement("input");
    elemento.setAttribute("type", "submit");
    elemento.setAttribute("value", "Post");
    elemento.setAttribute("class", "bottone-post");
    elemento.setAttribute("name", "bottone-post");
    box.appendChild(elemento);
    
    
    document.getElementById("box-nuovo-post").style.height = "300px";
    document.getElementById("bottone").setAttribute("onclick", "");
}



var slideIndex = 1;
showSlides(slideIndex);


function plusSlides(n, idPost) 
{
    showSlides(slideIndex += n, idPost);
}
  
function currentSlide(n, idPost) 
{
    showSlides(slideIndex = n, idPost);
}
  
function showSlides(n, idPost) 
{
    var i;
    var slides = document.getElementsByClassName("mySlides-" + idPost);
    

    if (n > slides.length) 
    {
        slideIndex = 1
    }
        
    if (n < 1) 
    {
        slideIndex = slides.length
    }
    
    for (i = 0; i < slides.length; i++) 
    {
        slides[i].style.display = "none";  
    }
    
    slides[slideIndex-1].style.display = "block";  
}



function visualizzaCommenti(idPost)
{
    // Devo rendere visibile tutti i commenti contenuti nelle textarea
    var box = document.getElementById('contenitore-commenti-post-' + idPost);
    box.setAttribute("style", "display:block");
    
}

function hideCommenti(idPost)
{
    var box = document.getElementById('contenitore-commenti-post-' + idPost);
    box.setAttribute("style", "display:none");
    
}