window.onload = function() {
    const sendHeight = () => {
        const height = document.body.scrollHeight;
        const fullUrl = window.location.href;
        //console.log('FULL URL', fullUrl)
        window.parent.postMessage({ scrollHeight: height, fullUrl }, '*');
    }

    /*const sendClick = () => {
        const body = document.body
        const links = body.getElementsByTagName('a');

        for (let link of links) {
            link.onclick = function(event) {
                console.log('NEW LINK URL', link.href)
                window.parent.postMessage({ newLink: link.href, fullUrl }, '*');
            };
        }
    }*/

    sendHeight();
    //sendClick();

    const observerHeight = new MutationObserver(sendHeight);
    observerHeight.observe(document.body, { childList: true, subtree: true });

    /*const observerLinks = new MutationObserver(sendClick);
    observerLinks.observe(document.body, { childList: true, subtree: true });*/
};
