const attend = document.getElementById('attend');
const leaving = document.getElementById('leaving');
const break_start = document.getElementById('break_start');
const break_finish = document.getElementById('break_finish');
if (flgAttend) {
    attend.disabled = true;
    } else {
        attend.disabled = false;
    }
if (flgLeaving) {
        leaving.disabled = true;
    } else {
        leaving.disabled = false;
    }
if (flgBreakStart) {
        break_start.disabled = true;
    } else {
        break_start.disabled = false;
    }
if (flgBreakFinish) {
        break_finish.disabled = true;
    } else {
        break_finish.disabled = false;
    }