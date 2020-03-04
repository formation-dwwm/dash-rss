document.addEventListener('click', event => {
    $ctrl = event.target;
    if($ctrl.hasAttribute('btn-entity'))
    {
        entity = $ctrl.getAttribute('btn-entity');

        if (entity == "Source"){
            id = $ctrl.getAttribute('data-id');
            btnAction = $ctrl.getAttribute('btn-action');
            name = document.getElementById(`name-${id}`).value;
            url = document.getElementById(`url-${id}`).value;
            data = {
                'name' : name,
                'url' : url,
                'entity': 'Source'
            }
        } else if (entity == "Tag"){
            id = $ctrl.getAttribute('data-id');
            btnAction = $ctrl.getAttribute('btn-action');
            tag = document.getElementById(`tag-${id}`).value;
            data = {
                'tag' : tag,
                'entity': 'Tag'
            }
        }
    
        if (btnAction == 'update'){
            event.preventDefault();
            return fetch(`/api/config/${entity}/${id}`, {
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
    
        if (btnAction == 'delete'){
            return fetch(`/api/config/${entity}/${id}`, {
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