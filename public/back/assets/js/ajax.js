'use strict';

function ajaxRequest(type, url, callback, data = null) {    
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

    const xhr = new XMLHttpRequest();
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
            default:
                callback(JSON.parse(xhr.responseText), xhr.status);
        }
    };

    xhr.send(data);
}