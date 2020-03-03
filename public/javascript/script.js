document.addEventListener('click', event => {
    $ctrl = event.target;
    if($ctrl.hasAttribute('data-id'))
    {
        id = $ctrl.getAttribute('data-id');
        btnText = $ctrl.getAttribute('btn-type');
        name = document.getElementById(`name-${id}`).value;
        url = document.getElementById(`url-${id}`).value;
        data = {
            'name' : name,
            'url' : url
        }
    
        if(btnText =='update'){
            event.preventDefault();
            return fetch("/api/source/" + id, {
                method: "POST", 
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
    
        if(btnText =='delete'){
            return fetch("/api/source/" + id, {
                method: "DELETE", 
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .catch((error) => {
                console.log(error.message);
            });
        }  
    }
   
});