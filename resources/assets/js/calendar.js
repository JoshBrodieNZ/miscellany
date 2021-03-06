var calendarAddMonth, calendarAddWeekday, calendarAddYear, calendarTemplateMonth, calendarTemplateWeekday, calendarTemplateYear, calendarLeapYear;
var calendarYearSwitcher, calendarYearSwitcherField, calendarEventModal;
var calendarSortMonths, calendarSortWeekdays, calendarSortYears;

$(document).ready(function() {
    // Form
    calendarAddMonth = $('#add_month');
    if (calendarAddMonth.length === 1) {
        calendarAddWeekday = $('#add_weekday');
        calendarAddYear = $('#add_year');
        calendarTemplateMonth = $('#template_month');
        calendarTemplateWeekday = $('#template_weekday');
        calendarTemplateYear = $('#template_year');
        calendarLeapYear = $('input[name="has_leap_year"]');

        calendarSortMonths = $(".calendar-months");
        calendarSortWeekdays = $(".calendar-weekdays");
        calendarSortYears = $(".calendar-years");

        initCalendarForm();
    }

    // View
    calendarYearSwitcher = $('#calendar-year-switcher');
    if (calendarYearSwitcher.length === 1) {
        calendarYearSwitcherField = $('#calendar-year-switcher-field');
        calendarEventModal = $('#add-calendar-event');

        initCalendarYearSwitcher();
        initCalendarEventModal();
    }


});

/**
 * Initialize the calendar
 */
function initCalendarForm() {
    calendarAddMonth.on('click', function(e) {
        e.preventDefault();

        $(this).before('<div class="form-group">' +
            calendarTemplateMonth.html() +
        '</div>');

        // Handle deleting already loaded blocks
        calendarDeleteRowHandler();

        return false;
    });

    calendarAddWeekday.on('click', function(e) {
        e.preventDefault();

        $(this).before('<div class="form-group">' +
            calendarTemplateWeekday.html() +
            '</div>');


        // Handle deleting already loaded blocks
        calendarDeleteRowHandler();

        return false;
    });

    calendarAddYear.on('click', function(e) {
        e.preventDefault();

        $(this).before('<div class="form-group">' +
            calendarTemplateYear.html() +
            '</div>');


        // Handle deleting already loaded blocks
        calendarDeleteRowHandler();

        return false;
    });

    calendarLeapYear.on('click', function() {
        $('#calendar-leap-year').toggle();
    });


    // Handle deleting already loaded points
    calendarDeleteRowHandler();
}

function calendarDeleteRowHandler() {
    $.each($('.month-delete'), function (index) {
        $(this).unbind('click'); // remove previous bindings
        $(this).on('click', function(e) {
            if ($(this).data('remove') === 4) {
                $(this).parent().parent().parent().parent().remove();
            } else {
                $(this).parent().parent().parent().remove();
            }
            e.preventDefault();
            return false;
        });
    });

    calendarSortMonths.sortable();
    calendarSortWeekdays.sortable();
    calendarSortYears.sortable();
}

function initCalendarYearSwitcher() {
    calendarYearSwitcher.on('click', function() {
        $(this).hide();
        year = calendarYearSwitcherField.val();
        calendarYearSwitcherField.show().focus().val('').val(year);
    });
}

function initCalendarEventModal() {
    $.each($('.add'), function() {
        $(this).on('click', function(e) {
            e.preventDefault();
            calendarEventModal.modal();

            // Prepare date field
            $('#date').val($(this).attr('data-date'));
        });
    });

    $('input[name="is_recurring"]').on('click', function(e) {
        $('#add_event_recurring_until').toggle();
    });

    $('#calendar-action-existing').on('click', function() {
        $('#calendar-event-first').hide();
        $('.calendar-new-event-field').hide();
        $('#calendar-event-subform').fadeToggle();
        $('#calendar-event-submit').removeAttr('disabled');
    });

    $('#calendar-action-new').on('click', function() {
        $('#calendar-event-first').hide();
        $('.calendar-existing-event-field').hide();
        $('#calendar-event-subform').fadeToggle();
        $('#calendar-event-submit').removeAttr('disabled');
    });

    $('#calendar-event-switch').on('click', function(e) {
        e.preventDefault();
        $('#calendar-event-subform').hide();
        $('#calendar-event-first').fadeToggle();
        $('.calendar-existing-event-field').show();
        $('.calendar-new-event-field').show();

        $('#calendar-event-submit').attr('disabled', 'disabled');

    });
}