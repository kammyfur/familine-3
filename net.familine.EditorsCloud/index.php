<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/Headers.php"; ?>
<script>

function home() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/dash.php";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-dashboard').classList.add('mdc-list-item--activated');
}

function storage() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/storage.php";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-storage').classList.add('mdc-list-item--activated');
}

function renew() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/renew.php";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-renew').classList.add('mdc-list-item--activated');
}

function preferences() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/preferences.php";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-preferences').classList.add('mdc-list-item--activated');
}

function about() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/about.php";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-about').classList.add('mdc-list-item--activated');
}
    
function files() {
    document.getElementById('content-inner').contentWindow.location.href = "/net.familine.EditorsCloud/content/files.php?url=/";
    pushbar.close();
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.classList.remove('mdc-list-item--activated');
    })
    document.getElementById('link-files').classList.add('mdc-list-item--activated');
}

function iframeURLChange(iframe, callback) {
    var unloadHandler = function () {
        setTimeout(function () {
            callback(iframe.contentWindow.location.href);
        }, 0);
    };
    
    function attachUnload() {
        iframe.contentWindow.removeEventListener("unload", unloadHandler);
        iframe.contentWindow.addEventListener("unload", unloadHandler);
    }
    
    iframe.addEventListener("load", attachUnload);
    attachUnload();
}

window.onload = () => {
    
    iframeURLChange(document.getElementById("content-inner"), function (newURL) {
        document.getElementById('content').style.display = "none";
        document.getElementById('loader').style.display = "";
    });
    
    document.getElementById('content-inner').onbeforeunload = () => {
        document.getElementById('content').style.display = "none";
        document.getElementById('loader').style.display = "";
    }
    
    document.getElementById('content-inner').onload = () => {
        document.getElementById('content').style.display = "";
        document.getElementById('loader').style.display = "none";
    }
    
    Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
        e.onclick = (event) => {
            pushbar.close();
            Array.from(document.getElementsByClassName('mdc-list-item')).forEach((e) => {
                e.classList.remove('mdc-list-item--activated');
            })
            event.target.classList.add('mdc-list-item--activated');
        }
    })
    
    home()
}

</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/PreBody.php"; ?>

<div id="box">
    <div id="loader" style="">
        <svg class="spinner" width="48px" height="48px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
        </svg>
    </div>
    <div id="content" style="display:none;">
        <iframe src="" id="content-inner"></iframe>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/Footer.php"; ?>