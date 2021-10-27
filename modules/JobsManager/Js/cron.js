var minute;
var hour;
var day;
var week;
var month;

function setGenerator(minute, hour, day, month, week) {

    document.getElementById('minute').value = minute;
    document.getElementById('hour').value = hour;
    document.getElementById('day').value = day;
    document.getElementById('month').value = month;
    document.getElementById('day_week').value = week;

}

function cronTabMinute() {
    minute = $("#minute_tab1 :selected").val();
    setGenerator(minute, '*', '*', '*', '*', '*');
}

function cronTabHour() {
    hour = $("#hour_tab2 :selected").val();
    minute = $("#minute_tab2 :selected").val();
    setGenerator(minute, hour, '*', '*', '*', '*');
}

function cronTabDay() {
    day = $("#day_tab3 :selected").val();
    hour = $("#hour_tab3 :selected").val();
    minute = $("#minute_tab3 :selected").val();
    setGenerator(minute, hour, day, '*', '*', '*');
}

function cronTabWeek() {
    week = $("#week_tab4 :selected").val();
    hour = $("#hour_tab4 :selected").val();
    minute = $("#minute_tab4 :selected").val();
    setGenerator(minute, hour, '*', '*', week);
}

function cronTabMonth() {
    month = $("#month_tab5 :selected").val();
    day = $("#day_tab5 :selected").val();
    hour = $("#hour_tab5 :selected").val();
    minute = $("#minute_tab5 :selected").val();
    setGenerator(minute, hour, day, month, '*');
}