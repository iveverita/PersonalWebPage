document.addEventListener('DOMContentLoaded', function() {
    const moreButton = document.getElementById('moreProjButton');
    const projectsContainer = document.querySelector('.projects-container');
    
    if (!moreButton) return;
    
    let offset = document.querySelectorAll('.projects-container .project-article').length;
    const limit = 3;
    
    moreButton.addEventListener('click', function() {
        const lang = document.documentElement.lang;

        const httpreq = new XMLHttpRequest();
        
        httpreq.open('GET', `assets/ajax/get_proj.php?offset=${offset}&limit=${limit}&lang=${lang}`, true);
        
        httpreq.onload = function() {
            if (httpreq.status === 200) {
                const responseHTML = httpreq.responseText;
                
                if (responseHTML.trim() === '') {
                    moreButton.style.display = 'none';
                } else {
                    projectsContainer.insertAdjacentHTML('beforeend', responseHTML);
                    offset += limit;
                }
            } else {
                console.error('Request failed with status:', httpreq.status);
            }
        };
        
        httpreq.onerror = function() {
            console.error('Request failed');
        };
        
        httpreq.send();
    });
});