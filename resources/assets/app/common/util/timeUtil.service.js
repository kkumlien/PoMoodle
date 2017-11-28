angular.module('poMoodleApp').factory('timeUtil', [function () {
    return {
        formatMinutes: formatMinutes
    };


    /**
     * Converts minutes into a time string in the format of 'x hours x minutes'
     * If hours or minutes is 0 they wont be included in the time string
     * If hours and minutes is 0 the time string will be '0 minutes'
     *
     * @param minutes
     * @returns {string} formatted time string
     */
    function formatMinutes(minutes) {
        if (minutes === 0) {
            return '0 minutes';
        }

        var hoursString = '';
        var minutesString = '';

        var hours = getHours(minutes);
        minutes = getMinutesMinusHours(minutes, hours);

        if (hours > 0) {
            hoursString = concatenateTimeWithType(hours, 'hour');
        }
        if (minutes > 0) {
            minutesString = concatenateTimeWithType(minutes, 'minute');
        }

        return concatenateHoursAndMinutes(hoursString, minutesString);
    }


    function getHours(minutes) {
        return parseInt(minutes / 60);
    }


    function getMinutesMinusHours(minutes, hours) {
        var hoursInMinutes = hours * 60;
        return minutes - hoursInMinutes;
    }


    function concatenateTimeWithType(time, type) {
        var timeString = time + ' ' + type;
        if (time > 1) {
            timeString += 's';
        }
        return timeString;
    }


    function concatenateHoursAndMinutes(hours, minutes) {
        var space = ' ';
        if (hours === '') {
            space = '';
        }
        return hours + space + minutes;
    }

}]);