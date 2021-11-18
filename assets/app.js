/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

M.AutoInit();


document.addEventListener('DOMContentLoaded', function() {
    var options = {
        format: 'yyyy-mm-dd',
        i18n: { 
                nextMonth: 'Mois suivant',
                previousMonth: 'Mois précédent',
                // labelMonthSelect: 'Selectionner le mois',
                // labelYearSelect: 'Selectionner une année',
                months: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
                monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
                weekdays: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
                weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
                weekdaysAbbrev: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
                // today: 'Aujourd\'hui',
                clear: 'Réinitialiser',
                cancel: 'Fermer'
            }
        };
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
});