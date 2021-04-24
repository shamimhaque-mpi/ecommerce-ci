var read = (x)=>document.querySelector(x);
var readAll = (x)=>document.querySelectorAll(x);

var url = window.location.origin+'/';
if(window.location.host=='localhost' || (window.location.host.match('192.168')>-1)){
    var pathname = window.location.pathname;
    url += pathname.substr(1, pathname.indexOf('/', 1));
}

window.makeFormData=(object)=>{
    var formdata = new FormData();
    if(typeof object == 'object'){
        for(const key in object){
            if(typeof object[key] == 'object'){
                formdata.append(key, JSON.stringify(object[key]));                
            }else{
                formdata.append(key, object[key]);                
            }
        }
    }
    return formdata;
}