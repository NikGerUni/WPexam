function goToArchive() {
    const year  = document.getElementById( 'year' ).value;
    const month = document.getElementById( 'month' ).value;

    // Генерира URL с красива структура
    const archiveUrl = ` / mik / ${year} / ${month} / `;

    // Пренасочване към новия URL
    window.location.href = archiveUrl;

    return false; // Спира изпращането на стандартната GET заявка
}
