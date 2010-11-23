function excludeWeekendsAndDates(date,noConflict) {
	var noWeekend = null;
	if(noConflict == 'undefined' || noConflict == 'false'){
		noWeekend = $.datepicker.noWeekends(date);
	}else{
		noWeekend = jQuery.datepicker.noWeekends(date);
	}
    if (noWeekend[0]) {
        return excludeDates(date);
    } else {
        return noWeekend;
    }
}

function excludeDates(date) {
    for (i = 0; i < excludedDates.length; i++) {//excluded days is defined in jsUi options and should be in JSON array format: [['2','20','desc'],['7','4','desc']]
      if (date.getMonth() == excludedDates[i][0] - 1
          && date.getDate() == excludedDates[i][1]
          && date.getFullYear() == excludedDates[i][2] ) {
        return [false, excludedDates[i][3] + '_day'];
      }
    }
  return [true, ''];
}