function goToArchive() {
    const year  = document.getElementById( 'year' ).value;
    const month = document.getElementById( 'month' ).value;

    const fullPath = window.location.pathname; 
    const basePath = `/${fullPath.split('/')[1]}`; 
    return basePath; 
    
    const archiveUrl = `${basePath}/${year}/${month}/`;

    window.location.href = archiveUrl;

    return false; 
}
