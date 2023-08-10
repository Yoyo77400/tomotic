const addItemFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add("btn", "text-danger", "bt-trash");
    removeFormButton.innerHTML = '<i class="align-middle" data-feather="trash-2">';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.parentElement.remove();
    });
}
const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    const item = document.createElement('li');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );
    const container = item.querySelector('.item-form-container')
    addItemFormDeleteLink(container);

    collectionHolder.appendChild(item);

    feather.replace();

    if(item.querySelector('textarea')){
    CKEDITOR.replace(item.querySelector('textarea'));
    };
    collectionHolder.dataset.index++;
}

document
    .querySelectorAll('ul.item .item-form-container')
    .forEach((item) => {
        addItemFormDeleteLink(item)
    })

document
    .querySelectorAll('.add_item_link')
    .forEach(btn => {
        btn.addEventListener("click", addFormToCollection)
    });