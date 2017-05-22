let formatDate = (date) => {
    let thisDate = new Date(date);
    let monthNames = [
        "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
    ];

    let day = thisDate.getDate();
    let monthIndex = thisDate.getMonth();
    let year = thisDate.getFullYear();

    return day + ' ' + monthNames[monthIndex] + ' ' + year;
};