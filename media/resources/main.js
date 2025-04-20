function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

function introToggle(name) {
    if (isInViewport(document.getElementById('intro-box-' + name))) {
        document.getElementById('intro-link-' + name).classList.add('active');
    } else {
        document.getElementById('intro-link-' + name).classList.remove('active');
    }
}

window.onscroll = window.onresize = window.onload = () => {
    introToggle("free");
    introToggle("reliable");
    introToggle("fast");
    introToggle("quality");
    introToggle("easy");
};