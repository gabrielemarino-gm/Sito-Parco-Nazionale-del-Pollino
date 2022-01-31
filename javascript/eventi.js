function visualizzaBoxEventi()
{
    var box = document.getElementById("box-nome-evento");

    // NOME
    var elemento = document.createElement("input");
    elemento.setAttribute("placeholder", "Inserisci nome evento");
    elemento.setAttribute("type", "text");
    elemento.setAttribute("name", "nome-evento");
    elemento.setAttribute("class", "nome-evento-new");
    elemento.required = true;
    box.appendChild(elemento); // inserisco nel box-areatesto 


    // DATA 
    box = document.getElementById("box-data-evento");
    elemento = document.createElement("p");
    elemento.setAttribute("class", "data-evento-p-new");
    elemento.innerHTML  = "Inserisci la data dell'evento:";
    box.appendChild(elemento);

    elemento = document.createElement("input");
    elemento.setAttribute("type", "date");
    elemento.setAttribute("class", "data-evento-new");
    elemento.setAttribute("name", "data-evento");
    elemento.required = true;
    box.appendChild(elemento);


    // ORA
    box = document.getElementById("box-ora-evento");
    elemento = document.createElement("p");
    elemento.setAttribute("class", "ora-evento-p-new");
    elemento.innerHTML  = "Inserisci l'ora dell'evento:";
    box.appendChild(elemento);

    elemento = document.createElement("input");
    elemento.setAttribute("type", "number");
    elemento.setAttribute("class", "ora-evento-new");
    elemento.setAttribute("min", "0");
    elemento.setAttribute("max", "24");
    elemento.setAttribute("step", "1");
    elemento.setAttribute("name", "ora-evento");
    elemento.required = true;
    box.appendChild(elemento);

    elemento = document.createElement("p");
    elemento.setAttribute("class", "ora-evento-duepunti-new");
    elemento.innerHTML  = ":";
    box.appendChild(elemento);

    elemento = document.createElement("input");
    elemento.setAttribute("type", "number");
    elemento.setAttribute("class", "min-evento-new");
    elemento.setAttribute("min", "0");
    elemento.setAttribute("max", "60");
    elemento.setAttribute("step", "1");
    elemento.setAttribute("name", "min-evento");
    elemento.required = true;
    box.appendChild(elemento);

    // LUOGO
    box = document.getElementById("box-luogo-evento");
    elemento = document.createElement("input");
    elemento.setAttribute("type", "text");
    elemento.setAttribute("placeholder", "Inserisci il luogo dell'evento");
    elemento.setAttribute("name", "luogo-evento");
    elemento.required = true;
    box.appendChild(elemento);


    // DESCRIZIONE
    box = document.getElementById("box-descrizione-evento");
    elemento = document.createElement("textarea");
    elemento.setAttribute("class", "descrizione-evento");
    elemento.setAttribute("name", "descrizione-evento");
    elemento.setAttribute("placeholder", "Inserisci descrizione evento");
    elemento.required = true;
    box.appendChild(elemento);

    
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
    box = document.getElementById("box-posta-evento");
    elemento = document.createElement("input");
    elemento.setAttribute("type", "submit");
    elemento.setAttribute("value", "Invia");
    elemento.setAttribute("class", "bottone-post");
    elemento.setAttribute("name", "bottone-post");
    box.appendChild(elemento);
    
    
    document.getElementById("box-nuovo-post").style.height = "300px";
    document.getElementById("bottone").setAttribute("onclick", "");
}
