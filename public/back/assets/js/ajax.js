'use strict';

function ajaxRequest(type, url, callback, data = null) {    
    if(data && type.toLowerCase() == "get") {
        if(data instanceof Object) {
            url += "?";
            for(const key in data) {
                const value = data[key];
                url += `${key}=${value}&`;
            }
            url = url.substring(0, url.length-1);
        } else if(data instanceof String) {
            url += `?${data}`;
        }        
    }

    const xhr = new XMLHttpRequest();
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
                callback(JSON.parse(xhr.responseText));
                break;
            default:
                httpErrors(xhr.status);
        }
    };

    xhr.send(data);
}

function httpErrors(errorCode) {
    const messages = {
        400: 'Requête incorrecte',
        401: 'Authentifiez vous',
        403: 'Accès refusé',
        404: 'Page non trouvée',
        500: 'Erreur interne du serveur',
        503: 'Service indisponible'
    };

    if (errorCode in messages) {
        $('#errors').html('<i class="fa fa-exclamation-circle"></i> <strong>' + messages[errorCode] + '</strong>');
        $('#errors').show();
    }
}