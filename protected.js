const slug = window.location.pathname.split('/');
const page = slug[slug.length-2];
const _password = 'cobra1@#';
const already_loggedin = Boolean(getCookie('_protected_loggedIn'));

if(!already_loggedin && page!=='contact-us-1' && page!=='') {
    if(_password !== prompt('Please enter password')){
        window.location.reload();
    } else {
        setCookie('_protected_loggedIn',true,30);
    }
}


function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
  }

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return false;
  }