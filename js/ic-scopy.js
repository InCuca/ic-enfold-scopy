function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        const msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        window.alert('Copiado para o clipboard');
    }, function (err) {
        window.alert('Erro ao copiar');
        console.error('Async: Could not copy text: ', err);
    });
}

function getAsUriParameters(data) {
    let url = '';
    for (const prop in data) {
        url += encodeURIComponent(prop) + '=' +
            encodeURIComponent(data[prop]) + '&';
    }
    return url.substring(0, url.length - 1)
}

function onShortcodeLoaded(evt) {
    const res = evt.target.responseText;
    copyTextToClipboard(res);
}

function loadShortcode() {
    const {url, params} = window.ic_scopy;
    const oReq = new XMLHttpRequest();
    oReq.onload = onShortcodeLoaded;
    oReq.open("GET", `${url}?${getAsUriParameters(params)}`, true);
    oReq.setRequestHeader("Content-Type", "application/json");
    oReq.send();
}

function setupIcScopy() {
    const a = document.createElement('a');
    a.innerHTML = 'Copiar Shortcode';
    a.style.position = 'fixed';
    a.style.bottom = '0';
    a.style.left = '0';
    a.style.zIndex = '9999';
    a.style.background = 'black';
    a.style.color = 'white';
    a.href = '#';

    a.addEventListener('click', loadShortcode);
    
    document.body.appendChild(a);
}

document.addEventListener('DOMContentLoaded', setupIcScopy);