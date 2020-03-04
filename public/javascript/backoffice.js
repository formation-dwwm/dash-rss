document.addEventListener('click', event => {
    $ctrl = event.target;
    if($ctrl.hasAttribute('btn-entity'))
    {
        entity = $ctrl.getAttribute('btn-entity');

        if (entity == "Source"){
            id = $ctrl.getAttribute('data-id');
            btnType = $ctrl.getAttribute('btn-type');
            name = document.getElementById(`name-${id}`).value;
            url = document.getElementById(`url-${id}`).value;
            data = {
                'name' : name,
                'url' : url,
                'entity': 'Source'
            }
        } else if (entity == "Tag"){
            id = $ctrl.getAttribute('data-id');
            btnType = $ctrl.getAttribute('btn-type');
            tag = document.getElementById(`tag-${id}`).value;
            data = {
                'tag' : tag,
                'entity': 'Tag'
            }
        }
    
        if (btnType =='update'){
            event.preventDefault();
            return fetch("/api/configuration/" + id, {
                method: "POST", 
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data),
            })
            .then(res => res.json())
            .catch((error) => {
                console.log(error.message);
            });
        }
    
        if (btnType =='delete'){
            return fetch("/api/configuration/" + id, {
                method: "DELETE", 
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .catch((error) => {
                console.log(error.message);
            });
        }  
    }
   
});