const activateSelectImage = (input) => {
    input.addEventListener('change', (e) => {
        //on récupère l'index de l'image chargé dans l'input de type file
        let file = e.currentTarget.files[0];
        //On mémorise l'élément html qui a été changé
        let item = e.currentTarget;
        //si l'input est peuplé
        if(file){
            //on instancie un objet FileReader
            let reader = new FileReader();
            reader.onload = function(){
                // on met en place l'image dans le dom html
                // console.log(item.parentElement.previousElementSibling);
                // oncréer une variable qui pointe sur le parent (div) dans laquelle on veut mettre l'image
                let imgContainer = item.parentElement.previousElementSibling;
                // on vérifie si le parent contient déjà la balise image recherchée
                if(imgContainer.querySelector('.img-form-livre')){
                    imgContainer.querySelector('a').setAttribute('href' , reader.result);
                    imgContainer.querySelector('.img-form-livre').setAttribute('src', reader.result)
                }else{
                    let link = document.createElement('a');
                    link.classList.add('d-block', 'me-3');
                    link.setAttribute('href', reader.result);
                    link.setAttribute('data-lightbox', Date.now());

                    let img = document.createElement('img');
                    img.classList.add('img-fluid', 'img-form-livre');
                    img.setAttribute('src', reader.result);

                    //on Ajoute l'image dans le lien
                    link.appendChild(img);
                    imgContainer.appendChild(link);
                }
            }
            //On lit le contenu du fichier
            reader.readAsDataURL(file);
        }
    });
}

// On récupère tous les input html de type fil porteurs de la classe select images 
document.querySelectorAll('.select-image').forEach((item) => {
    // On les active
    activateSelectImage(item);
});