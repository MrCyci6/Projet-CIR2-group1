'use strict';

function ajaxRequest(type, url, callback, data = null) {    
    if(type.toLowerCase() != "put") {
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
    } else if (type.toLowerCase() == "put") {
        let newData = ""
        for(const key in data) {
            const value = data[key];
            newData += `${key}=${value}&`;
        }
        newData = newData.substring(0, newData.length-1);
        data = newData;
    }

    const xhr = new XMLHttpRequest();
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
            default:
                // console.log(xhr.responseText)
                callback(JSON.parse(xhr.responseText), xhr.status);
        }
    };

    xhr.send(data);
}