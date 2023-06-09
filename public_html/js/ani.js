

/* copy previous */

function copyPrevious(ele) {
	let el = document.createElement('textarea');
    el.value = ele.previousElementSibling.innerHTML;
	el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
	document.body.appendChild(el);
    el.select();
    el.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand('copy');
	document.body.removeChild(el);
	let eles = document.getElementsByClassName("copyprevious");
	for (i = 0; i < eles.length; i++) {
		eles[i].style.color = "inherit"
		eles[i].innerHTML = "&nbsp; &#9776; "
	}
	ele.innerHTML = "&nbsp; &#9788; ";
}

function copyPrevious2(ele) {
    let val = ele.previousElementSibling.innerHTML
        .replaceAll("<br>", "\n")
        .replaceAll("<br/>", "\n")
        .replaceAll("&lt;", "<")
        .replaceAll("&gt;", ">")
        .replaceAll("&nbsp;&nbsp;", "\t");
    const copyContent = async () => {
        try {
            await navigator.clipboard.writeText(val);
            console.log('Content copied to clipboard');
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }
    copyContent();
}


/* end copy previous */

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

